<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class TableRow extends View
{
    private $tableCells;
    private $headingEnabled;

    public function getViewName()
    {
        return 'TableRow';
    }

    public function addTableCell($tableCell)
    {
        $this->tableCells[] = $tableCell;
        $tableCell->setParentComponent($this);
        $tableCell->setIndexByArray($this->tableCells);
    }

    public function enableHeading()
    {
        $this->headingEnabled = true;
    }

    public function isHeading()
    {
        return $this->headingEnabled;
    }


    public function select($name, $value)
    {
        foreach($this->tableCells as $tableCell) {
            $tableCell->select($name, $value);
        }
    }
    
    public function render()
    {
        if ($this->headingEnabled) {
            return '
                <tr id="' . $this->getViewId() . '" class="rth-modified-ui-table-row">
                    ' . $this->renderTableCells() . '
                </tr>
            ';

        } else {
            return '
                <tr id="' . $this->getViewId() . '" class="rth-modified-ui-table-row">
                    ' . $this->renderTableCells() . '
                </tr>
            ';

        }

    }

    public function renderTableCells()
    {
        $html = '';
        foreach($this->tableCells as $tableCell)
        {
            $html .= $tableCell->render();
        }
        return $html;
    }
}
