<?php

use StephenHill\Base58;
use StephenHill\BCMathService;
use StephenHill\GMPService;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class Base58Test extends TestCase
{
    #[DataProvider('encodingsProvider')]
    public function testEncode(string $string, string $encoded, Base58 $instance): void
    {
        $this->assertSame($encoded, $instance->encode($string));
    }

    #[DataProvider('encodingsProvider')]
    public function testDecode(string $string, string $encoded, Base58 $instance): void
    {
        $this->assertSame($string, $instance->decode($encoded));
    }

    public static function encodingsProvider(): array
    {
        $instances = [
            new Base58(null, new BCMathService()),
            new Base58(null, new GMPService()),
        ];

        $tests = [
            ['', ''],
            ['1', 'r'],
            ['a', '2g'],
            ['bbb', 'a3gV'],
            ['ccc', 'aPEr'],
            ['hello!', 'tzCkV5Di'],
            ['Hello World', 'JxF12TrwUP45BMd'],
            ['this is a test', 'jo91waLQA1NNeBmZKUF'],
            ['the quick brown fox', 'NK2qR8Vz63NeeAJp9XRifbwahu'],
            ['THE QUICK BROWN FOX', 'GRvKwF9B69ssT67JgRWxPQTZ2X'],
            ['simply a long string', '2cFupjhnEsSn59qHXstmK2ffpLv2'],
            ["\x00\x61", '12g'],
            ["\x00", '1'],
            ["\x00\x00", '11'],
            ['0248ac9d3652ccd8350412b83cb08509e7e4bd41', '3PtvAWwSMPe2DohNuCFYy76JhMV3rhxiSxQMbPBTtiPvYvneWu95XaY'],
        ];

        $return = [];
        foreach ($instances as $instance) {
            foreach ($tests as $test) {
                $test[] = $instance;
                $return[] = $test;
            }
        }

        return $return;
    }

    public function testConstructorLengthException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument $alphabet must contain 58 characters.');

        new Base58('');
    }

    public function testInvalidBase58(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Argument $base58 contains invalid characters.');

        $base58 = new Base58();
        $base58->decode("This isn't valid base58");
    }
}
