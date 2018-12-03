<?php

namespace StephenHill;

use InvalidArgumentException;

class PHPService implements ServiceInterface
{
    /**
     * @var string
     * @since v1.1.0
     */
    protected $alphabet;

    /**
     * @var int
     * @since v1.1.0
     */
    protected $base;

    /**
     * Constructor
     *
     * @param string $alphabet optional
     * @since v1.1.0
     */
    public function __construct($alphabet = null)
    {
        // Handle null alphabet
        if ($alphabet === null) {
            $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        }

        // Type validation
        if (\is_string($alphabet) === false) {
            throw new InvalidArgumentException('Argument $alphabet must be a string.');
        }

        // The alphabet must contain 58 characters
        if (\strlen($alphabet) !== 58) {
            throw new InvalidArgumentException('Argument $alphabet must contain 58 characters.');
        }

        $this->alphabet = $alphabet;
        $this->base = \strlen($alphabet);
    }
    /**
     * Encode a string into base58.
     *
     * @param  string $string The string you wish to encode.
     * @since Release v1.1.0
     * @return string The Base58 encoded string.
     */
    public function encode($string): string
    {
        // Type validation
        if (\is_string($string) === false) {
            throw new InvalidArgumentException('Argument $string must be a string.');
        }

        // If the string is empty, then the encoded string is obviously empty
        if ($string === '') {
            return '';
        }

        // Strings in PHP are essentially 8-bit byte arrays
        // so lets convert the string into a PHP array
        $bytes = array_values(unpack('C*', $string));

        $leadingZerosNeeded = 0;
        foreach ($bytes as $byte) {
            if ($byte !== 0) {
                break;
            }

            $leadingZerosNeeded++;
        }

        $source = \array_slice($bytes, $leadingZerosNeeded);
        $result = $this->convertBase($source, 256, 58);

        // Count existing leading zeros
        $leadingZeroCount = 0;
        foreach ($result as $digit) {
            if ($digit !== 0) {
                break;
            }

            $leadingZeroCount++;
        }

        // Now we need to add any missing leading zeros
        for ($i = $leadingZeroCount; $i < $leadingZerosNeeded; $i++) {
            array_unshift($result, 0);
        }

        // Encode to a string
        return implode('', array_map(function ($ord) { return $this->alphabet[$ord]; }, $result));
    }

    /**
     * Decode base58 into a PHP string.
     *
     * @param  string $base58 The base58 encoded string.
     * @since Release v1.1.0
     * @return string Returns the decoded string.
     */
    public function decode($base58): string
    {
        // Type Validation
        if (\is_string($base58) === false) {
            throw new InvalidArgumentException('Argument $base58 must be a string.');
        }

        // If the string is empty, then the decoded string is obviously empty
        if ($base58 === '') {
            return '';
        }

        $indexes = array_flip(str_split($this->alphabet));
        $chars = str_split($base58);
        $digits = [];

        // Check for invalid characters in the supplied base58 string
        foreach ($chars as $char) {
            if (isset($indexes[$char]) === false) {
                throw new InvalidArgumentException('Argument $base58 contains invalid characters. ($char: "'.$char.'" | $base58: "'.$base58.'") ');
            }

            $digits[] = $indexes[$char];
        }

        $leadingZerosNeeded = 0;
        foreach ($digits as $digit) {
            if ($digit !== 0) {
                break;
            }

            $leadingZerosNeeded++;
        }

        $source = \array_slice($digits, $leadingZerosNeeded);
        $result = $this->convertBase($source, 58, 256);

        // Count existing leading zeros
        $leadingZeroCount = 0;
        foreach ($result as $digit) {
            if ($digit !== 0) {
                break;
            }

            $leadingZeroCount++;
        }

        // Now we need to add any missing leading zeros
        for ($i = $leadingZeroCount; $i < $leadingZerosNeeded; $i++) {
            array_unshift($result, 0);
        }

        // Encode to a string
        return implode('', array_map('\chr', $result));
    }

    /**
     * Basic manual base conversion algorithm,
     * @see https://en.wikipedia.org/wiki/Positional_notation#Base_conversion
     **/
    private function convertBase(array $digits, int $base1, int $base2): array
    {
        $result = [];

        do {
            $digitCount = \count($digits);
            $quotient = [];
            $remainder = 0;

            for ($i = 0; $i < $digitCount; $i++) {
                $dividend = $remainder * $base1 + $digits[$i];
                $quotient[] = intdiv($dividend, $base2);
                $remainder = $dividend % $base2;
            }

            $result[] = $remainder;
            $digits = $quotient;
        } while (array_sum($quotient) > 0);

        // Now we need to reverse the results
        return array_reverse($result);
    }
}
