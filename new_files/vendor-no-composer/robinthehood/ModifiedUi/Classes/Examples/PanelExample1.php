<?php

namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Panel;

class PanelExample1
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Panel Example 1');
        
        $panel0 = new Panel();
        $panel1 = new Panel();
        $panel0->addComponent($panel1);

        $page->addComponent($panel0);
        $page->setSubHeading('ViewId of Panel1: ' . $panel1->getViewId());
        
        $page->render();
    }
}
