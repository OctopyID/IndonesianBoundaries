<?php

namespace Octopy\Indonesian\Boundaries;

use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/boundary.php', 'boundary'
        );

        $this->app->singleton(Boundary::class, fn() => new Boundary);
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
            $this->app->afterResolving(
                'blade.compiler', fn(BladeCompiler $compiler) => $this->registerDirective($compiler)
            );
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
            return "<?php echo view('octopy::boundary', ['boundary' => app(" . Boundary::class . "::class)]); ?>";
        });
    }
}