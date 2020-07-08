<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;
use RobinTheHood\ModifiedUi\Classes\Admin\Action;

class ActionPanel extends View
{
    //private $components = [];

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

    // public function renderOff()
    // {
    //     return $this->renderHeading() . '
    //     <table class="contentTable">
    //         <tbody>
    //             <tr class="infoBoxContent">
    //                 <td class="infoBoxContent">
    //                     <div class="rth-modified-ui-action-panel">' . $this->renderComponents() . '</div>
    //                 </td>
    //             </tr>
    //
    //             <tr class="infoBoxContent">
    //                 <td class="infoBoxContent">
    //                     Mit diesem Modul von First-Web können Sie bei allen ausgewählten Bestellungen gleichzeitig den Status ändern oder die Rechnungen drucken lassen.
    //                 </td>
    //             </tr>
    //         </tbody>
    //     </table>
    //     ';
    // }
    //
    // public function renderHeading()
    // {
    //     return '
    //         <table class="contentTable">
    //             <tbody>
    //                 <tr class="infoBoxHeading">
    //                     <td class="infoBoxHeading">
    //                         <div class="infoBoxHeadingTitle">
    //                             <b>Aktion</b>
    //                         </div>
    //                     </td>
    //                 </tr>
    //             </tbody>
    //         </table>
    //     ';
    // }

    // public function renderDropdown($name, $options, $form)
    // {
    //     $optionsHtml = '';
    //     foreach($options as $option) {
    //         $optionsHtml .= '<option value="' . $option['value'] . '">' . $option['name'] . '</option>';
    //     }
    //
    //     if ($form) {
    //         $hiddenName = $form->getHiddenName($name);
    //     }
    //
    //     return '
    //         <select name="' . $name . '" class="fw-input" onchange="
    //         document.getElementById(\'' . $hiddenName . '\').value = this.value;
    //         ">
    //             ' . $optionsHtml . '
    //         </select>
    //         <br>
    //     ';
    // }

    // public function addAction($caption, $action, $form = null)
    // {
    //     $this->components[] = [
    //         'type' => 'action',
    //         'component' => [
    //             'caption' => $caption,
    //             'action' => $action,
    //             'form' => $form
    //         ]
    //     ];
    //
    //     $form->addHidden('action');
    // }

    // public function addDropdown($name, $options, $form = null)
    // {
    //     $this->components[] = [
    //         'type' => 'dropdown',
    //         'component' => [
    //             'name' => $name,
    //             'options' => $options,
    //             'form' => $form
    //         ]
    //     ];
    //
    //     $form->addHidden($name);
    // }

    // public function renderAction($caption, $action, $form)
    // {
    //     if ($form) {
    //         $hiddenName = $form->getHiddenName('action');
    //         $formId = $form->getId();
    //     }
    //
    //     return '
    //         <input type="submit" class="button fw-input" onclick="
    //         document.getElementById(\'' . $hiddenName . '\').value=\'' . $action . '\';
    //         document.getElementById(\'' . $formId . '\').submit();
    //         this.blur();" value="' . $caption . '">
    //     ';
    // }
}
