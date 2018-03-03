<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/03/18
 * Time: 20:06
 */

namespace Ozyris\core;


class Layout
{

    private $layout;

    public function __construct()
    {
        $this->setLayout(__DIR__ . '/../View/layout/layout.php');
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @param mixed $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}