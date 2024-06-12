<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Checkbox extends FormInput
{
    use JsEventTrait;

    protected $checked = false;

    public function getViewName()
    {
        return 'Checkbox';
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

        return '
            <input ' . $checked . ' id="' . $this->getViewId() . '" name="' . $this->getName() . '" type="checkbox" value="' . $this->getValue() . '" ' . $this->renderJsOnChange() . '>
            <label>' . $this->getLabel() . '</label>
        ';
    }
}
