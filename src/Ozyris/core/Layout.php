<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/03/18
 * Time: 20:06
 */

namespace Ozyris\core;


use Ozyris\Service\AbstractService;

class Layout extends AbstractService
{

    public function getLayout()
    {
        return include_once __DIR__ . '/../View/layout/layout.php';
    }
}