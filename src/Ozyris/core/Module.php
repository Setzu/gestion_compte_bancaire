<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 01/02/18
 * Time: 14:28
 */

namespace Ozyris\core;

abstract class Module
{

    const APPLICATION_ENV = 'APPLICATION_ENV';

    /**
     * @return string
     * @throws ModuleException
     */
    public static function getEnv()
    {
        $file = __DIR__ . '/../../../config/application.php';

        if (!file_exists($file)) {
            throw new ModuleException(__FILE__ . ' line ' . __LINE__ . ' : The file ' . $file . ' do not exist');
        } else {
            $config = include_once $file;

            if (!array_key_exists(self::APPLICATION_ENV, $config)) {
                throw new ModuleException(__FILE__ . ' ' . __LINE__ . ' : The key ' . self::APPLICATION_ENV . ' is not define in ' . $config);
            } else {
                return $config[self::APPLICATION_ENV];
            }
        }
    }
}