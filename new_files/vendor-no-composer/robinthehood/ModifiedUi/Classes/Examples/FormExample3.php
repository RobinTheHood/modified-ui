<?php
namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Form;
use RobinTheHood\ModifiedUi\Classes\Admin\Label;
use RobinTheHood\ModifiedUi\Classes\Admin\TextField;
use RobinTheHood\ModifiedUi\Classes\Admin\SplitPanel;
use RobinTheHood\ModifiedUi\Classes\Admin\TextArea;
use RobinTheHood\ModifiedUi\Classes\Admin\Table;

class FormExample3
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Heading: Test05');
        $page->setSubHeading('Subheading: Form-Test');
        $page->setIconPath(DIR_WS_ICONS . 'heading/fw_multi_order.png');

        $form = new Form();
        $page->addComponent($form);

        $label = new Label();
        $label->setValue('Vor- und Nachname:');
        $textField = new TextField('name');

        $splitPanel = new SplitPanel();
        $splitPanel->setLeftWidth(20);
        $splitPanel->setLeft($label);
        $splitPanel->setRight($textField);

        $form->addComponent($splitPanel);

        $textArea = new TextArea('description');
        $label = new Label();
        $label->setValue('Deine Beschreibung:');
        $splitPanel = new SplitPanel();
        $splitPanel->setLeftWidth(20);
        $splitPanel->setLeft($label);
        $splitPanel->setRight($textArea);
        $form->addComponent($splitPanel);

        $table = new Table();
        $table->addCollumn('Name');
        $table->addCollumn('Best.Nr.');
        $table->addCollumn('Versand nach');
        $table->addCollumn('Gesamtwert');
        $table->addCollumn('Bestelldatum');
        $table->addCollumn('Zahlungsweise');
        $table->addCollumn('Status');
        $table->addCollumn('Aktion');

        $label = new Label();
        $label->setValue('Eine kleine Tabelle:');
        $splitPanel = new SplitPanel();
        $splitPanel->setLeftWidth(20);
        $splitPanel->setLeft($label);
        $splitPanel->setRight($table);
        $form->addComponent($splitPanel);

        // USE VIEW
        $ids = [23, 43, 1, 45];
        foreach($ids as $id) {
            $table->addRow([$id, 'A', 'B', 'C', 'D', 'E', 'F', 'G']);
        }

        $page->render();
    }
}