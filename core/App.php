<?php

namespace Core;

class App
{
    protected static $container;
    /**
     * @return void
     * @param mixed $container
     */
    public static function setContainer($container): void
    {
        static::$container = $container;
    }

    public static function container()
    {
        return static::$container;
    }
    /**
     * @return void
     * @param mixed $key
     * @param mixed $resolver
     */
    public static function bind($key, $resolver): void
    {
        static::container()->bind($key, $resolver);
    }
    /**
     * @param mixed $key
     */
    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}
