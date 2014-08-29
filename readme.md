# Base58 Encoding and Decoding Library for PHP

[![Build Status](https://travis-ci.org/stephen-hill/base58php.png)](https://travis-ci.org/stephen-hill/base58php)
[![GitHub version](https://badge.fury.io/gh/stephen-hill%2Fbase58php.png)](http://badge.fury.io/gh/stephen-hill%2Fbase58php)

## Requirements

This library requires the following:

- PHP => 5.3
- BC Math Extension

## Usage

```php
require_once('vendor/autoload.php');

$base58 = new StephenHill\Base58();

$base58->encode('Hello World');
$base58->decode('JxF12TrwUP45BMd');
```

## Contributing

I welcome everyone to contribute to this library.

## License

The MIT License (MIT). Please see License File for more information.

## Credits

This library was forked from [Jeremy Johnstone's](https://github.com/jsjohnst) Base58 methods on Gist https://gist.github.com/jsjohnst/126883.