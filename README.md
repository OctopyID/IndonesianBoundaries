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

## Credits

- [Supian M](https://github.com/SupianIDz)
- [Octopy ID](https://github.com/OctopyID)

## License

The MIT License (MIT). Please see [License File](https://github.com/SupianIDz/LaraPersonate/blob/master/LICENSE) for
more information.