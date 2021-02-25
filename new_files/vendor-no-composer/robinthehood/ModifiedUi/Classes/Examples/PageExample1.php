<?php

namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;

class PageExample1
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Page Example 1');
        $page->setSubHeading('A nice subheading');

        $page->render();
    }

    public static function runAlternative1()
    {
        $page = new Page();
        $heading = $page->setHeading('Page Example 1');
        $heading->setSubHeading('Alternative 1 subheading');

        $page->render();
    }
}
