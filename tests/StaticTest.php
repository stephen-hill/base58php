<?php

use StephenHill\StaticBase58;

class StaticTests extends PHPUnit_Framework_TestCase
{
    public function testStaticClass()
    {
        $this->assertSame('JxF12TrwUP45BMd', StaticBase58::encode('Hello World'));
        $this->assertSame('Hello World', StaticBase58::decode('JxF12TrwUP45BMd'));
    }

    public function testNamespacelessClass()
    {
        $this->assertTrue(class_exists('Base58', true));
        $this->assertSame('JxF12TrwUP45BMd', Base58::encode('Hello World'));
        $this->assertSame('Hello World', Base58::decode('JxF12TrwUP45BMd'));
    }

    public function testFunctions()
    {
        $this->assertTrue(function_exists('base58_encode'));
        $this->assertTrue(function_exists('base58_decode'));
        $this->assertSame('JxF12TrwUP45BMd', base58_encode('Hello World'));
        $this->assertSame('Hello World', base58_decode('JxF12TrwUP45BMd'));
    }
}
