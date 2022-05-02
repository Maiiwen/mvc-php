<?php

namespace Core\FormType;

use Core\View;

class TextType
{
    private $name;
    private $label;
    public function __construct($name, $value, $label)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }
    public function render()
    {
        (new View('formtype', 'TextType', [
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label
        ]))->render();
    }
}
