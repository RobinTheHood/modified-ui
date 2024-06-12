<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class SplitPanel extends View
{
    private $left;
    private $right;
    private $leftWidth = '50%';
    private $rightWidth = '50%';

    public function getViewName()
    {
        return 'SplitPanel';
    }

    public function setLeftWidth($width)
    {
        $this->leftWidth = $width . '%';
        $this->rightWidth = (100 - $width) . '%';
    }

    public function setLeft($component)
    {
        $this->left = $component;
        $this->addComponent($this->left);
    }

    public function setRight($component)
    {
        $this->right = $component;
        $this->addComponent($this->right);
    }

    public function render()
    {
        $leftContent = '';
        $rightContent = '';

        if ($this->left) {
            $leftContent = $this->left->render();
        }

        if ($this->right) {
            $rightContent = $this->right->render();
        }

        return '
            <div id="' . $this->getViewId() . '" class="rth-modified-ui-splitpanel">
                <div class="rth-modified-ui-splitpanel-left" style="width: ' . $this->leftWidth . '">
                    ' . $leftContent . '
                </div>
                <div class="rth-modified-ui-splitpanel-right" style="width: ' . $this->rightWidth . '">
                    ' . $rightContent  . '
                </div>
            </div>
        ';
    }
}
