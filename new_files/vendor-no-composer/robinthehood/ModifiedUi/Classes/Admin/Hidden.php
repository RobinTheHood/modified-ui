<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

class Hidden extends View
{
    private $name = 'textField';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewName()
    {
        return 'Hidden';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return '<input id="' . $this->getViewId() . '" class="rth-modified-ui-hidden" type="hidden" name="' . $this->name . '" value="' . $this->value . '">';
    }
}
