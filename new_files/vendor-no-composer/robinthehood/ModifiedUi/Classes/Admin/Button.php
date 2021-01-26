<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Button extends View
{
    use JsEventTrait;

    private $caption = 'Button';

    public function getViewName()
    {
        return 'Button';
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function addJsSubmitForm($form, $action)
    {
        $this->addJsOnClick(function () use ($form, $action) {
            return $form->jsSetAction($action);
        });

        $this->addJsOnClick(function () use ($form) {
            return $form->jsSubmit();
        });
    }


    public function onClick($function, $params = [])
    {
        $functionName = App::registerFunction($function);

        $this->addJsOnClick(function () use ($params, $functionName) {
            $url = '?jsCallbackFunction=' . $functionName;
            $jsSuccessFunction = JsBuilder::jsEvalGetResult();
            return JsBuilder::jsGetRequest($url, $params, $jsSuccessFunction);
        });
    }

    public function render()
    {
        return '
            <a href="#" id="' . $this->getViewId() . '" class="rth-modified-ui-link" ' . $this->renderJsOnClick() . '>
                <i class="far fa-trash-alt fa-fw"></i> ' . $this->caption . '
            </a>
        ';

        // return '
        //     <a id="' . $this->getViewId() . '" class="" ' . $this->renderJsOnClick() . '>
        //         <img src="images/icons/icon_edit.gif" alt="' . $this->caption . '" title="' . $this->caption . '" style="border:0;padding-right:8px;">
        //     </a>
        // ';

        return '
            <a id="' . $this->getViewId() . '" class="rth-modified-ui-button" ' . $this->renderJsOnClick() . '>' . $this->caption . '</a>
        ';
    }
}
