<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class TextArea extends View
{
    protected $value;
    protected $name = 'textArea';

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewName()
    {
        return 'TextArea';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function render()
    {
        return '<textarea id="' . $this->getViewId() . '" name="' . $this->name . '" class="rth-modified-ui-textarea">' . $this->value . '</textarea>';
    }
}
