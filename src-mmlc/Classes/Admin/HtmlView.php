<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class HtmlView extends View
{
    private $html;

    public function getViewName()
    {
        return 'HtmlView';
    }

    public function setHtml($html)
    {
        $this->html = $html;
    }

    public function loadHtml($path, $vars = [])
    {
        ob_start();
        require $path;
        $html = ob_get_contents();
        ob_end_clean();
        $this->html = $html;
    }

    public function render()
    {
        return $this->html;
    }
}
