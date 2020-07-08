<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Action extends View
{
    use JsEventTrait;

    private $caption = 'Action';

    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function addJsSubmitForm($form, $action)
    {
        $this->addJsOnClick(function() use ($form, $action) {
            return $form->jsSetAction($action);
        });

        $this->addJsOnClick(function() use ($form) {
            return $form->jsSubmit();
        });
    }

    public function render()
    {
        return '
            <input type="submit" class="rth-modified-ui-button" value="' . $this->caption . '" ' . $this->renderJsOnClick() . '>
        ';
    }
}
