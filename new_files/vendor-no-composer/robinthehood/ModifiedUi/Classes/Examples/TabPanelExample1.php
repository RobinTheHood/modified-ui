<?php
namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Label;
use RobinTheHood\ModifiedUi\Classes\Admin\TabPanel;

class TabPanelExample1
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Heading: Test08');
        $page->setSubHeading('Subheading: Tabpanel-Test');
        $page->setIconPath(DIR_WS_ICONS . 'heading/fw_multi_order.png');

        $label1 = new Label();
        $label1->setValue('Label1');
        $label2 = new Label();
        $label2->setValue('Label2');
        $label3 = new Label();
        $label3->setValue('Label3');

        $tabPanel = new TabPanel();
        $tabPanel->addTab('Bestellungen', $label1);
        $tabPanel->addTab('Eistellungen', $label2);
        $tabPanel->addTab('Sonstiges', $label3);

        $page->addComponent($tabPanel);

        $page->render();
    }
}