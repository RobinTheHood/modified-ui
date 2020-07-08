<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Table extends View
{
    public const LEFT = 'left';
    public const CENTER = 'center';
    public const RIGHT = 'right';
    public const TEXT = 'text';
    public const CHECKBOX = 'checkbox';

    // private $collumns = [];
    // private $form = null;
    // private $checkbox = null;
    protected $tableRows = [];
    protected $headRow = null;
    protected $collumns = [];

    public function __construct()
    {
        $this->headRow = new TableRow();
        $this->headRow->enableHeading();
        $this->addTableRow($this->headRow);
    }

    public function getViewName()
    {
        return 'Table';
    }

    public function addCollumn($value, $type = self::TEXT, $align = self::LEFT)
    {
        $tableCell = new TableCell();
        $tableCell->setValue($value);
        $tableCell->setTextAlign($align);
        $this->headRow->addTableCell($tableCell);

        $column = [
            'type' => $type,
            'align' => $align
        ];

        if ($type ==  'checkbox') {
            $checkbox = new Checkbox('');
            $tableCell->addComponent($checkbox);
            $column['checkbox'] = $checkbox;
        }

        $this->collumns[] = $column;
    }

    public function addRow($values)
    {
        $index = 0;
        $tableRow = new TableRow();
        foreach($this->collumns as $collumn) {
            $value = $values[$index++];

            $tableCell = new TableCell();

            if ($value instanceof Button) {
                $tableCell->addComponent($value);
            } else {
                $tableCell->setValue($value);
            }
            $tableCell->setTextAlign($collumn['align']);

            if ($collumn['type'] == 'checkbox') {
                $checkbox = new Checkbox('ids[]');
                $checkbox->setValue($value);
                $tableCell->addComponent($checkbox);
                $collumn['checkbox']->addJsOnChange(function() use ($checkbox, $collumn) {
                    return JsBuilder::jsCopyChecked($collumn['checkbox'], $checkbox);
                });
            }

            $tableRow->addTableCell($tableCell);
        }

        $this->addTableRow($tableRow);
    }

    public function addTableRow($tableRow)
    {
        $this->tableRows[] = $tableRow;
        $tableRow->setParentComponent($this);
        $tableRow->setIndexByArray($this->tableRows);
    }

    public function select($name, $value)
    {
        foreach($this->tableRows as $tableRow) {
            $tableRow->select($name, $value);
        }
    }

    public function selectMultible($name, $values)
    {
        if (!is_array($values)) {
            return;
        }

        foreach ($values as $value) {
            $this->select($name, $value);
        }
    }

    public function addLoadFunction($loadFunction)
    {
        $this->loadFunction = $loadFunction;
    }

    public function render()
    {
        return '
            <table id=' . $this->getViewId() . ' class="rth-modified-ui-table">
                <thead>
                    ' . $this->headRow->render() . '
                </thead>

                <tbody>
                    ' . $this->renderRows() . '
                </tbody>
            </table>
        ';
    }


    public function renderRows()
    {
        $html = '';
        $count == 0;
        foreach($this->tableRows as $row) {
            if ($count++ == 0) {
                continue;
            }
            $html .= $row->render();
        }
        return $html;
    }

    

    public function renderScript()
    {
        $html = '';

        foreach($this->collumns as $collumn) {
            if ($collumn['type'] != 'checkbox') {
                continue;
            }

            $name = $collumn['component']->getName();
            $nameRelated = $name . '[]';

            $html .= "
                <script>
                    $('[name=\"$name\"]').change(function() {
                        if ($(this).prop('checked') == true) {
                            $('[name=\"$nameRelated\"]').prop('checked', true);
                        } else {
                            $('[name=\"$nameRelated\"]').prop('checked', false);
                        }
                    });
                </script>
            ";
        }

        return $html;
    }
}
