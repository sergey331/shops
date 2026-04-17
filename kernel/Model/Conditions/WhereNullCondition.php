<?php

namespace Kernel\Model\Conditions;

use Kernel\Model\interface\ConditionInterface;

class WhereNullCondition implements ConditionInterface
{

    public function __construct(
        private readonly string $field,
        private readonly string $value
    ) {}

    public function toSql(): string
    {
        return "{$this->field} IS NULL";
    }

    public function getData(): array
    {
        return [$this->value];
    }
}