<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class TableCell extends View
{
    private $value;
    private $textAlign = Table::LEFT;

    public function getViewName()
    {
        return 'TableCell';
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setTextAlign($textAlign)
    {
        $this->textAlign = $textAlign;
    }


    public function select($name, $value)
    {
        $components = $this->getComponents();
        foreach($components as $component) {
            if ($component instanceof Checkbox) {
                if ($component->getValue() == $value) {
                    $component->setChecked(true);
                }
            }
        }
    }

    public function render()
    {
        $parentComponent = $this->getParenComponent();

        $contentHtml = parent::render();
        if (!$contentHtml) {
            $contentHtml = $this->value;
            if ($parentComponent->isHeading()) {
                $contentHtml .= '<i class="fas fa-sort fa-fw"></i>';
            }
        }



        if ($parentComponent->isHeading()) {
            return '
                <th id="' . $this->getViewId() . '" class="rth-modified-ui-table-cell" ' . $this->renderStyle() . '>
                    ' . $contentHtml . '
                </th>
            ';

        } else {
            return '
                <td id="' . $this->getViewId() . '" class="rth-modified-ui-table-cell" ' . $this->renderStyle() . '>
                    ' . $contentHtml . '
                </td>
            ';
        }
    }

    public function renderStyle()
    {
        if ($this->textAlign == Table::LEFT) {
            return 'style="text-align: left"';
        } elseif ($this->textAlign == Table::RIGHT) {
            return 'style="text-align: right"';
        } elseif ($this->textAlign == Table::CENTER) {
            return 'style="text-align: center"';
        }
    }
}
