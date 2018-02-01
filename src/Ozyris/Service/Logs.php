<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 30/01/18
 * Time: 08:46
 */

namespace Ozyris\Service;


class Logs
{

    const BASE_FILE_PATH = '/../../../data/logs/';

    /**
     * @param string $log
     * @param string $fileName
     * @return bool
     */
    public function insertFileLogs($log = '', $fileName = '')
    {
        if (!is_string($fileName) || empty($fileName)) {
            $fileName = 'logs';
        }

        $sFile = __DIR__ . self::BASE_FILE_PATH . $fileName . '.txt';
        $logFile = fopen($sFile, 'a+');
        fputs($logFile, date('d/m/Y H:i:s : ') . (string) $log . PHP_EOL);

        return fclose($logFile);
    }

    /**
     * @param string $log
     */
    public function insertBddLogs($log)
    {

    }
}