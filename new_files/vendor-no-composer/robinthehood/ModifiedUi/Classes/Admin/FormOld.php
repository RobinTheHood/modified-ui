<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

class FormOld extends View
{
    private $id = '';
    private $hiddens = [];

    // public function __construct($id)
    // {
    //     $this->id = $id;
    // }


    public function onSend($callable)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $callable($this);
        }
    }


    public function getViewName()
    {
        return 'Form';
    }

    public function addHidden($name)
    {
        $this->hiddens[$name] = $this->id . '_' . $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHiddenName($name)
    {
        return $this->hiddens[$name];
    }

    public function render()
    {
        return $this->renderOpen() . parent::render() . $this->renderClose();
    }

    public function renderOpen()
    {
        return '<form id="' . $this->getViewId() . '" method="post" action="">' . $this->renderHiddens();
    }

    public function renderClose()
    {
        return '</form>';
    }

    public function renderHiddens()
    {
        $html = '';
        foreach ($this->hiddens as $name => $id) {
            $html .= '<input type="hidden" id="' . $id . '" name="' . $name . '" value="">';
        }
        return $html;
    }

    public function jsSetValue($viewId, $value)
    {
        return 'document.getElementById(\'' . $viewId . '\').value=\'' . $value . '\';';
    }

    public function jsSetAction($action)
    {
        //$viewId = $this->action->getViewId();
        $viewId = $this->getViewID() . '_hidden0';
        return $this->jsSetValue($viewId, $action);
    }

    public function jsSubmit()
    {
        return 'document.getElementById(\'' . $this->getViewId() . '\').submit(); this.blur();';
    }
}
