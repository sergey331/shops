<?php

namespace Kernel\Model;

interface ModelInterface
{
    // Retrieval methods
    public function all(): array;
    public function get(): array;
    public function first();
    public function find($id);

    // Data manipulation methods
    public function create(array $data);
    public function update(array $data);
    public function delete();
    public function fill(array $data);
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
}
