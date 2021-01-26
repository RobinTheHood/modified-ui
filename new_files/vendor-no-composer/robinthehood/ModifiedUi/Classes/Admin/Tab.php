<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Tab extends View
{
    protected $heading;

    public function getViewName()
    {
        return 'Tab';
    }

    public function setHeading($heading)
    {
        $this->heading = $heading;
    }

    public function renderNavItem()
    {
        return '
            <div id="' . $this->getSubViewId('NavItem') . '" class="rth-modified-ui-tabpanel-navitem">
                ' . $this->heading . '
            </div>
        ';
    }

    public function renderTabContent()
    {
        return '
            <div id="' . $this->getViewId() . '" class="rth-modified-ui-tabpanel-content-item">
                ' . parent::render() . '
            </div>
        ';
    }
}
