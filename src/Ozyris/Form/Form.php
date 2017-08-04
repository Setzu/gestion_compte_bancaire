<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/08/17
 * Time: 15:51
 */
class Form
{
    protected $form = [];

    /**
     * @return array
     */
    public function getFormValues()
    {
        foreach ($_POST as $k => $v) {
            $this->form[$k] = htmlspecialchars(trim($v));
        }

        return $this->form;
    }
}