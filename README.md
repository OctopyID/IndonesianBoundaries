<p align="center">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/license">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/v">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/downloads">
</p>

# Indonesian Boundaries

Is a Laravel package that provides a basic map of the country of Indonesia.

## Availability of Geometry

Please open the link below for a list of available geometries.

- [PROVINCES](PROVINCES.md)
- [CITIES](CITIES.md)

## Spatial Source

The spatial source I use comes from [GADM](https://gadm.org/index.html) version 3.6.

## Requirement
I don't know exactly, but it's been tested on
 - Laravel 8
 - PHP 7.4
 - MySQL 8.0 with SRID support

## Installation

```bash
composer require octopyid/indonesian-boundaries:dev-main

php artisan vendor:publish --provider="Octopy\Indonesian\Boundaries\ServiceProvider"

php artisan migrate

php artisan laravolt:indonesia:seed

php artisan octopy:seed:city

php artisan octopy:seed:province
```

## Usage

```php
use Octopy\Indonesian\Boundaries\Boundary;
use Octopy\Indonesian\Boundaries\BoundaryConfig;

Route::get('/', function (Boundary $boundary){
	// to override global configuration
    $boundary->config(function (BoundaryConfig $config){
    	$config->setCenter(-0.789275, 113.921327);
    	$config->setZoom([
            'zoom' => 5
        ]);
    });

    // Use area code to render the provincial base map,
    $boundary->renderProvince([
        63, 11, 20, 32, 51
    ]);
    
    // Use area code to render the city base map,
    $boundary->renderCity([
        1201, 6310, 6306, 6371
    ]);

    return view('indonesia');
});

```

```html
<!-- indonesia.blade.php -->

<!doctype html>
<html lang="en">
<head>
    ....
    <title>Map Example</title>
</head>
<body>
    <div id="map" style="width: 100%;height: 1100px"></div>
    @boundary
    <script>
        (() => {
            boundary.render().all();
            // .all() => To render all defined areas.
            // .city() => Renders only all defined city areas.
            // .province() => Renders only all defined provincial areas.
        })();
    </script>
</body>
</html>

```

## TODO
Look at the [TODO.md](TODO.md) file

## Credits

- [Supian M](https://github.com/SupianIDz)
- [Octopy ID](https://github.com/OctopyID)
- Contributors

## License
The MIT License (MIT). Please see [License File](https://github.com/SupianIDz/LaraPersonate/blob/master/LICENSE) for more information.