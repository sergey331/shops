<?php

namespace Kernel\Model\interface;

interface ModelWhereInterface
{
    public function setWhere($wheres): static;
    public function clearWhere(): static;
    public function setOrWhere($orWheres): static;

    public function setNotEquals($notEquals): static;

    public function setOrNotEquals($orNotEquals): static;

    public function setWhereNull(array $wheres): static;

    public function setWhereNotNull(array $wheres): static;

    public function setOrWhereNull(array $wheres): static;

    public function setOrWhereNotNull(array $wheres): static;

    public function setWhereIn(array $wheres): static;

    public function setWhereNotIn(array $wheres): static;
    public function setOrWhereIn(array $wheres): static;

    public function setOrWhereNotIn(array $wheres): static;

    public function setWhereDates(array $wheres): static;

    public function setWhereDateBetweens(array $wheres): static;

    public function setOrWhereDates(array $wheres): static;

    public function setOrWhereDateBetweens(array $wheres): static;

    public function setWhereDateNotBetweens(array $wheres): static;

    public function setOrWhereDateNotBetweens(array $wheres): static;

    public function setWhereDateOperators(array $wheres): static;

    public function setOrWhereDateOperators(array $wheres): static;

    public function resolve(): static;

    public function getWhereQuery(): string;

    public function getWhereData(): array;
}