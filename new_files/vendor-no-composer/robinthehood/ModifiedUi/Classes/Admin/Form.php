<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class Form extends View
{
    protected $hiddenAction;

    public function __construct()
    {
        $hidden = new Hidden('action');
        $this->addComponent($hidden);
        $this->hiddenAction = $hidden;
    }

    public function getViewName()
    {
        return 'Form';
    }

    public function onSend($callable)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $callable($this);
        }
    }

    public function addTextField($name, $labelValue)
    {
        $label = new Label();
        $label->setValue($labelValue);
        $textField = new TextField($name);

        $splitPanel = new SplitPanel();
        $splitPanel->setLeft($label);
        $splitPanel->setRight($textField);
        $splitPanel->setLeftWidth(20);

        //$this->addComponent($label);
        //$this->addComponent($textField);
        $this->addComponent($splitPanel);


        return $textField;
    }

    public function addTextArea($name, $labelValue)
    {
        $label = new Label();
        $label->setValue($labelValue);
        $textArea = new TextArea($name);

        $splitPanel = new SplitPanel();
        $splitPanel->setLeft($label);
        $splitPanel->setRight($textArea);
        $splitPanel->setLeftWidth(20);

        // $this->addComponent($label);
        // $this->addComponent($textArea);
        $this->addComponent($splitPanel);

        return $textArea;
    }


    public function jsSetAction($action)
    {
        return JsBuilder::jsSetValue($this->hiddenAction, $action);
    }

    public function jsSubmit()
    {
        return JsBuilder::jsSubmit($this);
    }

    public function render()
    {
        return '
            <form id="' . $this->getViewId() . '" method="post" action="">
                ' . parent::render() . '
            </form>
        ';
    }
}
