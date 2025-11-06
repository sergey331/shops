<?php

namespace Kernel\Migration\interface;

use Kernel\Migration\Fields;

interface FieldsInterface
{
    public function dropColumn($column): static;
    public function dropRelation($column): static;

    public function id(): Fields;

    public function string(string $name, int $length = 255): static;

    public function text(string $name): static;

    public function mediumText(string $name): static;

    public function longText(string $name): static;

    public function char(string $name, int $length = 1): static;

    public function uuid(string $name): static;

    public function json(string $name): static;

// Integer types
    public function integer(string $name): static;

    public function int(string $name): static;

    public function smallInt(string $name): static;

    public function mediumInt(string $name): static;

    public function bigInt(string $name): static;

    public function tinyInt(string $name): static;

    public function boolean(string $name): static;

    public function float(string $name): static;

    public function double(string $name): static;

    public function decimal(string $name, int $precision = 10, int $scale = 2): static;

    public function date(string $name): static;

    public function datetime(string $name): static;

    public function timestamp(string $name): static;

    public function time(string $name): static;

    public function year(string $name): static;

    public function binary(string $name): static;

    public function varBinary(string $name): static;

    public function blob(string $name): static;

// Enum / Set
    public function enum(string $name, array $options): static;

    public function set(string $name, array $options): static;

    public function relations($name);

    public function references($references);

    public function on($on);

    public function onDelete(string $action): static;

    public function onUpdate(string $action): static;

    public function nullable(): static;

    public function default($value): static;

    public function autoIncrement(): static;

    public function primary(): static;

    public function unique(): static;

    public function createdTimestamp(): static;

    public function updatedTimestamp(): static;

    public function getFields(): array;

    public function getDroppedFields(): array;

    public function getDropRelations(): array;

    public function after($column): static;

    public function change($column = true): static;

}