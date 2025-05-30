<?php

namespace Kernel\Model;

interface ModelInterface
{
    // Retrieval methods
    public function all(): array;
    public function get(): array;
    public function first(): null|static;
    public function find($id): null|static;

    // Data manipulation methods
    public function create(array $data): static;
    public function update(array $data): bool;
    public function delete(): bool;
    public function fill(array $data): void;
    public function save(bool $update = false);

    // Where clause methods
    public function where(array $wheres): static;
    public function orWhere(array $wheres): static;

    // NULL condition methods
    public function whereNull(array $columns): static;
    public function whereNotNull(array $columns): static;
    public function orWhereNull(array $columns): static;
    public function orWhereNotNull(array $columns): static;

    // Comparison methods
    public function whereNotEqual(array $conditions): static;
    public function orWhereNotEqual(array $conditions): static;

    // IN/NOT IN condition methods
    public function whereIn(array $conditions): static;
    public function whereNotIn(array $conditions): static;
    public function orWhereIn(array $conditions): static;
    public function orWhereNotIn(array $conditions): static;

    public function whereDate(array $conditions): static;
    public function orWhereDate(array $conditions): static;
    public function whereDateBeetwen(array $conditions): static;
    public function orWhereDateBeetwen(array $conditions): static;
    public function whereDateNotBeetwen(array $conditions): static;
    public function orWhereDateNotBeetwen(array $conditions): static;
    public function whereDateOperators(array $conditions): static;
    public function orWhereDateOperators(array $conditions): static;

    public function orderBy(string|array $column, string $direction = 'ASC'): static;


    public function groupBy(string|array $column): static;

    public function limit(int $limit): static;
}
