<?php

namespace Core;

use Core\View;
use Core\Form;
use Twig\Environment;
use Twig\TwigFunction;
use Core\FormType\SubmitType;
use Twig\Loader\FilesystemLoader;

class Twig
{

    private static $twig = null;
    private static $functions = [];

    public static function getTwigInstance()
    {
        if (self::$twig === null) {
            $loader = new FilesystemLoader('../template/');
            self::$twig = new Environment($loader, [
                'cache' => false,
            ]);
            self::setTwigFunctions();
        }

        return self::$twig;
    }

    public static function setTwigFunctions()
    {
        $formFunc = new TwigFunction('generateForm', function (Form $form) {
            $formView = new View('partials', '_form', compact('form'));
            $formView->render();
        });

        self::$functions = [
            $formFunc,
        ];
        foreach (self::$functions as $function) {
            self::$twig->addFunction($function);
        }
    }
}
