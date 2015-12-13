<?php

namespace StephenHill;

class StaticBase58
{
    protected static $instance;

    public static function encode($string)
    {
        return self::getInstance()->encode($string);
    }

    public static function decode($string)
    {
        return self::getInstance()->decode($string);
    }

    protected static function getInstance()
    {
        if (null === static::$instance)
        {
            static::$instance = new Base58();
        }

        return static::$instance;
    }
}
