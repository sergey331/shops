<?php

namespace Kernel\Databases;

use Exception;
use Kernel\Model\Model;

class DB extends Model
{
    public function __construct(string $table = '')
    {
        parent::__construct();

        if ($table !== '') {
            $this->setTable($table);
        }
    }

    /**
     * Create a new DB instance for the given table.
     *
     * @throws Exception
     */
    public static function table(string $table): DB
    {
        if (trim($table) === '') {
            throw new Exception('Table name is required');
        }

        return new self($table);
    }

}