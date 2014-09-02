# Base58 Encoding and Decoding Library for PHP

[![Build Status](https://travis-ci.org/stephen-hill/base58php.png)](https://travis-ci.org/stephen-hill/base58php)
[![Packagist Release](http://img.shields.io/packagist/v/stephenhill/base58.svg)](https://packagist.org/packages/stephenhill/base58)
[![MIT License](http://img.shields.io/packagist/l/stephenhill/base58.svg)](https://github.com/stephen-hill/base58php/blob/master/license)
[![Flattr this](https://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=stephen-hill&url=https%3A%2F%2Fgithub.com%2Fstephen-hill%2Fbase58php)

## Background

I wanted a replacment for Base64 encoded strings and the [Base58 encoding used by Bitcoin](https://en.bitcoin.it/wiki/Base58Check_encoding) looked ideal. I looked around for an existing PHP library which would directly convert a string into Base58 but I couldn't find one, or atleast one that worked correctly and was also well tested.

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

## Usage

```php
require_once('vendor/autoload.php');

$base58 = new StephenHill\Base58();

$base58->encode('Hello World');
$base58->decode('JxF12TrwUP45BMd');
```

## Testing

This library is tested using PHPUnit.

```bash
$ bin/phpunit
```

## Benchmarking

You can benchmark this library using [Athletic](https://github.com/polyfractal/athletic).
The benchmarking suite also benchmarks PHP's built-in Base64 and Base16 encoding for comparision.

```bash
$ bin/athletic -p benchmarks
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
