<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/06/16
 * Time: 14:36
 */

namespace Ozyris\Service;

class Utils
{

    /**
     * Execute un var_dump
     *
     * @param mixed $value
     * @param bool $die
     */
    public static function debug($value, $die = true)
    {
        echo '<pre>'; var_dump($value, $_SESSION['test']);
        echo '<br><br>';
        debug_print_backtrace();
        if ($die) {
            echo '</pre>';
            die;
        } else {
            echo '</pre>';
        }
    }

    /**
     * Liste toutes les méthodes d'une classe
     *
     * @param object $classname
     */
    public static function getAllClassMethod($classname)
    {
        $class_methods = get_class_methods($classname);
        echo '<pre>';
        foreach ($class_methods as $method_name)
        {
            echo $method_name . '<br/>';
        }
        die('Fin de récupération des méthodes.');
    }

}