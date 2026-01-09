<?php 
namespace Kernel\Form;

use Closure;

class Form {
    private FormFields $formFields;

    public function __construct(
        private string $path,
        private string $method,
        private array $attrs = [],
        private array $errors = []
    )
    {
        $this->formFields = new FormFields();
    }

    public function setInput(string $name,string $label, array $attrs = []) 
    {
        $this->formFields->setField(FormFields::FIELD_INPUT,$name,$label,$attrs);
        return $this;
    } 

    public function setNumber(string $name,string $label, array $attrs = []) 
    {
        $this->formFields->setField(FormFields::FIELD_NUMBER,$name,$label,$attrs);
        return $this;
    } 

    public function setDate(string $name,string $label, array $attrs = []) 
    {
        $this->formFields->setField(FormFields::FIELD_DATE,$name,$label,$attrs);
        return $this;
    } 
    public function setTextarea(string $name,string $label, array $attrs = []) 
    {
        $this->formFields->setField(FormFields::FIELD_TEXTAREA,$name,$label,$attrs);
        return $this;
    } 

    public function setSelect(string $name, string $label = "", array $options = [], array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_SELECT,$name,$label,$attrs,$options);
        return $this;
    }

    public function setCheckbox(string $name, string $label = "", array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_CHECBOX,$name,$label,$attrs);
        return $this;
    }

    public function setRadio(string $name, string $label = "", array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_RADIO,$name,$label,$attrs);
        return $this;
    }

    public function setFile(string $name, string $label = "", array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_FILE,$name,$label,$attrs);
        return $this;
    }

    public function setEmail(string $name, string $label = "", array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_EMAIL,$name,$label,$attrs);
        return $this;
    }

    public function setPassword(string $name, string $label = "", array $attrs = []): self
    {
        $this->formFields->setField(FormFields::FIELD_PASSWORD,$name,$label,$attrs);
        return $this;
    }

    public function render() 
    {
        $formHtml = new FormHtml($this->path,$this->method, $this->attrs);
        $formHtml->setFormFields($this->formFields->getFields());
        $formHtml->setErrors($this->errors);

        return $formHtml->render();
    }
}