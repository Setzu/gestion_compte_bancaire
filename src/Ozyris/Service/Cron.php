<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 29/01/18
 * Time: 13:40
 */

namespace Ozyris\Service;


abstract class Cron
{

    /**
     * @param string $class
     * @param string $method
     * @param mixed $mConstructorParams
     * @param mixed $mMethodParams
     * @return bool
     */
    public static function callObjectMethod($class, $method, $mConstructorParams = null, $mMethodParams = null)
    {
        if (class_exists($class) && method_exists($class, $method)) {
            try {
                $oClass = new $class(isset($mConstructorParams) ? $mConstructorParams : null);

                return $oClass->$method(isset($mMethodParams) ? $mMethodParams : null);
            } catch (\Exception $e) {
                $oLog = new Logs();

                return $oLog->insertFileLogs($e->getMessage(), 'cron_logs');
            }
        } else {
            $oLog = new Logs();

            return $oLog->insertFileLogs('The class or method not exist in ' . __FILE__ . ' at line ' . __LINE__, 'cron_logs');
        }
    }

    public function addCron()
    {

    }
}