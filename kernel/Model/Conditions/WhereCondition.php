<?php

namespace Kernel\Model\Conditions;

use Kernel\Model\interface\ConditionInterface;

class WhereCondition implements ConditionInterface
{

    public function __construct(
        private readonly string $field,
        private readonly string $value
    ) {}

    public function toSql(): string
    {
        return "{$this->field} = ?";
    }

    public function getData(): array
    {
        return [$this->value];
    }
}