<?php

namespace Ozyris\Form;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 07/08/17
 * Time: 11:05
 */
class AbstractForm
{
    protected $form;
    protected $input = [];
    protected $label;
    private $type = [
        'text',
        'number',
        'password'
    ];

    /**
     * @param array $form
     */
    protected function setForm($form)
    {
        if (!array_key_exists('action', $form)) {
            $form['action'] = '/';
        }

        $class = '';

        if (array_key_exists('class', $form) && is_string($form['class'])) {
            $class = "class='" . $form['class'] . "' ";
        }

        $this->form = "<form action='" . $form['action'] . "' method='post' role='form' " . $class . ">";



        foreach ($this->input as $input) {
            $this->form .= $input;
        }

        $this->form .= '</div></form>';
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Création d'un champ de type text ou nombre
     *
     * @param string|int $type
     * @param string $name
     * @param bool $required
     * @param string $value
     * @param string $label
     * @param string $placeholder
     * @param string $class
     * @param string $id
     * @throws \Exception
     */
    protected function setTextInput($type = 'text', $name, $required = false, $value = '', $label = '', $placeholder = '', $class = '', $id = '')
    {
        if (!is_string($type) && !in_array($type, $this->type)) {
            throw new \Exception('Le type spécifié est incorrect.');
        }

        if (!is_string($value) && !is_int($value)) {
            throw new \Exception('La valeur doit être un nombre ou un chaine de caractères.');
        }

        if (!is_string($name) || !is_string($placeholder) || !is_string($id)) {
            throw new \Exception('Les paramètres doivent être des chaines de caractères.');
        }

        if ($required != false) {
            $required = "required";
        } else {
            $required = "false";
        }

        $input = '';

        if (is_string($label) && !empty($label)) {
            $this->setLabel($name, $label);
            $input .= $this->getLabel();
        }

        $input .= "<input type='" . $type . "' ";
        $input .= "name='" . $name . "' ";
        $input .= "required='" . $required . "' ";
        $input .= "placeholder='" . $placeholder . "' ";
        $input .= "id='" . $id . "'>";

        if (is_string($class) && !empty($class)) {
            $input = "<div class='" . $class . "'>" . $input . "</div>";
        }

        $this->input[] = $input;
    }

    /**
     * @param string $name
     * @param bool $required
     * @param array $optionValues
     * @param string $class
     * @param string $id
     * @throws \Exception
     */
    protected function setSelectInput($name, $required = false, $optionValues = [], $class = '', $id = '')
    {
        if (!is_string($name) || !is_array($optionValues) || !is_string($class) || !is_string($id)) {
            throw new \Exception('Les paramètres doivent être des chaines de caractères.');
        }

        if ($required != false) {
            $required = 'required';
        } else {
            $required = '';
        }
        $select = "<select " . $required. " name='" . $name . "' class='" . $class . "' id='" . $id . "'>";

        foreach ($optionValues as $k => $v) {

            if ((!is_string($k) && !is_int($k)) || (!is_string($v) && !is_int($v))) {
                throw new \Exception('Les valeurs des options doivent être des entiers ou des chaines de caractères.');
            }

            $select .= "<option value='" . $k . "'>" . $v . "</option>";
        }

        $select .= "</select>";
        $this->input[] = $select;
    }

    /**
     * @param string|int $value
     * @param string $class
     * @param string $id
     * @throws \Exception
     */
    protected function setSubmitInput($value = '', $class = '', $id = '')
    {
        if (!is_string($value) && !is_int($value)) {
            throw new \Exception('La valeur doit être un nombre ou un chaine de caractères.');
        }

        $this->input['submit'] = "<input type='submit' value='" . $value . "' class='" . $class . "' id='" . $id . "'>";
    }

    /**
     * @return array
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param string $name
     * @param string $label
     */
    private function setLabel($name, $label)
    {
        $this->label = "<label for='" . $name . "'>" . $label . "</label>";
    }

    private function getLabel()
    {
        return $this->label;
    }
}