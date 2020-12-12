<?php

namespace Octopy\Indonesian\Boundaries;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Compilers\BladeCompiler;
use Octopy\Indonesian\Boundaries\Commands\CitySeedCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Octopy\Indonesian\Boundaries\Commands\ProvinceSeedCommand;
use Octopy\Indonesian\Boundaries\Http\Controllers\BoundaryController;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->registerRoutes();

        $this->mergeConfigFrom(
            __DIR__ . '/../config/boundary.php', 'boundary'
        );

        $this->app->singleton(Boundary::class, function () {
            return new Boundary;
        });

        $this->app->singleton(BoundaryConfig::class, function () {
            return new BoundaryConfig;
        });

        $this->commands([
            ProvinceSeedCommand::class,
            CitySeedCommand::class,
        ]);
    }

    /**
     * @return void
     */
    public function boot() : void
    {
        $this->registerPublishing();

        if ($this->app->resolved('blade.compiler')) {
            $this->registerDirective($this->app['blade.compiler']);
        } else {
            $this->app->afterResolving('blade.compiler', function (BladeCompiler $compiler) {
                $this->registerDirective($compiler);
            });
        }

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'octopy'
        );
    }

    /**
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/octopyid/boundary'),
            ], 'boundary-assets');

            $this->publishes([
                __DIR__ . '/../config/boundary.php' => config_path('boundary.php'),
            ], 'boundary-config');
        }
    }

    /**
     * @param  BladeCompiler $compiler
     */
    private function registerDirective(BladeCompiler $compiler)
    {
        $compiler->directive('boundary', function () {
            return "<?php echo view('octopy::boundary', ['boundary' => app(" . BoundaryConfig::class . "::class)]); ?>";
        });
    }

    /**
     * @return void
     */
    private function registerRoutes()
    {
        Route::get('indonesia/boundaries', BoundaryController::class);
    }
}