<?php

namespace Kernel\Validator;

use Kernel\File\FileData;
use Kernel\Validator\interface\ValidatorInterface;
use DateTime;

class Validator implements ValidatorInterface
{
    protected array $allowedRules = [
        'required', 'email', 'url', 'integer', 'string',
        'max', 'min', 'between', 'confirmed', 'unique',
        'image', 'mimes', 'nullable', 'decimal', 'array',
        'after'
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

            // Handle wildcard rules (tags.*, tags.*.id)
            if (str_contains($field, '*')) {
                $this->validateWildcard($field, $ruleSet);
                continue;
            }

            $rules = explode('|', $ruleSet);
            $value = $this->getValue($field);

            $isNullable = in_array('nullable', $rules, true);
            if ($isNullable && ($value === null || $value === '' || empty($value) || ($value instanceof FileData && !$value->isValid()) )) {
                continue;
            }

            foreach ($rules as $rule) {
                if ($rule === 'nullable') {
                    continue;
                }
                $this->applyRuleToValue($field, $rule, $value);
            }
        }

        return empty($this->errors);
    }

    protected function getValue(string $key)
    {
        $segments = explode('.', $key);
        $value = $this->data;

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return null;
            }
            $value = $value[$segment];
        }

        return $value;
    }

    protected function validateWildcard(string $field, string $ruleSet): void
    {
        $segments = explode('.', $field);
        $starIndex = array_search('*', $segments, true);

        $parentPath = implode('.', array_slice($segments, 0, $starIndex));
        $childPath  = array_slice($segments, $starIndex + 1);

        $items = $this->getValue($parentPath);

        if (!is_array($items)) {
            return;
        }

        foreach ($items as $index => $item) {
            $key = $parentPath . '.' . $index;
            if ($childPath) {
                $key .= '.' . implode('.', $childPath);
            }

            $value = $this->getValue($key);

            foreach (explode('|', $ruleSet) as $rule) {
                $this->applyRuleToValue($key, $rule, $value);
            }
        }
    }

    protected function applyRuleToValue(string $field, string $rule, $value): bool
    {
        [$ruleName, $param] = array_pad(explode(':', $rule, 2), 2, null);

        if (!in_array($ruleName, $this->allowedRules, true)) {
            $this->addError($field, "The {$field} field has an invalid rule: {$ruleName}.", $ruleName);
            return false;
        }

        $method = 'validate' . ucfirst($ruleName);

        if (method_exists($this, $method)) {
            return $this->$method($field, $ruleName, $param, $value);
        }

        return true;
    }

    public function validateAfter(string $field, $rule, $param, $value)
    {
        $date = $param ? $this->getValue($param) ?? null : date('Y-m-d'); 
        $message = $param ? "The {$field} datetime must be after {$param} datetime" : "The {$field} datetime cannot be in the past";

        if ($date) {
            $dateDt = $this->getDateTime($date, 'Y-m-d');
            $valueDt = $this->getDateTime($value, 'Y-m-d');
            
            if ( $dateDt >  $valueDt) {
                $this->addError($field, $message,$rule);
                return false;
            }
        }
        return true;
    }

    protected function getDateTime($date,$format = 'Y-m-d') 
    {
        return DateTime::createFromFormat($format, $date);
    }

    protected function addError(string $field, string $default, string $rule): void
    {
        $key = "{$field}.{$rule}";
        $this->errors[$field][] = $this->messages[$key] ?? $default;
    }

    protected function validateRequired(string $field, $rule, $param, $value): bool
    {
        if ($value === null || $value === '' || (is_array($value) && empty($value)) || ($value instanceof FileData && $value->name === '')) {
            $this->addError($field, "The {$field} field is required.", $rule);
            return false;
        }
        return true;
    }

    protected function validateArray(string $field, $rule, $param, $value): bool
    {
        if (!is_array($value)) {
            $this->addError($field, "The {$field} must be an array.", $rule);
            return false;
        }
        return true;
    }

    protected function validateInteger(string $field, $rule, $param, $value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            $this->addError($field, "The {$field} must be an integer.", $rule);
            return false;
        }
        return true;
    }

    protected function validateDecimal(string $field, $rule, $param, $value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            $this->addError($field, "The {$field} must be a decimal.", $rule);
            return false;
        }
        return true;
    }

    protected function validateString(string $field, $rule, $param, $value): bool
    {
        if (!is_string($value)) {
            $this->addError($field, "The {$field} must be a string.", $rule);
            return false;
        }
        return true;
    }

    protected function validateMin(string $field, $rule, $param, $value): bool
    {
        if (strlen((string)$value) < (int)$param) {
            $this->addError($field, "The {$field} must be at least {$param} characters.", $rule);
            return false;
        }
        return true;
    }

    protected function validateMax(string $field, $rule, $param, $value): bool
    {
        $max = (int) $param;

        // File upload
        if ($value instanceof FileData) {
            if ($value->size > ($max * 1024)) {
                $this->addError($field, "The {$field} must not be larger than {$max} kilobytes.", $rule);
                return false;
            }
            return true;
        }

        // Array
        if (is_array($value)) {
            if (count($value) > $max) {
                $this->addError($field, "The {$field} must not have more than {$max} items.", $rule);
                return false;
            }
            return true;
        }

        // Numeric
        if (is_numeric($value)) {
            if ($value > $max) {
                $this->addError($field, "The {$field} must not be greater than {$max}.", $rule);
                return false;
            }
            return true;
        }

        // String
        if (is_string($value)) {
            if (mb_strlen($value) > $max) {
                $this->addError($field, "The {$field} must not exceed {$max} characters.", $rule);
                return false;
            }
        }

        return true;
    }


    protected function validateBetween(string $field, $rule, $param, $value): bool
    {
        [$min, $max] = array_map('intval', explode(',', $param));
        $len = strlen((string)$value);

        if ($len < $min || $len > $max) {
            $this->addError($field, "The {$field} must be between {$min} and {$max} characters.", $rule);
            return false;
        }
        return true;
    }

    protected function validateEmail(string $field, $rule, $param, $value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "The {$field} must be a valid email address.", $rule);
            return false;
        }
        return true;
    }

    protected function validateUrl(string $field, $rule, $param, $value): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            $this->addError($field, "The {$field} must be a valid URL.", $rule);
            return false;
        }
        return true;
    }

    protected function validateConfirmed(string $field, $rule, $param, $value): bool
    {
        $confirmation = $this->getValue($field . '_confirmation');

        if ($value !== $confirmation) {
            $this->addError($field, "The {$field} confirmation does not match.", $rule);
            return false;
        }
        return true;
    }

    protected function validateImage(string $field, $rule): bool
    {
        $file = $this->data[$field] ?? null;

        if (!$file instanceof FileData || !$file->isValid() || !is_uploaded_file($file->tmpName)) {
            $this->addError($field, "The {$field} must be a valid uploaded image.", $rule);
            return false;
        }


        $check = getimagesize($file->tmpName);
        if ($check === false) {
            $this->addError($field, "The {$field} must be a valid image file.", $rule);
            return false;
        }

        return true;
    }

    protected function validateMimes(string $field, $rule, ?string $param): bool
    {
        $file = $this->data[$field] ?? null;

        if (empty($file->type)) {
            $this->addError($field, "The {$field} file type could not be determined.", $rule);
            return false;
        }

        $allowed = array_map('strtolower', explode(',', $param));
        $mime = mime_content_type($file->tmpName ?? '');

        $map = [
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            // Add more as needed
        ];

        $allowedMimes = array_intersect_key($map, array_flip($allowed));

        if (!in_array($mime, $allowedMimes)) {
            $this->addError($field, "The {$field} must be a file of type: {$param}.", $rule);
            return false;
        }

        return true;
    }


    public function errors(): array
    {
        return $this->errors;
    }
}
