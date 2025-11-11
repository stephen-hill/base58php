# Base58 Encoding and Decoding Library for PHP

[![Packagist Release](http://img.shields.io/packagist/v/stephenhill/base58.svg)](https://packagist.org/packages/stephenhill/base58)
[![MIT License](http://img.shields.io/packagist/l/stephenhill/base58.svg)](https://github.com/stephen-hill/base58php/blob/master/license)
[![Action Status](https://github.com/stephen-hill/base58php/actions/workflows/php.yml/badge.svg)](https://github.com/stephen-hill/base58php/actions/workflows/php.yml)

## Long Term Support

Each major version of this library will be supported for 5 years after it's initial release. Support will be provided for security and bug fixes.

- Version 2 will be supported until the 1st Janurary 2031.
- Version 1 support expired on the 11th September 2019.

## Background

I wanted a replacement for Base64 encoded strings and the [Base58 encoding used by Bitcoin](https://en.bitcoin.it/wiki/Base58Check_encoding) looked ideal. I looked around for an existing PHP library which would directly convert a string into Base58 but I couldn't find one, or at least one that worked correctly and was also well tested.

So I decided to create a library with the following goals:

- Encode/Decode PHP Strings
- Simple and easy to use
- Fully Tested
- Available via Composer

## Requirements

This library has the following requirements:

- PHP => 8.1
- GMP or BC Math Extension

## Installation

I recommend you install this library via Composer.

```json
{
    "require": {
        "stephenhill/base58": "~2.0"
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

## Contributing

I welcome everyone to contribute to this library. Please see the Contributing document for details.

## License

This library is license under the MIT License (MIT). Please see License File for more information.

## Credits

This library was forked from [Jeremy Johnstone's](https://github.com/jsjohnst) Base58 methods on Gist https://gist.github.com/jsjohnst/126883.

Some of the unit tests were based on the following:

- https://code.google.com/p/bitcoinj/source/browse/core/src/test/java/com/google/bitcoin/core/Base58Test.java
- https://github.com/bitcoinjs/bitcoinjs-lib/blob/master/test/fixtures/base58.json

In no particular order, I would like to thank the following for pushing me to release a PHP 8 compatible version: @git-marijus, @VandalorumRex, @bacheson, @kalifg
