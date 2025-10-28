<?php

namespace Kernel\Seeder;

use Kernel\Databases\Db;

class Seeder
{
    public function model($name)
    {
        $db = new Db();
        return $db->model($name);
    }
}