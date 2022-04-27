<?php

namespace Core\FormType;

use Core\View;


class HiddenType
{
    private $name;
    private $value;
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        (new View('formtype', 'HiddenType', [
            'name' => $this->name,
            'value' => $this->value
        ]))->partialRender();
    }
}
