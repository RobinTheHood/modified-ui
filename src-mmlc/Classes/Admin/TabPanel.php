<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class TabPanel extends View
{
    protected $tabs = [];

    public function getViewName()
    {
        return 'TabPanel';
    }

    public function addTab($heading, $component)
    {
        $tab = new Tab();
        $tab->setHeading($heading);
        $tab->addComponent($component);
        $this->addComponent($tab);

        $this->tabs[] = $tab;

        return $tab;
    }

    public function render()
    {
        return '
            <div id="' . $this->getViewId() . '" class="rth-modified-ui-tabpanel">
                <div class="rth-modified-ui-tabpanel-nav">
                    ' . $this->renderHeadings() . '
                </div>

                <div class="rth-modified-ui-tabpanel-content">
                    ' . $this->renderContent() . '
                </div>
            </div>

            <script>
                rthRegisterTabPanel(\'' . $this->getViewId() . '\');
            </script>
        ';
    }

    public function renderHeadings()
    {
        $html = '';

        foreach ($this->tabs as $tab) {
            $html .= $tab->renderNavItem();
        }

        return $html;
    }

    public function renderContent()
    {
        $html = '';

        foreach ($this->tabs as $tab) {
            $html .= $tab->renderTabContent();
        }

        return $html;
    }
}
