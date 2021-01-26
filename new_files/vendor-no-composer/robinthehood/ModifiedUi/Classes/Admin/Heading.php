<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Heading extends View
{
    private $heading = 'No heading';
    private $subHeading = 'No sub-heading';
    private $iconPath = DIR_WS_ICONS . 'heading/icon_modules.png';

    public function getViewName()
    {
        return 'Heading';
    }

    public function setHeading($heading)
    {
        $this->heading = $heading;
    }

    public function setSubHeading($subHeading)
    {
        $this->subHeading = $subHeading;
    }

    public function setIconPath($path)
    {
        if (file_exists($path)) {
            $this->iconPath = $path;
        }
    }


    public function render()
    {
        return '
            <div id="' . $this->getViewId() . '" class="rth-modified-ui-page-heading">
                <div class="rth-modified-ui-page-heading-image">
                    ' . xtc_image($this->iconPath) . '
                </div>

                <div class="rth-modified-ui-page-heading-text">
                    ' . $this->heading . '
                </div>

                <div class="rth-modified-ui-page-heading-subtext">
                    ' . $this->subHeading . '
                </div>
            </div>
        ';
    }

    public function renderOld()
    {
        return '
            <div id="' . $this->getViewId() . '">
                <div class="pageHeadingImage">
                    ' . xtc_image($this->iconPath) . '
                </div>

                <div class="pageHeading flt-l">
                    ' . $this->heading . '
                    <div class="main pdg2">
                        ' . $this->subHeading . '
                    </div>
                </div>

                <div style="clear: both"></div>
            </div>
        ';
    }
}
