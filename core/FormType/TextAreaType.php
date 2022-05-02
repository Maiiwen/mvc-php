<?php

namespace Core\FormType;

use Core\View;

class TextareaType
{
    private $name;
    private $value;
    private $label;
    private $id;

    public function __construct(string $name, string $value, string $label, string $id = 'text')
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->id = $id;
    }
    public function render()
    {
        (new View('formtype', 'TextareaType', [
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label,
            'id' => $this->id
        ]))->render();
    }
}
