<?php

namespace Kernel\Model\Trait;

trait Pluck
{
    public function pluck(string $valueKey): array
    {

        $keys = explode('.', $valueKey);
        $data = count($keys) === 2 ? $this->data[$keys[0]] : $this->data;
        $key = count($keys) === 2 ? $keys[1] : $valueKey;

        $results = [];
        foreach ($data as $item) {
            $value = null;
            if (is_object($item)) {
                $value = $item->{$key} ?? null;
            } elseif (is_array($item)) {
                $value = $item[$key] ?? null;
            }
            $results[] = $value;
        }

        return $results;
    }
}