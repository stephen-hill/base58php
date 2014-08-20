<?php

use StephenHill\Base58;

class ClassNameTest extends PHPUnit_Framework_TestCase
{
	protected $stringTests;
	protected $intergerTests;

	public function setup()
	{
		$this->stringTests = array(
			'2g' => 'a',
			'a3gV' => 'bbb',
			'aPEr' => 'ccc',
			'tzCkV5Di' => 'hello!',
			'JxF12TrwUP45BMd' => 'Hello World',
			'' => '',
			'2cFupjhnEsSn59qHXstmK2ffpLv2' => 'simply a long string',
			'1' => "\x00",
			'jo91waLQA1NNeBmZKUF' => 'this is a test'
		);

		$this->intergerTests = array(
			'N' => '21',
			's' => '50',
			'2sidE' => '21212121',
			'16Ho7Hs' => '3471844090'
		);
	}

	public function testEncodeInteger()
	{
		$base58 = new Base58();

		foreach($this->intergerTests as $encoded => $integer)
		{
			$this->assertSame($encoded, $base58->encodeInteger($integer));
		}
	}

	public function testEncode()
	{
		$base58 = new Base58();

		foreach ($this->stringTests as $encoded => $string)
		{
			$this->assertSame($encoded, $base58->encode($string));
		}
	}
}