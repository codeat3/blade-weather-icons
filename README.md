<p align="center">
    <img src="./socialcard-blade-weather-icons.png" width="1280" title="Social Card Blade Weather Icons">
</p>

# Blade Weather Icons

<a href="https://github.com/codeat3/blade-weather-icons/actions?query=workflow%3ATests">
    <img src="https://github.com/codeat3/blade-weather-icons/workflows/Tests/badge.svg" alt="Tests">
</a>
<a href="https://packagist.org/packages/codeat3/blade-weather-icons">
    <img src="https://img.shields.io/packagist/v/codeat3/blade-weather-icons" alt="Latest Stable Version">
</a>
<a href="https://packagist.org/packages/codeat3/blade-weather-icons">
    <img src="https://img.shields.io/packagist/dt/codeat3/blade-weather-icons" alt="Total Downloads">
</a>

A package to easily make use of [Weather Icons](https://github.com/erikflowers/weather-icons) in your Laravel Blade views.

For a full list of available icons see [the SVG directory](resources/svg) or preview them at [erikflowers.github.io/weather-icons](https://erikflowers.github.io/weather-icons/).

## Requirements

- PHP 7.4 or higher
- Laravel 8.0 or higher

## Installation

```bash
composer require codeat3/blade-weather-icons
```

## Updating

Please refer to [`the upgrade guide`](UPGRADE.md) when updating the library.

## Blade Icons

Blade Weather Icons uses Blade Icons under the hood. Please refer to [the Blade Icons readme](https://github.com/blade-ui-kit/blade-icons) for additional functionality. We also recommend to [enable icon caching](https://github.com/blade-ui-kit/blade-icons#caching) with this library.

## Configuration

Blade Weather Icons also offers the ability to use features from Blade Icons like default classes, default attributes, etc. If you'd like to configure these, publish the `blade-weather-icons.php` config file:

```bash
php artisan vendor:publish --tag=blade-weather-icons-config
```

## Usage

Icons can be used as self-closing Blade components which will be compiled to SVG icons:

```blade
<x-wi-alien/>
```

You can also pass classes to your icon components:

```blade
<x-wi-alien class="w-6 h-6 text-gray-500"/>
```

And even use inline styles:

```blade
<x-wi-alien style="color: #555"/>
```

### Raw SVG Icons

If you want to use the raw SVG icons as assets, you can publish them using:

```bash
php artisan vendor:publish --tag=blade-wi --force
```

Then use them in your views like:

```blade
<img src="{{ asset('vendor/blade-wi/alien.svg') }}" width="10" height="10"/>
```

## Changelog

Check out the [CHANGELOG](CHANGELOG.md) in this repository for all the recent changes.

## Maintainers

Blade Weather Icons is developed and maintained by [Swapnil Sarwe](https://swapnilsarwe.com).

## License

Blade Weather Icons is open-sourced software licensed under [the MIT license](LICENSE.md).
