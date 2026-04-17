<?php

namespace Kernel\Model\Conditions;

use Kernel\Model\interface\ConditionInterface;

class WhereInCondition implements ConditionInterface
{

    public function __construct(
        private readonly string $field,
        private readonly string $value
    ) {}

    public function toSql(): string
    {
        return "{$this->field} IN ?";
    }

    public function getData(): array
    {
        return [$this->value];
    }
}