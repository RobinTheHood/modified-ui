<?php
namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Button;

class JsEventExample1
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('JavaScript Event Example 1');
        $page->setSubHeading('A nice subheading for js example 1');

        $button = new Button();
        $button->addJsOnClick(function() {
            return "alert('test');";
        });

        $page->addComponent($button);

        $page->render();
    }
}