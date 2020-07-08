<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class FilterPanel extends View
{
    private $components = [];

    public function getViewName()
    {
        return 'FilterPanel';
    }

    public function addTextField($caption, $name, $value = '')
    {
        $textField = new TextField($name);
        $textField->setValue($value);

        $this->addComponent($textField);

        $this->components[] = [
            'type' => 'TextField',
            'component' => [
                'caption' => $caption,
                'textField' => $textField
            ]
        ];

        return $textField;
    }

    public function addSelect($caption, $name, $options, $value = '')
    {
        $select = new Select($name);
        $select->setOptions($options);
        $select->setValue($value);
        $select->addJsOnChange(function() {
            return 'this.form.submit();';
        });

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

    protected function renderSelectFilter($caption, $select)
    {
        return '
            <div class="rth-modified-ui-filter-panel-filter">
                <form name="status" action="' . $_SERVER['PHP_SELF'] . '" method="get">
                    <div class="rth-modified-ui-filter-select-caption">
                        ' . $caption . '
                    </div>
                    <div class="rth-modified-ui-filter-select">
                        ' . $select->render() . '
                    </div>
                </form>
            </div>
        ';
    }

    protected function renderTextFieldFilter($caption, $textField)
    {
        return '
            <div class="rth-modified-ui-filter-panel-filter">
                <form name="status" action="' . $_SERVER['PHP_SELF'] . '" method="get">
                    ' . $caption . '
                    ' . $textField->render() . '
                </form>
            </div>
        ';
    }

    public function render()
    {
        $html = '<div id="' . $this->getViewId() . '" class="rth-modified-ui-filter-panel">';

        foreach($this->components as $component) {
            $type = $component['type'];
            $component = $component['component'];

            if ($type == 'TextField') {
                $html .= $this->renderTextFieldFilter($component['caption'], $component['textField']);

            } elseif ($type == 'Select') {
                $html .= $this->renderSelectFilter($component['caption'], $component['select']);
            }
        }
        $html .= '</div>';

        return $html;
    }
}
