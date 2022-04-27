<?php

namespace Core;

use Core\View;
use Core\FormType\SubmitType;
use App\Form\Form;

class Twig
{

    private static $twig = null;
    private static $functions = [];

    public static function getTwigInstance()
    {
        if (self::$twig === null) {
            $loader = new \Twig\Loader\FilesystemLoader('../template/');
            self::$twig = new \Twig\Environment($loader, [
                'cache' => false,
            ]);
            self::setTwigFunctions();
        }

        return self::$twig;
    }

    public static function setTwigFunctions()
    {
        $formFunc = new \Twig\TwigFunction('generateForm', function (Form $form) {
            $formView = new View('partials', '_form', compact('form'));
            $formView->partialRender();
        });

        self::$functions = [
            $formFunc,
        ];
        foreach (self::$functions as $function) {
            self::$twig->addFunction($function);
        }
    }
}
