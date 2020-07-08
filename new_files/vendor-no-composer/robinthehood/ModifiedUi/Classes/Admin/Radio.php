<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Radio extends View
{
    protected $name = '';
    protected $value = '';
    protected $checked = false;
    protected $label = '';

    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function getViewName()
    {
        return 'Radio';
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

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }

    public function render()
    {
        if ($this->checked) {
            $checked = 'checked';
        }

        return '<input ' . $checked . ' id="' . $this->getViewId() . '" name="' . $this->name . '" type="radio" value="' . $this->value . '"><label>' . $this->label . '</label>';
    }
}
