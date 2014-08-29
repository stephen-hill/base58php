<?php

namespace StephenHill;

use InvalidArgumentException;

class Base58
{
    protected $alphabet;
    protected $base;

    public function __construct($alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz')
    {
        if (is_string($alphabet) === false) {
            throw new InvalidArgumentException('Argument $alphabet must be a string.');
        }

        if (strlen($alphabet) !== 58) {
            throw new InvalidArgumentException('Argument $alphabet must contain 58 characters.');
        }

        $this->alphabet = $alphabet;
        $this->base = strlen($alphabet);
    }

    /**
     * @param  string $string The string you wish to encode.
     * @return string The Base58 encoded string.
     */
    public function encode($string)
    {
        if (is_string($string) === false) {
            throw new InvalidArgumentException('Argument $string must be a string.');
        }

        if (strlen($string) === 0) {
            return '';
        }

        // Strings in PHP are essentially 8-bit byte arrays
        // so lets convert the string into a PHP array
        $bytes = unpack('C*', $string);

        // Now we need to convert the byte array into an arbitrary-precision decimal.
        // This loop concatinates the bytes together and then performs a
        // base2 to base10 conversion.
        // http://en.wikipedia.org/wiki/Positional_notation#Base_conversion
        $decimal = '0';
        for ($i = 1, $l = strlen($string); $i <= $l; $i++) {
            $power = bcpow(2, ($l - $i) * 8);
            $shifted = bcmul($bytes[$i], $power);
            $decimal = bcadd($decimal, $shifted);
        }

        // This loop now performs base 10 to base 58 conversion
        // The remainder or modulo on each loop becomes a base 58 character
        $output = '';
        while ($decimal >= $this->base) {
            $div = bcdiv($decimal, $this->base);
            $mod = bcmod($decimal, $this->base);
            $output .= $this->alphabet[$mod];
            $decimal = $div;
        }

        // If there's still a remainder, append it
        if ($decimal > 0) {
            $output .= $this->alphabet[$decimal];
        }

        // Now we need to reverse the encoded data
        $output = strrev($output);

        // Now we need to append leading zeros
        foreach ($bytes as $byte) {
            if ($byte === 0) {
                $output = $this->alphabet[0] . $output;
                continue;
            }
            break;
        }

        return (string) $output;
    }

    /**
     * @param  string $base58 The base58 encoded string.
     * @return string Returns the decoded string.
     */
    public function decode($base58)
    {
        if (is_string($base58) === false) {
            throw new InvalidArgumentException('Argument $base58 must be a string.');
        }

        if (strlen($base58) === 0) {
            return '';
        }

        $indexes = array_flip(str_split($this->alphabet));
        $chars = str_split($base58);

        // Check for invalid characters in the supplied base58 string
        foreach ($chars as $char) {
            if (isset($indexes[$char]) === false){
                throw new InvalidArgumentException('Argument $base58 contains invalid characters.');
            }
        }

        $decimal = $indexes[$chars[0]];

        for ($i = 1; $l = count($chars), $i < $l; $i++) {
            $decimal = bcmul($decimal, 58);
            $decimal = bcadd($decimal, $indexes[$chars[$i]]);
        }

        $output = '';
        while ($decimal > 0) {
            $byte = bcmod($decimal, 256);
            $output = pack('C', $byte) . $output;
            $decimal = bcdiv($decimal, 256);
        }

        foreach ($chars as $char) {
            if ($indexes[$char] === 0) {
                $output = "\x00" . $output;
                continue;
            }
            break;
        }

        return $output;
    }
}
