<?php

namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\State;
use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\TablePanel;
use RobinTheHood\ModifiedUi\Classes\Admin\Table;
use RobinTheHood\ModifiedUi\Classes\Admin\Label;
use RobinTheHood\ModifiedUi\Classes\Admin\Form;
use RobinTheHood\ModifiedUi\Classes\Admin\Pagination;
use RobinTheHood\ModifiedUi\Classes\Admin\ActionPanel;
use RobinTheHood\ModifiedUi\Classes\Admin\SplitPanel;
use RobinTheHood\ModifiedUi\Classes\Admin\FilterPanel;
use RobinTheHood\ModifiedUi\Classes\Admin\Panel;
use RobinTheHood\ModifiedUi\Classes\Admin\TabPanel;

class Example1
{
    public static function run()
    {
        // *** Create View ***
        $state = new State();
        $state->registerGet('customerFilter');
        $state->registerGet('productModelFilter');
        $state->registerGet('productModeFilter');
        $state->registerGet('orderStatus', -1);

        $page = new Page();
        $page->setHeading('Modified UI Example');
        $page->setSubHeading('Kunden');
        $page->setIconPath(DIR_WS_ICONS . 'heading/xxx.png');

        $table = new TablePanel();
        $table->addCollumn('id', Table::CHECKBOX, Table::CENTER);
        $table->addCollumn('Name', Table::TEXT, Table::LEFT);
        $table->addCollumn('Best.Nr.', Table::TEXT, Table::LEFT);
        $table->addCollumn('Versand nach', Table::TEXT, Table::LEFT);
        $table->addCollumn('Gesamtwert', Table::TEXT, Table::LEFT);
        $table->addCollumn('Bestelldatum', Table::TEXT, Table::LEFT);
        $table->addCollumn('Zahlungsweise', Table::TEXT, Table::LEFT);
        $table->addCollumn('Status', Table::TEXT, Table::LEFT);
        $table->addCollumn('Aktion', Table::TEXT, Table::RIGHT);

        $form = new Form('orderIds');
        $form->addComponent($table);
        // $form->onSend(function($form) {
        //     $controller->invoke();
        // });

        $pagination = new Pagination();
        $form->addComponent($pagination);

        $actionPanel = new ActionPanel();
        $actionPanel->addSelect('', 'pdfType', [
            ['value' => 'bills', 'name' => 'Rechnung'],
            ['value' => 'deliveryNotes', 'name' => 'Lieferschein'],
            ['value' => 'billsAndDeliveryNotes', 'name' => 'Rechnung & Lieferschein'],
            ['value' => 'billsAndDeliveryNotesMixed', 'name' => 'Rechnung & Lieferschein abwechselnd']
        ])->addJsConnectWithForm($form);
        $actionPanel->addAction('PDF erzeugen ...')
            ->addJsSubmitForm($form, 'createPdf');

        // $actionPanel->addAction('Rechnungen PDF ...')
        //     ->addJsSubmitForm($form, 'bills');
        // $actionPanel->addAction('Lieferschein PDF ...')
        //     ->addJsSubmitForm($form, 'deliveryNotes');
        // $actionPanel->addAction('Lieferschein & Rechnung PDF ...')
        //     ->addJsSubmitForm($form, 'billsAndDeliveryNotes');
        // $actionPanel->addAction('Lieferschein & Rechnung PDF Mixed ...')
        //     ->addJsSubmitForm($form, 'billsAndDeliveryNotesMixed');

        $actionPanel->addSeparator();

        $actionPanel->addSelect('', 'orderStatus', [
            ['value' => -1, 'name' => 'Status nicht ändern'],
            ['value' => 1, 'name' => 'Offen'],
            ['value' => 2, 'name' => 'In Bearbeitung'],
            ['value' => 3, 'name' => 'Versendet'],
            ['value' => 4, 'name' => 'Storniert']
        ])->addJsConnectWithForm($form);

        $actionPanel->addSelect('', 'notifyCustomer', [
            ['value' => 'no', 'name' => 'Kunde nicht benachrichtigen'],
            ['value' => 'yes', 'name' => 'Kunde benachrichtigen ohne Trackingcode'],
            ['value' => 'yes-code', 'name' => 'Kunde benachrichtigen inkl. Trackingcode']
        ])->addJsConnectWithForm($form);

        $actionPanel->addAction('Status ändern ...')
            ->addJsSubmitForm($form, 'changeOrderStatus');

        $splitPanel = new SplitPanel();
        $splitPanel->setLeftWidth(75);
        $splitPanel->setLeft($form);

        $splitPanel->setRight($actionPanel);

        // $pagination = new Pagination();
        // $sql = $pagination->init('SELECT * FROM orders');
        //
        // $table->addPagination($pagination);

        $filterPanel = new FilterPanel();
        $filterPanel->addTextField('Kunde:', 'customerFilter', $state->get('customerFilter'));
        $filterPanel->addTextField('Artikelnr.:', 'productModelFilter', $state->get('productModelFilter'));
        $filterPanel->addSelect('', 'productModeFilter', [
            ['value' => 1, 'name' => 'Produkt auch enthalten'],
            ['value' => 2, 'name' => 'nur dieses Produkt enthalten']
        ], $state->get('productModeFilter'));

        $filterPanel->addSelect('Status:', 'orderStatus', [
            ['value' => -1, 'name' => 'Status nicht ändern'],
            ['value' => 1, 'name' => 'Offen'],
            ['value' => 2, 'name' => 'In Bearbeitung'],
            ['value' => 3, 'name' => 'Versendet'],
            ['value' => 4, 'name' => 'Storniert']
        ], $state->get('orderStatus'));


        $settingsPanel = new Panel();
        $settingsForm = new Form();

        $billImagePath = $settingsForm->addTextField('imagePath', 'Bildpfad');
        $billImagePath->setValue('/images/logo.png');

        $billHeading = $settingsForm->addTextField('billHeading', 'Rechnungskopf');
        $billHeading->setValue('www.domain.de - Dein Slogan');

        $billTitle = $settingsForm->addTextField('billTitle', 'Titel');
        $billTitle->setValue('Rechung');

        $billSmallAddress = $settingsForm->addTextField('smallAddress', 'Sichtfensterabsender');
        $billSmallAddress->setValue('domain.de - Hauptstraße 1 - 12345 Neustadt');

        $billIntroTextMale = $settingsForm->addTextField('introTextMale', 'Einleitung (Mann)');
        $billIntroTextMale->setValue('Sehr geehrter Herr {firstName} {lastName},\nwir freuen uns, dass Sie bei domain.de bestellt haben.');

        $billIntroTextFemale = $settingsForm->addTextField('introTextFemale', 'Einleitung (Frau)');
        $billIntroTextFemale->setValue('Sehr geehrte Frau {firstName} {lastName},\nwir freuen uns, dass Sie bei domain.de bestellt haben.');

        $billIntroTextUnisex = $settingsForm->addTextField('introTextUnisex', 'Einleitung (Unisex)');
        $billIntroTextUnisex->setValue('Sehr geehrter Kunde / sehr geehrte Kundin,\nwir freuen uns, dass Sie bei domain.de bestellt haben.');

        $billVatFree = $settingsForm->addTextField('vatFree', 'Steuerfreie Lieferung');
        $billVatFree->setValue('Die Waren sind nach $4 Nr. 1 b UStG steuerfrei, da es sich um eine innergemeinschaftliche Lieferung/Intra-Community delivery handelt.');

        $billEndText = $settingsForm->addTextArea('endText', 'Schlusssatz');
        $billEndText->setValue("Vielen Dank für Ihren Auftrag.\nBesuchen Sie uns wieder unter www.domain.de.\nLeistungsdatum entspricht Rechnungsdatum.\nEs gelten unsere Allgemeinen Geschäftsbedingungen.");

        $billFooter = $settingsForm->addTextArea('introTextUnisex', 'Footer');
        $billFooter->setValue("{COLLUMN1}\n    Anschrift:\n    NAME NAME\n    STRASSE 123\n    12345 STADT\n    LAND\n{/COLLUMN1}\n\n{COLLUMN2}\n    Anschrift:\n    NAME NAME\n    STRASSE 123\n    12345 STADT\n    LAND\n{/COLLUMN2}\n\n{COLLUMN3}\n    Anschrift:\n    NAME NAME\n    STRASSE 123\n    12345 STADT\n    LAND\n{/COLLUMN3}");

        // $billHeadingLabel = new Label();
        // $billHeadingLabel->setValue('Rechnungskopf');
        // $billHeading = new TextField('billHeading');
        // $settingsForm->addComponent($billHeadingLabel);
        // $settingsForm->addComponent($billHeading);
        //
        // $billSmallAddressLabel = new Label();
        // $billSmallAddressLabel->setValue('Sichtfensterabsender');
        // $billSmallAddress = new TextField('smallAddress');
        // $settingsForm->addComponent($billSmallAddressLabel);
        // $settingsForm->addComponent($billSmallAddress);

        $settingsPanel->addComponent($settingsForm);

        $commentPanel = new Panel();

        $commentTable = new TablePanel();
        $commentTable->addCollumn('id', Table::CHECKBOX, Table::CENTER);
        $commentTable->addCollumn('Name', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Best.Nr.', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Versand nach', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Gesamtwert', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Bestelldatum', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Zahlungsweise', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Status', Table::TEXT, Table::LEFT);
        $commentTable->addCollumn('Aktion', Table::TEXT, Table::RIGHT);
        $commentPanel->addComponent($commentTable);

        $settingsTabPanel = new TabPanel();
        $settingsTabPanel->addTab('Rechnung', $settingsPanel);
        $settingsTabPanel->addTab('Kommentare', $commentPanel);

        $tabPanel = new TabPanel();
        $tabPanel->addTab('Bestellungen', $filterPanel)
            ->addComponent($splitPanel);
        $tabPanel->addTab('Einstellungen', $settingsTabPanel);
        $tabPanel->addTab('Sonstiges', new Label('Sonstiges'));

        //$page->addComponent($filterPanel);
        //$page->addComponent($splitPanel);
        $page->addComponent($tabPanel);

        // *** Use View ***
        $ids = [23, 43, 1, 45, 3, 4, 6, 11, 2, 33];
        foreach ($ids as $id) {
            $table->addRow([$id, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
        }
        $table->selectMultible(0, $_POST['ids']);

        foreach ($ids as $id) {
            $commentTable->addRow([$id, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']);
        }
        $commentTable->selectMultible(0, $_POST['ids']);

        // *** Render View ***
        $page->render();
    }
}
