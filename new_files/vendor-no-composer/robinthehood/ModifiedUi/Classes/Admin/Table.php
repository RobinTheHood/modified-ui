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
                    //return $this->jsCopyChecked($collumn['checkbox']->getViewId(), $checkbox->getViewId());
                });
            }

            $tableRow->addTableCell($tableCell);
        }

        $this->addTableRow($tableRow);
    }

    // public function jsCopyChecked($viewIdSrc, $viewIdDes)
    // {
    //     return '
    //         var checked = document.getElementById(\'' . $viewIdSrc . '\').checked;
    //         document.getElementById(\'' . $viewIdDes . '\').checked=checked;
    //     ';
    // }

    public function addTableRow($tableRow)
    {
        $this->tableRows[] = $tableRow;
        $tableRow->setParentComponent($this);
        $tableRow->setIndexByArray($this->tableRows);
    }

    public function select($name, $value)
    {
        //$this->selections[$name][$id] = true;

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
        //($this->loadFunction)($this);
        // if ($this->loadFunction) {
        //     $function = $this->loadFunction;
        //     $function($this);
        // }

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

    //////////// OLD


    // public function renderOff()
    // {
    //     return '
    //                 <table class="rth-modified-ui-table">
    //                     <thead>
    //                         <tr>
    //                             <th>Vorname</td>
    //                             <th>Nachname</td>
    //                             <th>Alter</td>
    //                             <th>Geschlecht</td>
    //                         </tr>
    //                     </thead>
    //                     <tbody>
    //                         <tr>
    //                             <td>Robin</td>
    //                             <td>Wieschendorf</td>
    //                             <td>32</td>
    //                             <td>männlich</td>
    //                         </tr>
    //
    //                         <tr>
    //                             <td>Catrin</td>
    //                             <td>Gloystein</td>
    //                             <td>31</td>
    //                             <td>weiblich</td>
    //                         </tr>
    //
    //                         <tr>
    //                             <td>Jenny</td>
    //                             <td>Hoffmann</td>
    //                             <td>30</td>
    //                             <td>weiblich</td>
    //                         </tr>
    //                     </tbody>
    //                 </table>
    //     ';
    // }

    // public function addCollumnOld($component, $alignment = 'left')
    // {
    //     if ($component instanceof Checkbox) {
    //         $type = 'checkbox';
    //     } else {
    //         $type = 'text';
    //     }
    //
    //     $this->collumns[] = [
    //         'component' => $component,
    //         'alignment' => $alignment,
    //         'type' => $type
    //     ];
    // }

    // public function setCheckbox($name)
    // {
    //     $checkbox = new Checkbox();
    //     $checkbox->setName($name);
    //     $this->checkbox = $checkbox;
    // }

    // public function addForm($form)
    // {
    //     $this->form = $form;
    // }

    // public function renderOld()
    // {
    //     $html = '';
    //
    //     if ($this->form) {
    //         $html .= $this->form->renderOpen();
    //     }
    //
    //     $html .= $this->renderTable();
    //
    //     if ($this->form) {
    //         $html .= $this->form->renderClose();
    //     }
    //
    //     $html .= $this->renderScript();
    //
    //     return $html;
    // }

    // public function renderTable()
    // {
    //     return '
    //         <table class="tableBoxCenter collapse">
    //             <tbody>
    //                 <tr class="dataTableHeadingRow">
    //                     ' . $this->renderHeadings() . '
    //                 </tr>
    //                 ' . $this->renderRows() . '
    //             </tbody>
    //         </table>
    //         ';
    // }

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

    // public function renderHeadings()
    // {
    //     $html = '';
    //
    //     if ($this->checkbox) {
    //         $html .= '
    //             <td class="dataTableHeadingContent">
    //                 ' . $this->checkbox->render() . '
    //             </td>
    //         ';
    //     }
    //
    //     foreach($this->collumns as $collumn) {
    //         if ($collumn['type'] == 'checkbox') {
    //             $html .= '
    //                 <td class="dataTableHeadingContent">
    //                     ' . $collumn['component']->render() . '
    //                 </td>
    //             ';
    //         } else {
    //             $html .= '<td class="dataTableHeadingContent">' . $collumn['component'] . '</td>' . "\n";
    //         }
    //     }
    //     return $html;
    // }

    // public function renderRowsOld()
    // {
    //     $html = '';
    //
    //     foreach($this->rows as $row) {
    //         $html .= $this->renderRow($row['values'], $row['id']);
    //     }
    //     return $html;
    // }

    // public function renderRow($row, $rowId)
    // {
    //     $html = '<tr class="dataTableRow">';
    //
    //     for ($i = 0; $i<count($this->collumns); $i++) {
    //         $collumnType = $this->collumns[$i]['type'];
    //         $collumnComponent = $this->collumns[$i]['component'];
    //         $cellValue = $row[$i];
    //         $cellHtml = '';
    //
    //         if ($collumnType == 'text') {
    //             if (is_object($cell)) {
    //                 $cellHtml = $cellValue->render();
    //             } else {
    //                 $cellHtml = $cellValue;
    //             }
    //         } elseif ($collumnType == 'checkbox') {
    //             $cellHtml = $this->renderCheckbox($collumnComponent, $cellValue, $rowId);
    //         }
    //
    //         $html .= '<td class="dataTableContent">' . $cellHtml . '</td>';
    //     }
    //     $html .= '</tr>';
    //
    //     return $html;
    // }

    // public function renderCheckbox($checkbox, $value, $rowId)
    // {
    //     $name = $checkbox->getName();
    //
    //     $newCheckbox = new Checkbox();
    //     $newCheckbox->setName($name . '[]');
    //     $newCheckbox->setValue($value);
    //
    //     if ($this->selections[$name][$rowId]) {
    //         $newCheckbox->setChecked(true);
    //     }
    //
    //     return $newCheckbox->render();
    // }
}
