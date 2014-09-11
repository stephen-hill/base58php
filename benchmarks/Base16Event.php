<?php

namespace StephenHill\Benchmarks;

use Athletic\AthleticEvent;

class Base16Event extends AthleticEvent
{
    /**
	* @iterations 10000
	*/
    public function encodeBase16()
    {
        bin2hex('Hello World');
    }

    /**
	* @iterations 10000
	*/
    public function decodeBase16()
    {
        pack('H*', '48656c6c6f20576f726c64');
    }
}
