<?php

use StephenHill\Base58;

class Base58Tests extends PHPUnit_Framework_TestCase
{
	protected $binaryStringToDecimalTests;
	protected $stringTests;
	protected $intergerTests;

	public function setup()
	{
		$this->binaryStringToDecimalTests = array(
			'a' => '97',
			'bbb' => '6447714',
			'Hello World' => '87521618088882533792115812',
			'simply a long string' => '658885050385564465925592505944209249682185612903',
			'N' => '78',
			"\x00" => 0
		);

		$this->stringTests = array(
			'r' => '1',
			'2g' => 'a',
			'a3gV' => 'bbb',
			'aPEr' => 'ccc',
			'tzCkV5Di' => 'hello!',
			'JxF12TrwUP45BMd' => 'Hello World',
			'' => '',
			'2cFupjhnEsSn59qHXstmK2ffpLv2' => 'simply a long string',
			'1' => "\x00",
			'jo91waLQA1NNeBmZKUF' => 'this is a test',
			'NK2qR8Vz63NeeAJp9XRifbwahu' => 'the quick brown fox',
			'GRvKwF9B69ssT67JgRWxPQTZ2X' => 'THE QUICK BROWN FOX'
		);

		$this->intergerTests = array(
			'N' => '21',
			's' => '50',
			'1' => '0',
			'2sidE' => '21212121',
			'6Ho7Hs' => '3471844090'
		);
	}

	public function testStringToDecimal()
	{
		$base58 = new Base58();

		foreach($this->binaryStringToDecimalTests as $string => $decimal)
		{
			$string = (string)$string;
			$decimal = (string)$decimal;
			$this->assertSame($decimal, $base58->stringToDecimal($string));
		}
	}

	public function testEncodeDecimal()
	{
		$base58 = new Base58();

		foreach($this->intergerTests as $encoded => $decimal)
		{
			$decimal = (string)$decimal;
			$encoded = (string)$encoded;

			$this->assertSame($encoded, $base58->encodeDecimal($decimal));
		}
	}

	/**
	 * @depends testStringToDecimal
	 * @depends testEncodeDecimal
	 */
	public function testEncode()
	{
		$base58 = new Base58();

		foreach ($this->stringTests as $encoded => $string)
		{
			$string = (string)$string;
			$encoded = (string)$encoded;
			$this->assertSame($encoded, $base58->encode($string), "Testing {$string} encodes to {$encoded}.");
		}
	}
}