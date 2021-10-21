# Simplifies GST calculation and operations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gaurangsharma/gst-calculator.svg?style=flat-square)](https://packagist.org/packages/gaurangsharma/gst-calculator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/gaurang-commits/gst-calculator/Tests?label=tests)](https://github.com/gaurang-commits/gst-calculator/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/gaurang-commits/gst-calculator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/gaurang-commits/gst-calculator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/gaurangsharma/gst-calculator.svg?style=flat-square)](https://packagist.org/packages/gaurangsharma/gst-calculator)

## Installation

You can install the package via composer:

```bash
composer require gaurangsharma/gst-calculator
```

## Usage

```php
use Gaurang\GstCalculator\Calculator;

echo Calculator::fromCost(100, 18)->getGst();

echo Calculator::fromCost(1000, 9)->getTotalWithGst();

```
New state functions :
```php

echo Calculator::stateData("HR", "DL")->getGstType();

echo Calculator::stateData("Haryana", "Delhi", 1020, 5)->getAllData();

```
stateData() accepts 4 arguements sourceState, destinationState, cost, rate.
* sourceState and destinationState can be a state code, state alpha code, or a state name


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Gaurang Sharma](https://github.com/gaurang-commits)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
