<?php

namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Table;

class TableExample1
{
    public static function run()
    {
        // *** Create View ***
        $page = new Page();
        $page->setHeading('Table Example 1');
        $page->setSubHeading('A nice subheading for table example 1');

        $table = new Table();
        $table->addCollumn('Name');
        $table->addCollumn('Ordernumber');
        $table->addCollumn('Shipping to');
        $table->addCollumn('Total');
        $table->addCollumn('Date');
        $table->addCollumn('Payment');
        $table->addCollumn('Status');
        $table->addCollumn('Action');

        $page->addComponent($table);

        // *** Use View ***
        $ids = [23, 43, 1, 45];
        foreach ($ids as $id) {
            $table->addRow([$id, 'A', 'B', 'C', 'D', 'E', 'F', 'G']);
            $table->select('orderIds', 23);
        }

        $page->render();
    }
}
