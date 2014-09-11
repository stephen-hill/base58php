<?php

namespace StephenHill\Benchmarks;

use Athletic\AthleticEvent;

class Base64Event extends AthleticEvent
{
    /**
	* @iterations 10000
	*/
    public function encodeBase64()
    {
        base64_encode('Hello World');
    }

    /**
	* @iterations 10000
	*/
    public function decodeBase64()
    {
        base64_decode('SGVsbG8gV29ybGQ=');
    }
}
