<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 14/06/16
 * Time: 10:06
 */

namespace Ozyris\core;

use Ozyris\Controller;

class Router
{
    const DEFAULT_CONTROLLER = 'IndexController';
    const DEFAULT_ACTION = 'indexAction';

    /**
     * Détermine le controller et l'action à appeler en fonction des paramètres passés dans l'url
     *
     * @return mixed
     * @throws \Exception
     */
    public static function dispatch()
    {
        // Récupère le nom du contrôleur en paramètre dans l'url
        if (!empty($_GET['controller'])) {
            $sController = ucfirst(strtolower(trim(htmlspecialchars($_GET['controller'])))) . 'Controller';
        } else {
            $sController = self::DEFAULT_CONTROLLER;
        }

        $sControllerName = 'Ozyris\\Controller\\' . $sController;

        // Si la classe n'existe pas on affiche une 404
        if (!class_exists($sControllerName)) {
            return (new Controller\IndexController())->pageNotFound();
        }

        // Récupère le nom de l'action dans l'url
        if (!empty($_GET['action'])) {
            $sActionName = ucfirst(strtolower(trim(htmlspecialchars($_GET['action'])))) . 'Action';
        } else {
            $sActionName = self::DEFAULT_ACTION;
        }

        // Si la méthode n'existe pas on affiche une 404
        if (!method_exists($sControllerName, $sActionName)) {
            return (new Controller\IndexController())->pageNotFound();
        }

        return (new $sControllerName)->$sActionName();
    }

    public static function getPostValues()
    {
        $values = [];

        foreach ($_POST as $k => $v) {
            $values[$k] = htmlspecialchars(trim($v));
        }

        return $values;
    }

    public static function getGetValues()
    {
        return htmlspecialchars($_GET['param']);
    }
}
