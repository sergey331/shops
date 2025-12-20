<?php 
namespace Kernel\Form;

use Exception;

class FormFields 
{
    public const FIELD_INPUT = 'input';
    public const FIELD_TEXTAREA = 'textarea';
    public const FIELD_CHECBOX = 'checkbox';
    public const FIELD_SELECT = 'select';
    public const FIELD_RADIO = 'radio';
    public const FIELD_FILE = 'file';
    public const FIELD_EMAIL = 'email';
    public const FIELD_PASSWORD = 'password';
    const ALLOWED_TYPE = [
        'input',
        'textarea',
        'checkbox',
        'select',
        'radio',
        'file',
        'email',
        'password'
    ];
    private array $fields = [];

    public function setField(string $type,string $name,string $label, array $attrs = [],array $options = []): void 
    {
        if (!in_array($type,self::ALLOWED_TYPE)) {
            throw new Exception('Type not allowed');
        }

        $this->fields[] = [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'attrs' => $attrs,
            'options' => $options
        ];
    }

    public function getFields(): array 
    {
        return $this->fields;
    }
}