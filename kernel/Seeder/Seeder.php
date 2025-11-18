<?php

namespace Kernel\Seeder;

use Kernel\Databases\DbModel;
use Kernel\Seeder\interface\SeederInterface;

abstract class Seeder implements SeederInterface
{
    public function model($name)
    {
        $db = new DbModel();
        return $db->model($name);
    }
}