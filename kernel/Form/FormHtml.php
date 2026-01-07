<?php

namespace Kernel\Form;

use Exception;

class FormHtml
{
    private array $formFields = [];
    private array $steps = [];
    private array $errors = [];

    public function __construct(
        private string $url,
        private string $method = 'post',
        private array $attrs = []
    ) {
        if ($this->url === '') {
            throw new Exception('Invalid form URL');
        }
    }

    /* =============================
        PUBLIC API
    ==============================*/

    public function setFormSteps(array $steps)
    {
        $this->steps = $steps;
    }
    public function setFormFields(array $formFields): void
    {
        $this->formFields = $formFields;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }

    public function render(): string
{
    $renderers = [
        'input'    => [$this, 'renderInputHtml'],
        'select'   => [$this, 'renderSelectHtml'],
        'textarea' => [$this, 'renderTextareaHtml'],
        'date'     => [$this, 'renderDateHtml'],
        'checkbox' => [$this, 'renderInputHtml'],
        'radio'    => [$this, 'renderInputHtml'],
        'file'     => [$this, 'renderInputHtml'],
        'email'    => [$this, 'renderInputHtml'],
        'password' => [$this, 'renderInputHtml'],
        'number'   => [$this, 'renderInputHtml'],
    ];

    $html = $this->renderFormOpen();

    // 🔹 Render stepper
    if (!empty($this->steps)) {
        $html .= $this->renderStepper(0); // active step index
    }

    // 🔹 Render fields
    if (!empty($this->formFields)) {
        foreach ($this->formFields as $field) {
            $type = $field['type'] ?? 'input';

            if (!isset($renderers[$type])) {
                continue;
            }

            $html .= call_user_func(
                $renderers[$type],
                $field['name'] ?? '',
                $field['label'] ?? '',
                $field['attrs'] ?? [],
                $field['options'] ?? [],
                $type
            );
        }

        $html .= '
        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Submit
            </button>
        </div>';
    }

    return $html . '</form>';
}


    protected function renderStepper(int $activeStep = 0): string
{
    $html = '<ol class="flex items-center w-full mb-8">';

    foreach ($this->steps as $index => $step) {
        $isActive = $index === $activeStep;
        $isCompleted = $index < $activeStep;

        $circleClasses = $isCompleted
            ? 'bg-green-600 text-white'
            : ($isActive ? 'bg-blue-600 text-white' : 'border-2 border-gray-300 text-gray-400');

        $html .= '
        <li class="flex items-center w-full">
            <span class="flex items-center justify-center w-8 h-8 rounded-full ' . $circleClasses . '">
                ' . ($isCompleted ? '✓' : ($index + 1)) . '
            </span>
            <span class="ml-2 text-sm font-medium">' . $step['title'] . '</span>';

        if ($index !== array_key_last($this->steps)) {
            $html .= '<div class="flex-auto border-t-2 mx-4 ' .
                ($isCompleted ? 'border-green-600' : 'border-gray-300') .
                '"></div>';
        }

        $html .= '</li>';
    }

    return $html . '</ol>';
}


    /* =============================
        FIELD RENDERERS
    ==============================*/

    public function renderDateHtml(
        string $name,
        string $label,
        array $attrs,
        array $options,
        string $type
    ): string {
        $type = $type === 'input' ? 'text' : $type;

        $attrs = array_merge([
            'type' => $type,
            'id'   => $name,
            'name' => $name,
        ], $attrs);
        if (($attrs['checked'] ?? true) === false) {
            unset($attrs['checked']);
        }

        return sprintf(
            '<div class="form-group">
                <label for="%s">%s</label>
                <div id="%s" class="input-group date datepicker navbar-date-picker">
                    <span class="input-group-addon input-group-prepend border-right" style="border-right: 2px solid #dee2e6;">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" %s>
                </div>
                %s
            </div>',
            htmlspecialchars($attrs['id'], ENT_QUOTES),
            htmlspecialchars($label, ENT_QUOTES),
            $name,
            $this->buildAttributes($attrs),
            $this->renderErrors($name)
        );
    }
    private function renderInputHtml(
        string $name,
        string $label,
        array $attrs,
        array $options,
        string $type
    ): string {
        $type = $type === 'input' ? 'text' : $type;

        $attrs = array_merge([
            'type' => $type,
            'id'   => $name,
            'name' => $name,
        ], $attrs);
        if (($attrs['checked'] ?? true) === false) {
            unset($attrs['checked']);
        }

        return sprintf(
            '<div class="form-group">
                <label for="%s">%s</label>
                <input%s>
                %s
            </div>',
            htmlspecialchars($attrs['id'], ENT_QUOTES),
            htmlspecialchars($label, ENT_QUOTES),
            $this->buildAttributes($attrs),
            $this->renderErrors($name)
        );
    }

    private function renderTextareaHtml(
        string $name,
        string $label,
        array $attrs
    ): string {
        $value = $attrs['value'] ?? '';
        unset($attrs['value']);

        $attrs = array_merge([
            'id'   => $name,
            'name' => $name,
        ], $attrs);

        return sprintf(
            '<div class="form-group">
                <label for="%s">%s</label>
                <textarea%s>%s</textarea>
                %s
            </div>',
            htmlspecialchars($attrs['id'], ENT_QUOTES),
            htmlspecialchars($label, ENT_QUOTES),
            $this->buildAttributes($attrs),
            htmlspecialchars($value, ENT_QUOTES),
            $this->renderErrors($name)
        );
    }

    private function renderSelectHtml(
        string $name,
        string $label,
        array $attrs,
        array $options
    ): string {
        $valueKey = $attrs['option_value'] ?? 'id';
        $labelKey = $attrs['option_label'] ?? 'name';
        $default  = $attrs['option_default_label'] ?? '';

        $selected = $attrs['value'] ?? null;
        $isMultiple = !empty($attrs['multiple']);

        // Normalize selected values
        if ($selected === null) {
            $selectedValues = [];
        } elseif (is_array($selected)) {
            $selectedValues = array_map('strval', $selected);
        } else {
            $selectedValues = [(string)$selected];
        }

        unset(
            $attrs['option_value'],
            $attrs['option_label'],
            $attrs['option_default_label'],
            $attrs['value']
        );

        $attrs = array_merge([
            'id'   => $name,
            'name' => $isMultiple ? $name . '[]' : $name,
        ], $attrs);

        $optionsHtml = '';

        // Default option only for single select
        if (!$isMultiple && $default !== '') {
            $optionsHtml .= '<option value="">' .
                htmlspecialchars($default, ENT_QUOTES) .
                '</option>';
        }

        foreach ($options as $key =>  $option) {
            if (is_scalar($option)) {
                $value = $key;
                $text  = $option;
            } elseif (is_array($option)) {
                $value = $option[$valueKey] ?? null;
                $text  = $option[$labelKey] ?? null;
            } elseif (is_object($option)) {
                $value = $option->{$valueKey} ?? null;
                $text  = $option->{$labelKey} ?? null;
            } else {
                continue;
            }

            if ($value === null || $text === null) {
                continue;
            }

            $valueStr = (string)$value;

            $isSelected = in_array($valueStr, $selectedValues, true)
                ? ' selected'
                : '';

            $optionsHtml .= sprintf(
                '<option value="%s"%s>%s</option>',
                htmlspecialchars($valueStr, ENT_QUOTES),
                $isSelected,
                htmlspecialchars((string)$text, ENT_QUOTES)
            );
        }

        return sprintf(
            '<div class="form-group">
                <label for="%s">%s</label>
                <select%s>%s</select>
                %s
            </div>',
            htmlspecialchars($attrs['id'], ENT_QUOTES),
            htmlspecialchars($label, ENT_QUOTES),
            $this->buildAttributes($attrs),
            $optionsHtml,
            $this->renderErrors($name)
        );
    }

    /* =============================
        HELPERS
    ==============================*/

    private function renderErrors(string $name): string
    {
        if (!isset($this->errors[$name]) || empty($this->errors[$name])) {
            return '';
        }

        $html = '<ul class="errors">';
        foreach ($this->errors[$name] as $error) {
            $html .= '<li>' . htmlspecialchars($error, ENT_QUOTES) . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }

    private function renderFormOpen(): string
    {
        $attrs = array_merge([
            'action' => $this->url,
            'method' => strtolower($this->method),
        ], $this->attrs);

        return '<form' . $this->buildAttributes($attrs) . '>';
    }

    private function buildAttributes(array $attrs): string
    {
        $html = '';

        foreach ($attrs as $key => $value) {
            if ($value === null) {
                continue;
            }

            $html .= sprintf(
                ' %s="%s"',
                htmlspecialchars($key, ENT_QUOTES),
                htmlspecialchars((string)$value, ENT_QUOTES)
            );
        }

        return $html;
    }
}
