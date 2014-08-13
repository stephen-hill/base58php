<?php

use StephenHill\Base58;

class ClassNameTest extends PHPUnit_Framework_TestCase
{
	public function testEncode()
	{
		$base58 = new Base58();

		$helloWorld = 'Hello World';
		$this->assertSame('JxF12TrwUP45BMd', $base58->encode($helloWorld));
	}
}