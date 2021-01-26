<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class View
{
    private $components = [];
    private $parentComponent;
    private $index = 0;

    public function getViewName()
    {
        return 'View';
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setParentComponent($component)
    {
        $this->parentComponent = $component;
    }

    public function getParenComponent()
    {
        return $this->parentComponent;
    }

    public function getComponents()
    {
        return $this->components;
    }

    public function addComponent($component)
    {
        $this->components[] = $component;
        $component->setParentComponent($this);
        //$component->setIndex(count($this->components) - 1);
        $component->setIndexByArray($this->components);
        return $this;
    }

    public function getComponentsByViewId($viewId)
    {
        if ($this->getViewId() == $viewId) {
            return $this;
        }

        foreach ($this->components as $component) {
            $result = $component->getComponentsByViewId($viewId);
            if ($result) {
                return $result;
            }
        }
    }

    public function setIndexByArray($array)
    {
        $index = count($array) - 1;
        $this->setIndex($index);
    }

    public function createViewId()
    {
        $id = '';

        if ($this->parentComponent) {
            $id = $this->parentComponent->createViewId() . '_';
        }

        $id .= $this->getViewName() . $this->index;

        return $id;
    }

    public function getViewId()
    {
        $viewId = $this->createViewId();
        //return md5($viewId);
        return $viewId;
    }

    public function getSubViewId($viewName)
    {
        return $this->getViewId() . '_' . $viewName;
    }

    public function jsReload($params = [])
    {
        return function () use ($params) {
            $url = '?__rth_modified_ui_reload=' . $this->getViewId();
            $jsSuccessFunction = JsBuilder::jsEvalGetResult();
            return JsBuilder::jsGetRequest($url, $params, $jsSuccessFunction);
        };
    }

    public function render()
    {
        $html = '';
        foreach ($this->components as $component) {
            $html .= $component->render();
            //$component->callHooks();
        }
        return $html;
    }
}
