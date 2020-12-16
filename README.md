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
- [DISTRICTS](DISTRICTS.md)
- [VILLAGES](VILLAGES.md)

## Spatial Source

The spatial source I use comes from [GADM](https://gadm.org/index.html) version 3.6.

## Requirement
I don't know exactly, but it's been tested on
 - Laravel 8
 - PHP 7.4
 - MySQL 8.0 with SRID support

## TODO
Look at the [TODO.md](TODO.md) file

## Installation

Warning: Size of Geometry source approx 910 Mb.

```bash
composer require octopyid/indonesian-boundaries:dev-main

php artisan vendor:publish --provider="Octopy\Indonesian\Boundaries\ServiceProvider"

php artisan migrate

php artisan laravolt:indonesia:seed

php artisan octopy:seed:city

php artisan octopy:seed:province
```

## Credits

- [Supian M](https://github.com/SupianIDz)
- [Octopy ID](https://github.com/OctopyID)
- Contributors

## License
The MIT License (MIT). Please see [License File](https://github.com/SupianIDz/LaraPersonate/blob/master/LICENSE) for more information.