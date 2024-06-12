<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class TextField extends View
{
    use JsEventTrait;

    private $name = 'textField';
    protected $value;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewName()
    {
        return 'TextField';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return '<input id="' . $this->getViewId() . '" class="rth-modified-ui-textfield" type="text" name="' . $this->name . '" value="' . $this->value . '" ' . $this->renderJsOnKeyup() . '>';
    }
}
