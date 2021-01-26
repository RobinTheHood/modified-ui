<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class FormInput extends View
{
    protected $name = '';
    protected $value = '';
    protected $label = '';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewName()
    {
        return 'FormInput';
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function render()
    {
        return '';
    }
}
