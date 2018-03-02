<?php
/**
 * Created by PhpStorm.
 * User: gfp
 * Date: 07/02/18
 * Time: 18:36
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