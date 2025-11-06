<?php

namespace Kernel\Seeder;

use Kernel\Databases\Db;
use Kernel\Seeder\interface\SeederInterface;

abstract class Seeder implements SeederInterface
{
    public function model($name)
    {
        $db = new Db();
        return $db->model($name);
    }
}