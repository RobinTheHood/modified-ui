<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class Label extends View
{
    private $value = '';

    public function getViewName()
    {
        return 'Label';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return '<label id="' . $this->getViewId() . '" class="rth-modified-ui-label">' . $this->value . '</label>';
    }
}
