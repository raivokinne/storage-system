<?php

namespace Core;

use Exception;

class Container
{
    protected $bindings = [];
    /**
     * @return void
     * @param mixed $key
     * @param mixed $resolver
     */
    public function bind($key, $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * @throws Exception* @return mixed

     * @param mixed $key
     */
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
