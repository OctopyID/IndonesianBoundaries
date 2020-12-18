<p style="align-content: center;text-align: center;">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/license" alt="License">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/v" alt="Version">
    <img src="https://poser.pugx.org/octopyid/indonesian-boundaries/downloads" alt="Downloads">
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

The spatial source I use comes from Badan Pusat Statistik (BPS - Statistics Indonesia).

## Requirement
I don't know exactly, but it's been tested on
 - Laravel 8
 - PHP 7.4

## TODO
Look at the [TODO.md](TODO.md) file

## Installation

```bash
composer require octopyid/indonesian-boundaries:dev-main

php artisan vendor:publish --provider="Octopy\Indonesian\Boundaries\ServiceProvider"
```

## Credits

- [Supian M](https://github.com/SupianIDz)
- [Octopy ID](https://github.com/OctopyID)
- Contributors

## License
The MIT License (MIT). Please see [License File](https://github.com/SupianIDz/LaraPersonate/blob/master/LICENSE) for more information.