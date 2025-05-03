<?php

namespace Kernel\Validator;

class Validator
{
    protected array $allowedRules = [
        'required', 'email', 'url', 'integer', 'string',
        'max', 'min', 'between', 'confirmed', 'unique',
    ];

    protected array $rules = [];
    protected array $messages = [];
    protected array $data = [];
    protected array $errors = [];

    public function __construct(array $data, array $rules, array $messages = [])
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->messages = $messages;
    }

    public static function make(array $data, array $rules, array $messages = []): Validator
    {
        return new static($data, $rules, $messages);
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $ruleSet) {
            $rules = explode('|', $ruleSet);
            foreach ($rules as $rule) {
               $this->applyRule($field, $rule);
            }
        }
        return empty($this->errors);
    }

    protected function applyRule(string $field, string $rule): bool
    {
        [$ruleName, $param] = array_pad(explode(':', $rule, 2), 2, null);

        if (!in_array($ruleName, $this->allowedRules)) {
            $this->addError($field, "The {$field} field has an invalid rule: {$ruleName}.");
            return false;
        }

        $method = "validate" . ucfirst($ruleName);
        if (method_exists($this, $method)) {
            return $this->$method($field, $param,$ruleName);
        }

        return true;
    }

    protected function addError(string $field, string $default, $rule): void
    {
        $key = $rule ? "{$field}.{$rule}" : $field;
        $this->errors[$field][] = $this->messages[$key] ?? $default;
    }

    // === Individual Rule Methods ===

    protected function validateRequired(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? null;
        if (empty($value) && $value !== '0') {
            $this->addError($field, "The {$field} field is required.",$rule);
            return false;
        }
        return true;
    }

    protected function validateEmail(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "The {$field} must be a valid email address.",$rule);
            return false;
        }
        return true;
    }

    protected function validateUrl(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->addError($field, "The {$field} must be a valid URL.",$rule);
            return false;
        }
        return true;
    }

    protected function validateInteger(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? null;
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            $this->addError($field, "The {$field} must be an integer.",$rule);
            return false;
        }
        return true;
    }

    protected function validateString(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        if (!is_string($value)) {
            $this->addError($field, "The {$field} must be a string.",$rule);
            return false;
        }
        return true;
    }

    protected function validateMin(string $field, ?string $param,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        if (strlen($value) < (int)$param) {
            $this->addError($field, "The {$field} must be at least {$param} characters.",$rule);
            return false;
        }
        return true;
    }

    protected function validateMax(string $field, ?string $param,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        if (strlen($value) > (int)$param) {
            $this->addError($field, "The {$field} must not exceed {$param} characters.",$rule);
            return false;
        }
        return true;
    }

    protected function validateBetween(string $field, ?string $param,$rule): bool
    {
        $value = $this->data[$field] ?? '';
        [$min, $max] = array_map('intval', explode(',', $param));
        $len = strlen($value);
        if ($len < $min || $len > $max) {
            $this->addError($field, "The {$field} must be between {$min} and {$max} characters.",$rule);
            return false;
        }
        return true;
    }

    protected function validateConfirmed(string $field,$rule): bool
    {
        $value = $this->data[$field] ?? null;
        $confirm = $this->data[$field . '_confirmation'] ?? null;
        if ($value !== $confirm) {
            $this->addError($field, "The {$field} confirmation does not match.",$rule);
            return false;
        }
        return true;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
