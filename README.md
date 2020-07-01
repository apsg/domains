[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![StyleCI Status][ico-styleci]][link-styleci]

# Laravel DDD
Laravel setup helper for DDD approach

#### What it does?

1. It changes namespace in RouteServiceProvider from `App\Http\Controllers` to nothing.
2. It creates some directories for domains.
3. It fixes Auth routes for you (since it is no longer possible to use `Auth::routes()` helper).
4. (optionally) It provides examples of usage. 

### Installation

`composer require apsg/domains --dev`

### Basic usage

After fresh installation of Laravel just run Artisan command:

``php artisan ddd:setup``

One can also autogenerate some examples with `--examples` option:

```php artisan ddd:setup --examples```


[ico-styleci]: https://github.styleci.io/repos/276352493/shield 
[link-styleci]: https://styleci.io/repos/276352493

[ico-version]: https://img.shields.io/packagist/v/apsg/domains.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/apsg/domains.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/apsg/domains
[link-downloads]: https://packagist.org/packages/apsg/domains
