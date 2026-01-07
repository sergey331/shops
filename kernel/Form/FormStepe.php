<?php 
namespace Kernel\Form;

class FormStepe 
{
    protected array $steps = [];

    public function setSteps($name,$fields) 
    {
        $this->steps[] = [
            'title' =>    $name,
            'fields' => $fields
        ];
    }

    public function getSteps() 
    {
        return $this->steps;
    }
}