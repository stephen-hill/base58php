<?php

use StephenHill\Base58;

class Base58Tests extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider encodingsProvider
     */
    public function testEncode($string, $encoded)
    {
        $string = (string)$string;
        $encoded = (string)$encoded;

        $base58 = new Base58();

        $this->assertSame($encoded, $base58->encode($string));
    }

    /**
     * @dataProvider encodingsProvider
     */
    public function testDecode($string, $encoded)
    {
        $base58 = new Base58();

        $string = (string) $string;
        $encoded = (string) $encoded;

        $this->assertSame($string, $base58->decode($encoded));
    }

    public function encodingsProvider()
    {
        return array(
            array('', ''),
            array('1', 'r'),
            array('a', '2g'),
            array('bbb', 'a3gV'),
            array('ccc', 'aPEr'),
            array('hello!', 'tzCkV5Di'),
            array('Hello World', 'JxF12TrwUP45BMd'),
            array('this is a test', 'jo91waLQA1NNeBmZKUF'),
            array('the quick brown fox', 'NK2qR8Vz63NeeAJp9XRifbwahu'),
            array('THE QUICK BROWN FOX', 'GRvKwF9B69ssT67JgRWxPQTZ2X'),
            array('simply a long string', '2cFupjhnEsSn59qHXstmK2ffpLv2'),
            array("\x00\x61", '12g'),
            array("\x00", '1'),
            array("\x00\x00", '11')
        );
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Argument $alphabet must be a string.
     */
    public function testConstructorTypeException()
    {
        new Base58(intval(123));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Argument $alphabet must contain 58 characters.
     */
    public function testConstructorLengthException()
    {
        new Base58('');
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Argument $string must be a string.
     */
    public function testEncodeTypeException()
    {
        $base58 = new Base58();
        $base58->encode(intval(123));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Argument $base58 must be a string.
     */
    public function testDecodeTypeException()
    {
        $base58 = new Base58();
        $base58->decode(intval(123));
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Argument $base58 contains invalid characters.
     */
    public function testInvalidBase58()
    {
        $base58 = new Base58();
        $base58->decode("This isn't valid base58");
    }
}
