<?php

namespace Kernel\Seeder\interface;

use Kernel\Databases\Db;

interface SeederInterface
{
    public function model($name);
}