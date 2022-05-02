<?php

namespace Core;

class Form
{
    private string $action;
    private array $elements;

    public function __construct(string $action, array $elements = [])
    {
        $this->action = $action;
        $this->elements = $elements;
    }

    /**
     * Get the value of action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get the value of elements
     */
    public function getElements()
    {
        return $this->elements;
    }
}
