<p align="center">
    <img src="https://img.shields.io/packagist/l/octopyid/indonesian-boundaries.svg?style=for-the-badge" alt="License">
    <img src="https://img.shields.io/packagist/v/octopyid/indonesian-boundaries.svg?style=for-the-badge" alt="Version">
    <img src="https://img.shields.io/packagist/dt/octopyid/indonesian-boundaries.svg?style=for-the-badge" alt="Downloads">
</p>

# Indonesian Boundaries

Is a Laravel package that provides a basic map of the country of Indonesia.

## Spatial Source

The spatial source I use comes from Badan Pusat Statistik (BPS - Statistics Indonesia).

## Requirement

I don't know exactly, but it's been tested on

- Laravel 8
- PHP 7.4

## Installation

```bash
composer require octopyid/indonesian-boundaries:dev-main

php artisan vendor:publish --provider="Octopy\Indonesian\Boundaries\ServiceProvider"
```

### Basic Usage

- resources/views/map.blade.php

```html
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Map Example</title>
        @boundaryStyles
    </head>
    <body>
        <div id="map" style="height: 990px"></div>

        @boundaryScript

        <script type="text/javascript">
            $boundary.render();
        </script>
    </body>
</html>

```

- app/Http/Controllers/MapController.php

```php
<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Octopy\Indonesian\Boundaries\Boundary;
use Octopy\Indonesian\Boundaries\Draw\Draw;
use Octopy\Indonesian\Boundaries\Config\Style;
use Illuminate\Contracts\Foundation\Application;

class MapController extends Controller
{
    /**
     * @param  Boundary $boundary
     * @return Application|Factory|View
     * @throws Exception
     */
    public function index(Boundary $boundary)
    {
        $map = $boundary->element('map');

        $map->center(-0.487177, 116.317060);
        $map->draw(function (Draw $draw) {
            # Draw provincial boundaries
            $draw->province([61, 62, 63, 64, 65])->style(function (Style $style) {
                $style->color('#0F0F0F')
                    ->fillColor('#556EE6')
                    ->fillOpacity(0.2);
            });
        });

        return view('map');
    }
}
```

## Credits

- [Supian M](https://github.com/SupianIDz)
- [Octopy ID](https://github.com/OctopyID)

## License

The MIT License (MIT). Please see [License File](https://github.com/SupianIDz/LaraPersonate/blob/master/LICENSE) for
more information.