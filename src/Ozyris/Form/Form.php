<?php

namespace Ozyris\Form;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 04/08/17
 * Time: 15:51
 */
class Form extends AbstractForm
{

    /**
     * Form constructor.
     */
    public function __construct()
    {

    }

    /**
     * @example :
     * $infos = [
     *   action = '/',
     *   class = 'foo bar',
     *   id = 'example'
     * ]
     * @param array $infos
     * @throws \Exception
     */
    public function setForm($infos = [])
    {
        if (!is_array($infos)) {
            throw new \Exception('Les paramètres doivent être dans un array.');
        }

        parent::setForm($infos);
    }

    /**
     * @param string $type
     * @param string $name
     * @param bool $required
     * @param string $value
     * @param string $label
     * @param string $placeholder
     * @param string $class
     * @param string $id
     */
    public function setTextInput($type = 'text', $name, $required = false, $value = '', $label = '', $placeholder = '', $class = '', $id = '')
    {
        parent::setTextInput($type, $name, $required, $value, $label, $placeholder, $class, $id);
    }

    /**
     * @param string $name
     * @param bool $required
     * @param array $optionValues
     * @param string $class
     * @param string $id
     */
    public function setSelectInput($name, $required = false, $optionValues = [], $class = '', $id = '')
    {
        parent::setSelectInput($name, $required, $optionValues, $class, $id);
    }

    public function setSubmitInput($value = '', $class = '', $id = '')
    {
        parent::setSubmitInput($value, $class, $id);
    }

    /**
     * @return array
     */
    public static function getFormValues()
    {
        $values = [];

        foreach ($_POST as $k => $v) {
            $values[$k] = htmlspecialchars(trim($v));
        }

        return $values;
    }
}