<?php

namespace Kernel\Migration;

class Fields
{
    private array $fields = [];
    protected array $droppedFields = [];
    private array $types = [
        // String types
        'string' => 'varchar',
        'text' => 'text',
        'mediumText' => 'mediumtext',
        'longText' => 'longtext',
        'char' => 'char',
        'uuid' => 'char(36)',
        'json' => 'json',

        // Integer types
        'integer' => 'int',
        'int' => 'int',
        'smallint' => 'smallint',
        'tinyint' => 'tinyint',
        'mediumint' => 'mediumint',
        'bigint' => 'bigint',

        // Boolean
        'boolean' => 'tinyint(1)',

        // Float/Decimal
        'float' => 'float',
        'double' => 'double',
        'decimal' => 'decimal',

        // Date and Time
        'date' => 'date',
        'datetime' => 'datetime',
        'timestamp' => 'timestamp',
        'time' => 'time',
        'year' => 'year',

        // Binary
        'binary' => 'blob',
        'varbinary' => 'varbinary',
        'blob' => 'blob',

        // Miscellaneous
        'enum' => 'enum',
        'set' => 'set',
    ];

    public function dropColumn($column)
    {
        $this->droppedFields[] = $column;
        return $this;
    }

    public function id()
    {
        return $this->setField('id', 'integer', 11)
            ->primary()
            ->autoIncrement();
    }

    public function string(string $name, int $length = 255): static
    {
        return $this->setField($name, 'string', $length);
    }

    public function text(string $name): static
    {
        return $this->setField($name, 'text', null);
    }

    public function mediumText(string $name): static
    {
        return $this->setField($name, 'mediumText', null);
    }

    public function longText(string $name): static
    {
        return $this->setField($name, 'longText', null);
    }

    public function char(string $name, int $length = 1): static
    {
        return $this->setField($name, 'char', $length);
    }

    public function uuid(string $name): static
    {
        return $this->setField($name, 'uuid', 36);
    }

    public function json(string $name): static
    {
        return $this->setField($name, 'json', null);
    }

// Integer types
    public function integer(string $name): static
    {
        return $this->setField($name, 'integer', null);
    }

    public function int(string $name): static
    {
        return $this->integer($name);
    }

    public function smallInt(string $name): static
    {
        return $this->setField($name, 'smallint', null);
    }

    public function mediumInt(string $name): static
    {
        return $this->setField($name, 'mediumint', null);
    }

    public function bigInt(string $name): static
    {
        return $this->setField($name, 'bigint', null);
    }

    public function tinyInt(string $name): static
    {
        return $this->setField($name, 'tinyint', null);
    }

    public function boolean(string $name): static
    {
        return $this->setField($name, 'boolean', 1);
    }

    public function float(string $name): static
    {
        return $this->setField($name, 'float', null);
    }

    public function double(string $name): static
    {
        return $this->setField($name, 'double', null);
    }

    public function decimal(string $name, int $precision = 10, int $scale = 2): static
    {
        return $this->setField($name, 'decimal', [$precision, $scale]);
    }


    public function date(string $name): static
    {
        return $this->setField($name, 'date', null);
    }

    public function datetime(string $name): static
    {
        return $this->setField($name, 'datetime', null);
    }

    public function timestamp(string $name): static
    {
        return $this->setField($name, 'timestamp', null);
    }

    public function time(string $name): static
    {
        return $this->setField($name, 'time', null);
    }

    public function year(string $name): static
    {
        return $this->setField($name, 'year', null);
    }


    public function binary(string $name): static
    {
        return $this->setField($name, 'binary', null);
    }

    public function varBinary(string $name): static
    {
        return $this->setField($name, 'varbinary', null);
    }

    public function blob(string $name): static
    {
        return $this->setField($name, 'blob', null);
    }

// Enum / Set
    public function enum(string $name, array $options): static
    {
        return $this->setField($name, 'enum', $options);
    }

    public function set(string $name, array $options): static
    {
        return $this->setField($name, 'set', $options);
    }

    public function relations($name)
    {
        $this->setField($name, 'integer');
        return $this;
    }

    public function references($references)
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['relations']['references'] = $references;
        }
        return $this;
    }

    public function on($on)
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['relations']['on'] = $on;
        }
        return $this;
    }


    public function onDelete(string $action): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['relations']['onDelete'] = strtoupper($action);
        }
        return $this;
    }

    public function onUpdate(string $action): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['relations']['onUpdate'] = strtoupper($action);
        }
        return $this;
    }

    public function nullable(): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['nullable'] = true;
        }
        return $this;
    }

    public function default($value): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['default'] = $value;
        }
        return $this;
    }

    public function autoIncrement(): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['autoIncrement'] = true;
        }
        return $this;
    }

    public function primary(): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['primary'] = true;
        }
        return $this;
    }

    public function unique(): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['unique'] = true;
        }
        return $this;
    }

    public function createdTimestamp(): static
    {
        $this->setField('created_at', 'timestamp')
            ->default('CURRENT_TIMESTAMP');
        $this->setField('updated_at', 'timestamp')
            ->default('CURRENT_TIMESTAMP')
            ->updatedTimestamp();

        return $this;
    }

    public function updatedTimestamp(): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['onUpdate'] = 'CURRENT_TIMESTAMP';
        }
        return $this;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getDroppedFields(): array
    {
        return $this->droppedFields;
    }

    public function after($column): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['after'] = $column;
        }
        return $this;
    }

    public function change($column = true): static
    {
        if (!empty($this->fields)) {
            $lastIndex = count($this->fields) - 1;
            $this->fields[$lastIndex]['changed'] = $column;
        }
        return $this;
    }

    private function setField(string $name, string $type, mixed $length = null): static
    {
        $this->fields[] = [
            'name' => $name,
            'type' => $this->types[$type],
            'length' => $length,
            'relations' => [],
            'nullable' => false,
            'autoIncrement' => false,
            'primary' => false,
            'unique' => false,
            'default' => null,
            'after' => '',
            'onUpdate' => '',
            'changed' => false,
        ];
        return $this;
    }

}