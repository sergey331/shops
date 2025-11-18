<?php

namespace Kernel\Table;

class Table
{
    protected array $data = [];
    protected array $columns = [];

    protected array $tableAttrs = [];
    protected array $theadAttrs = [];
    protected array $tbodyAttrs = [];
    protected array $trAttrs = [];
    protected array $thAttrs = [];
    protected array $tdAttrs = [];

    public function __construct(array $data = [], array $columns = [])
    {
        $this->data = $data;
        $this->columns = $columns;
    }

// ---------------------- Attribute setters ----------------------
    public function setTableAttributes(array $attrs): static
    {
        $this->tableAttrs = $attrs;
        return $this;
    }

    public function setTheadAttributes(array $attrs): static
    {
        $this->theadAttrs = $attrs;
        return $this;
    }

    public function setTbodyAttributes(array $attrs): static
    {
        $this->tbodyAttrs = $attrs;
        return $this;
    }

    public function setTrAttributes(array $attrs): static
    {
        $this->trAttrs = $attrs;
        return $this;
    }

    public function setThAttributes(array $attrs): static
    {
        $this->thAttrs = $attrs;
        return $this;
    }

    public function setTdAttributes(array $attrs): static
    {
        $this->tdAttrs = $attrs;
        return $this;
    }

// ---------------------- Helpers ----------------------
    protected function escape($v): string
    {
        return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8");
    }

    protected function attrs(array $attrs): string
    {
        $out = [];
        foreach ($attrs as $k => $v) {
            if ($v === null || $v === false) continue;
            if ($v === true) $out[] = $this->escape($k);
            else $out[] = $this->escape($k) . '="' . $this->escape($v) . '"';
        }
        return $out ? ' ' . implode(' ', $out) : '';
    }

// ---------------------- Get value (supports relations & wildcards) ----------------------
    protected function getValue($row, string $path)
    {
// if column has callback, skip this
        if (is_array($path) && isset($path['callback']) && is_callable($path['callback'])) {
            return $path['callback']($row);
        }

        $parts = explode('.', $path);

        foreach ($parts as $index => $part) {

// wildcard for arrays: authors.*.name
            if ($part === '*') {
                $results = [];
                $rest = implode('.', array_slice($parts, $index + 1));

                if (is_array($row) || $row instanceof \Traversable) {
                    foreach ($row as $item) {
                        $results[] = $this->getValue($item, $rest);
                    }
                } elseif (is_object($row)) {
                    foreach ($row as $item) {
                        $results[] = $this->getValue($item, $rest);
                    }
                }

                return implode(', ', $results);
            }

// object with __get or property
            if (is_object($row)) {
                $row = $row->$part ?? null;
            } // array
            elseif (is_array($row)) {
                $row = $row[$part] ?? null;
            } else {
                return null;
            }
        }

        return $row;
    }

// ---------------------- Render ----------------------
    public function render(): string
    {
        $html = '<table' . $this->attrs($this->tableAttrs) . '>';

// THEAD
        $html .= '<thead' . $this->attrs($this->theadAttrs) . '><tr' . $this->attrs($this->trAttrs) . '>';
        foreach ($this->columns as $title => $col) {
            $attrs = $this->thAttrs;
            if (is_array($col) && isset($col['th'])) {
                $attrs = array_merge($attrs, $col['th']);
            }
            $html .= '<th' . $this->attrs($attrs) . '>' . $this->escape($title) . '</th>';
        }
        $html .= '</tr></thead>';

// TBODY
        $html .= '<tbody' . $this->attrs($this->tbodyAttrs) . '>';
        foreach ($this->data as $row) {
            $html .= '<tr' . $this->attrs($this->trAttrs) . '>';
            foreach ($this->columns as $col) {
                $attrs = $this->tdAttrs;
                if (is_array($col) && isset($col['td'])) {
                    $attrs = array_merge($attrs, $col['td']);
                }
                $field = is_array($col) && isset($col['field']) ? $col['field'] : (is_string($col) ? $col : '');
                $value = null;

                if (is_array($col) && isset($col['callback']) && is_callable($col['callback'])) {
                    $value = $col['callback']($row);
                } elseif ($field) {
                    if (str_contains($field, '.*.')) {

                        $value = $this->getValue($row, $field);
                    } else {
                        $value = $this->getValue($row, $field);
                        $value = $this->escape((string)$value);
                    }
                }

                if (isset($col['data']) && $col['data']['type'] === 'image') {
                    $value = "<img src='". $col['data']['path'] ."/" . $value . "' width='60' height='60' />";
                }

                $html .= '<td' . $this->attrs($attrs) . '>' . $value . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        return $html;
    }
}
