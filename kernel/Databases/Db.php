<?php

namespace Kernel\Databases;

class Db
{
    public function model($name)
    {
        $class = "Shop\\model\\$name";
        if (class_exists($class)) {
            return new $class();
        }
        throw new \Exception("Model not found: " . $name);
    }
}