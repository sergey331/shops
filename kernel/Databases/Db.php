<?php

namespace Kernel\Databases;

class Db
{
    public function model($name)
    {
        $name = ucfirst($name);
        $class = "Shop\\model\\$name";
        if (class_exists($class)) {
            return new $class();
        }
        return false;
    }
}