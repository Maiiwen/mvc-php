<?php

namespace Core\FormType;

use Core\View;

class SubmitType
{
    private string $name;
    private string $value;
    private string $label;
    public function __construct(string $name, string $value, string $label)
    {
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
    }

    public function render()
    {
        (new View('formtype', 'SubmitType', [
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label
        ]))->render();
    }
}
