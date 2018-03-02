<?php
/**
 * Created by PhpStorm.
 * User: david b.
 * Date: 04/08/17
 * Time: 15:51
 */

namespace Ozyris\Form;

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
     * $options = [
     *   action = '/',
     *   class = 'foo',
     *   id = 'bar'
     * ]
     * @param array $options
     * @throws \Exception
     */
    public function setForm($options = [])
    {
        if (!is_array($options)) {
            throw new \Exception('The options must be in an array.');
        }

        parent::setForm($options);
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
     * @throws \Exception
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
     * @throws \Exception
     */
    public function setSelectInput($name, $required = false, $optionValues = [], $class = '', $id = '')
    {
        parent::setSelectInput($name, $required, $optionValues, $class, $id);
    }

    /**
     * @param string $value
     * @param string $class
     * @param string $id
     * @throws \Exception
     */
    public function setSubmitInput($value = '', $class = '', $id = '')
    {
        parent::setSubmitInput($value, $class, $id);
    }
}