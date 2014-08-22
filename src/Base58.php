<?php

namespace StephenHill;

use InvalidArgumentException;

class Base58
{
	protected $alphabet;

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
	}

	/**
	 * Convert a string (aka byte array) to an arbitrary-precision decimal
	 *
	 * @param string $string String to be converted
	 * @return string Arbitrary-precision decimal
	 */
	public function stringToDecimal($string)
	{
		if (is_string($string) === false)
		{
			throw new InvalidArgumentException('Argument $string must be of type string.');
		}

		$characters = unpack('C*', $string);
		$length = count($characters);
		$decimal = '0';

		for ($i = 1; $i <= $length; $i++)
		{
			$power = bcpow(2, ($length - $i) * 8);
			$shifted = bcmul($characters[$i], $power);
			$decimal = bcadd($decimal, $shifted);
		}

		return (string)$decimal;
	}

	public function encodeDecimal($decimal)
	{
		if (is_string($decimal) === false)
		{
			throw new InvalidArgumentException('Argument $decimal must be of type string.');
		}

		$base = strlen($this->alphabet);
		$output = '';

		$leadingZeroCount = 0;
		foreach (str_split($decimal) as $numeral)
		{
			if ($numeral === '0')
			{
				$leadingZeroCount++;
				continue;
			}

			break;
		}

		while($decimal >= $base)
		{
			$div = bcdiv($decimal, $base);
			$mod = bcmod($decimal, $base);
			$output .= $this->alphabet[$mod];
			$decimal = $div;
		}

		if ($decimal > 0)
		{
			$output .= $this->alphabet[$decimal];
		}

		$output = str_repeat($this->alphabet[0], $leadingZeroCount) . $output;

		return strrev($output);
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

		$decimal = $this->stringToDecimal($string);
		$encoded = $this->encodeDecimal($decimal);

		return (string)$encoded;
	}

	// public function decode($base58) {
	// 	$int_val = 0;
	// 	for($i=strlen($base58)-1,$j=1,$base=strlen(self::$alphabet);$i>=0;$i--,$j*=$base) {
	// 		$int_val += $j * strpos(self::$alphabet, $base58{$i});
	// 	}
	// 	return $int_val;
	// }
}

