<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Select extends FormInput
{
    use JsEventTrait;

    protected $options;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getViewName()
    {
        return 'Select';
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    private function convertOptions($options)
    {
        $entrys = [];
        foreach($options as $option) {
            $entrys[] = [
                'id' => $option['value'],
                'text' => $option['name']
            ];
        }
        return $entrys;
    }

    public function addJsConnectWithForm($form)
    {
        $hidden = new Hidden($this->getName());
        $form->addComponent($hidden);

        $this->addJsOnChange(function() use ($form, $hidden) {
            return JsBuilder::jsCopyValueRaw($this->getSubViewId('Select'), $hidden->getViewId());
            //return $form->jsCopyValue($this->getSubViewId('Select'), $hidden->getViewId());
        });
    }

    public function render()
    {
        return '
            <div id="' . $this->getViewId() . '" class="rth-modified-ui-select" >' .
                xtc_draw_pull_down_menu(
                    $this->name,
                    $this->convertOptions($this->options),
                    $this->value,
                    $this->renderJsOnChange() . 'id="' . $this->getSubViewId('Select') . '"'
                ) .
            '</div>';
    }
}
