<?php 

namespace Kernel\Model;

interface ModelInterface
{
    public function all():array;
    public function get(): array;
    public function first();
    public function find($id);
    public function create(array $data);
    public function update(array $data);
    public function delete();
    public function fill(array $data);
    public function save($update = false);
    public function where(array $wheres): static;
    public function orWhere(array $orWheres): static;
    public function whereNull(array $column):static;
    public function whereNotNull(array $column):static;
    public function whereNotEqual(array $data): static;
    public function orWhereNotEqual(array $data): static;
    public function orWhereNull(array $column): static;
    public function orWhereNotNull(array $column): static;
    public function whereIn(array $data): static;
    public function whereNotIn(array $data): static;
    public function orWhereIn(array $data): static;
    public function orWhereNotIn(array $data): static;
}