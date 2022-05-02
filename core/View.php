<?php

namespace Core;

use Core\Twig;

class View
{
    private static $twig;
    private string $path;
    private string $layout;
    private string $view;
    private array $data;

    /**
     * Constructor of View Class
     *
     * @param  string $view
     * @param  array $data
     * @return void
     */
    public function __construct(string $path, string $view, array $data = [])
    {
        $this
            ->setPath($path)
            ->setView($view)
            ->setData($data + ['_GET' => $_GET, '_POST' => $_POST]);
        self::$twig = Twig::getTwigInstance();
    }

    /**
     * Render page with template and layout
     *
     * @return void
     */
    public function render()
    {
        extract($this->getData());
        self::$twig->load($this->getPath() . '/' . $this->getView() . '.html.twig')->display($this->getData());
    }

    /**
     * Get the value of view
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the value of view
     *
     * @return  self
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
