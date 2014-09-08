<?php

namespace StephenHill;

interface ServiceInterface
{
    /**
     * Encode a string into base58.
     *
     * @param  string $string The string you wish to encode.
     * @since v1.1.0
     * @return string The Base58 encoded string.
     */
    public function encode($string);

    /**
     * Decode base58 into a PHP string.
     *
     * @param  string $base58 The base58 encoded string.
     * @since v1.1.0
     * @return string Returns the decoded string.
     */
    public function decode($base58);
}
