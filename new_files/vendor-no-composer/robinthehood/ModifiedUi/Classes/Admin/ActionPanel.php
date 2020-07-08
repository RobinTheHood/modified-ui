<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;
use RobinTheHood\ModifiedUi\Classes\Admin\Action;

class ActionPanel extends View
{
    function addAction($caption)
    {
        $action = new Action();
        $action->setCaption($caption);
        $this->addComponent($action);

        $this->components[] = [
            'type' => 'action',
            'component' => [
                'action' => $action
            ]
        ];

        return $action;
    }

    public function addSelect($caption, $name, $options, $value = '')
    {
        $select = new Select($name);
        $select->setOptions($options);
        $select->setValue($value);
        $this->addComponent($select);

        $this->components[] = [
            'type' => 'Select',
            'component' => [
                'caption' => $caption,
                'select' => $select
            ]
        ];

        return $select;
    }

    public function addSeparator()
    {
        $this->components[] = [
            'type' => 'separator'
        ];
    }

    protected function renderSelect($caption, $select)
    {
        return $select->render();
    }



    public function renderSeparator()
    {
        return '<div class="rth-modified-ui-action-panel-separator"></div>';
    }

    public function renderComponents()
    {
        $html = '';
        foreach($this->components as $component) {
            $type = $component['type'];
            $component = $component['component'];

            if ($type == 'action') {
                $html .= $component['action']->render();
            // } elseif ($type == 'dropdown') {
            //     $html .= $this->renderDropdown($component['name'], $component['options'], $component['form']);

            } elseif ($type == 'Select') {
                $html .= $this->renderSelect($component['caption'], $component['select']);

            } elseif ($type == 'separator') {
                $html .= $this->renderSeparator();
            }
        }
        return $html;
    }

    public function render()
    {
        return '
            <div class="rth-modified-ui-action-panel">
                <div class="rth-modified-ui-action-panel-heading">
                    Aktion für ausgewählte Objekte
                </div>
                <div class="rth-modified-ui-action-panel-body">
                    ' . $this->renderComponents() . '
                </div>
            </div>
        ';
    }
}
