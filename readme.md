# Base58 Encoding and Decoding Library for PHP

[![Build Status](https://travis-ci.org/stephen-hill/base58php.png)](https://travis-ci.org/stephen-hill/base58php)
[![Packagist Release](http://img.shields.io/packagist/v/stephenhill/base58.svg)](https://packagist.org/packages/stephenhill/base58)
[![MIT License](http://img.shields.io/packagist/l/stephenhill/base58.svg)](https://github.com/stephen-hill/base58php/blob/master/license)
[![Flattr this](https://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=stephen-hill&url=https%3A%2F%2Fgithub.com%2Fstephen-hill%2Fbase58php)

## Long Term Support

Each major version of this library will be supported for 5 years after it's initial release. Support will be provided for security and bug fixes.

Version 1 will therefore be supported until the 11th September 2019.

## Background

I wanted a replacement for Base64 encoded strings and the [Base58 encoding used by Bitcoin](https://en.bitcoin.it/wiki/Base58Check_encoding) looked ideal. I looked around for an existing PHP library which would directly convert a string into Base58 but I couldn't find one, or at least one that worked correctly and was also well tested.

So I decided to create a library with the following goals:

- Encode/Decode PHP Strings
- Simple and easy to use
- Fully Tested
- Available via Composer

## Requirements

This library has the following requirements:

- PHP => 5.3
- BC Math Extension

## Installation

I recommend you install this library via Composer.

```json
{
    "require": {
        "stephenhill/base58": "~1.0"
    }
}
```

## Basic Usage

```php
require_once('vendor/autoload.php');

$base58 = new StephenHill\Base58();

$base58->encode('Hello World');
$base58->decode('JxF12TrwUP45BMd');
```

## Advanced Usage

By default this library chooses the encoding service provider to use, either GMPService or BCMathService (in that order).
If you want to specify one of the included services or your own, you can inject it into the constructor.

```php
require_once('vendor/autoload.php');

$gmp = new StephenHill\GMPService();
$base58 = new StephenHill\Base58(null, $gmp);

$base58->encode('Hello World');
$base58->decode('JxF12TrwUP45BMd');
```

Also by default, this library uses Bitcoin's Base58 alphabet. If you want to use another variant, you can do this in the constructor.

```php
require_once('vendor/autoload.php');

// Flickr's Base58 Alphabet
$base58 = new StephenHill\Base58('123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ');

$base58->encode('Hello World');
$base58->decode('iXf12sRWto45bmC');
```

## Testing

This library is tested using PHPUnit.

```bash
$ bin/phpunit
```

## Benchmarking

You can benchmark this library using [Athletic](https://github.com/polyfractal/athletic).
The benchmarking suite also benchmarks PHP's built-in Base64 and Base16 encoding for comparison.

```bash
$ bin/athletic -p benchmarks
```

Example output.

```
StephenHill\Benchmarks\Base16Event
    Method Name    Iterations    Average Time      Ops/second
    ------------  ------------  --------------    -------------
    encodeBase16: [10,000    ] [0.0000010839939] [922,514.40637]
    decodeBase16: [10,000    ] [0.0000011516809] [868,296.03561]


StephenHill\Benchmarks\Base58BCMathEvent
    Method Name    Iterations    Average Time      Ops/second
    ------------  ------------  --------------    -------------
    encodeBase58: [10,000    ] [0.0001500048161] [6,666.45263]
    decodeBase58: [10,000    ] [0.0001741812706] [5,741.14540]


StephenHill\Benchmarks\Base58GMPEvent
    Method Name    Iterations    Average Time      Ops/second
    ------------  ------------  --------------    -------------
    encodeBase58: [10,000    ] [0.0001168665648] [8,556.76730]
    decodeBase58: [10,000    ] [0.0001385705233] [7,216.54199]


StephenHill\Benchmarks\Base64Event
    Method Name    Iterations    Average Time      Ops/second
    ------------  ------------  --------------    -------------
    encodeBase64: [10,000    ] [0.0000009050369] [1,104,927.29189]
    decodeBase64: [10,000    ] [0.0000009787321] [1,021,730.04312]
```

## Contributing

I welcome everyone to contribute to this library. Please see the Contributing document for details.

## License

This library is license under the MIT License (MIT). Please see License File for more information.

## Credits

This library was forked from [Jeremy Johnstone's](https://github.com/jsjohnst) Base58 methods on Gist https://gist.github.com/jsjohnst/126883.

Some of the unit tests were based on the following:

- https://code.google.com/p/bitcoinj/source/browse/core/src/test/java/com/google/bitcoin/core/Base58Test.java
- https://github.com/bitcoinjs/bitcoinjs-lib/blob/master/test/fixtures/base58.json
