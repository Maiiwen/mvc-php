<?php

namespace Core;

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
    public function __construct(string $path, string $view, array $data = [], string $layout = 'layout')
    {
        $this
            ->setPath($path)
            ->setView($view)
            ->setData($data + ['_GET' => $_GET, '_POST' => $_POST])
            ->setLayout($layout);


        $loader = new \Twig\Loader\FilesystemLoader('../template/');
        self::$twig = new \Twig\Environment($loader, [
            'cache' => '../cache/',
        ]);
    }

    /**
     * Render page with template and layout
     *
     * @return void
     */
    public function render()
    {
        ob_start();
        $this->template();
        $this->layout();
        ob_end_flush();
    }

    /**
     * get template with data
     *
     * @return void
     */
    public function template()
    {

        extract($this->getData());
        self::$twig->load($this->getPath() . '/' . $this->getView() . '.html.twig')->display($this->getData());
    }

    /**
     * layout
     *
     * @return void
     */
    public function layout()
    {
        $content = ob_get_clean();
        self::$twig->load('layout/' . $this->getLayout() . '.html.twig')->display($this->getData() + ['content' => $content]);
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

    /**
     * Get the value of layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the value of layout
     *
     * @return  self
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }
}
