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
     * PHP debugger
     *
     * @param mixed $value
     * @param bool $die
     */
    public static function debug($value, $die = true)
    {
        echo '<pre>'; var_dump($value);
        echo '<br><br>';
        debug_print_backtrace();

        if ($die) {
            echo '</pre>';
            die();
        } else {
            echo '!! End of debug !!</pre>';
        }
    }

    /**
     * Display all method from $classname
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
    }

    public static function convertFormatDateToEu($timestamp)
    {
        $date = new \DateTime($timestamp);

        return $date->format('d/m/Y H:i:s');
    }
}