<?php

namespace Kernel\Seeder\interface;

use Kernel\Databases\DbModel;

interface SeederInterface
{
    public function model($name);
}