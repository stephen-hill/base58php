<?php

use StephenHill\Base58;

class Base58Tests extends PHPUnit_Framework_TestCase
{
	protected $tests;

	public function setup()
	{
		$this->tests = array(
			'' => '',
			'r' => '1',
			'2g' => 'a',
			'12g' => "\x00\x61",
			'1' => "\x00",
			'11' => "\x00\x00",
			'a3gV' => 'bbb',
			'aPEr' => 'ccc',
			'tzCkV5Di' => 'hello!',
			'JxF12TrwUP45BMd' => 'Hello World',
			'jo91waLQA1NNeBmZKUF' => 'this is a test',
			'NK2qR8Vz63NeeAJp9XRifbwahu' => 'the quick brown fox',
			'GRvKwF9B69ssT67JgRWxPQTZ2X' => 'THE QUICK BROWN FOX',
			'2cFupjhnEsSn59qHXstmK2ffpLv2' => 'simply a long string'
		);
	}

	public function testEncode()
	{
		$base58 = new Base58();

		foreach ($this->tests as $encoded => $string)
		{
			$string = (string)$string;
			$encoded = (string)$encoded;

			$this->assertSame($encoded, $base58->encode($string), "Testing {$string} encodes to {$encoded}.");
		}
	}

	public function testDecode()
	{
		$base58 = new Base58();

		foreach ($this->tests as $encoded => $string)
		{
			$string = (string)$string;
			$encoded = (string)$encoded;

			$this->assertSame($string, $base58->decode($encoded), "Testing {$encoded} decodes to {$string}.");
		}
	}
}