<?php

namespace StephenHill;

use InvalidArgumentException;

class Base58
{
	protected $alphabet;
	protected $base;

	public function __construct($alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz')
	{
		if (is_string($alphabet) === false)
		{
			throw new InvalidArgumentException('Argument $alphabet must be a string.');
		}

		if (strlen($alphabet) !== 58)
		{
			throw new InvalidArgumentException('Argument $alphabet must contain 58 characters.');
		}

		$this->alphabet = $alphabet;
		$this->base = strlen($alphabet);
	}

	/**
	 * @param string $string The string you wish to encode.
	 * @return string The Base58 encoded string.
	 */
	public function encode($string)
	{
		if (is_string($string) === false)
		{
			throw new InvalidArgumentException('Argument $alphabet must be a string.');
		}

		if (strlen($string) === 0)
		{
			return '';
		}

		// Strings in PHP are essentially 8-bit byte arrays
		// so lets convert the string into a PHP array
		$bytes = unpack('C*', $string);

		// Now we need to convert the byte array into an arbitrary-precision decimal.
		// This for loop essentially performs a base 8 to base 10 converion
		// http://en.wikipedia.org/wiki/Positional_notation#Base_conversion
		$decimal = '0';
		for ($i = 1, $l = strlen($string); $i <= $l; $i++)
		{
			$power = bcpow(2, ($l - $i) * 8);
			$shifted = bcmul($bytes[$i], $power);
			$decimal = bcadd($decimal, $shifted);
		}

		// This loop now performs base 10 to base 58 conversion
		$output = '';
		while($decimal >= $this->base)
		{
			$div = bcdiv($decimal, $this->base);
			$mod = bcmod($decimal, $this->base);
			$output .= $this->alphabet[$mod];
			$decimal = $div;
		}

		if ($decimal > 0)
		{
			$output .= $this->alphabet[$decimal];
		}

		$output = strrev($output);

		// Now we need to handle leading zeros
		foreach ($bytes as $byte)
		{
			if ($byte === 0)
			{
				$output = $this->alphabet[0] . $output;
				continue;
			}

			break;
		}

		return (string)$output;
	}

	public function decode($base58)
	{
		return null;
	}
}