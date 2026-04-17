<?php

namespace Kernel\Model\interface;

interface ConditionInterface
{
    public function toSql(): string;
    public function getData(): array;
}