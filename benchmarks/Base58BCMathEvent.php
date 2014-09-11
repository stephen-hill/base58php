<?php

namespace StephenHill\Benchmarks;

use Athletic\AthleticEvent;
use StephenHill\Base58;
use StephenHill\BCMathService;

class Base58BCMathEvent extends AthleticEvent
{
    protected $base58;

    public function setUp()
    {
        $this->base58 = new Base58(null, new BCMathService());
    }

    /**
	* @iterations 10000
	*/
    public function encodeBase58()
    {
        $this->base58->encode('Hello World');
    }

    /**
	* @iterations 10000
	*/
    public function decodeBase58()
    {
        $this->base58->decode('JxF12TrwUP45BMd');
    }
}
