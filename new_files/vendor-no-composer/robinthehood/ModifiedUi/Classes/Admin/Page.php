<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;
use RobinTheHood\ModifiedUi\Classes\Admin\Panel;
use RobinTheHood\ModifiedUi\Classes\Admin\Heading;

class Page extends View
{
    private $heading = 'No heading';
    private $subHeading = 'No sub-heading';
    private $iconPath = DIR_WS_ICONS . 'heading/icon_modules.png';
    private $panel = null;
    //private $registeredFunctions = [];

    public function __construct()
    {
        $this->heading = new Heading();
        parent::addComponent($this->heading);

        $this->panel = new Panel();
        parent::addComponent($this->panel);
    }

    public function getViewName()
    {
        return 'Page';
    }

    public function setHeading($heading)
    {
        $this->heading->setHeading($heading);
        return $this->heading;
    }

    public function setSubHeading($subHeading)
    {
        $this->heading->setSubHeading($subHeading);
        return $this->heading;
    }

    public function setIconPath($path)
    {
        $this->heading->setIconPath($path);
        return $this->heading;
    }

    public function addComponent($component)
    {
        $this->panel->addComponent($component);
    }

    // public function registerFunction($function, $functionName)
    // {
    //     $this->registeredFunctions[$functionName] = $function;
    // }
    //
    // public function jsReload($component, $phpFunction)
    // {
    //     $functionName = 'jsCallbackFunction' . count($this->registeredFunctions);
    //     $this->registerFunction($phpFunction, $functionName);
    //
    //     return function () use ($functionName, $component) {
    //         $url = '?jsCallbackFunction=' . $functionName;
    //         $data = [];
    //
    //         return JsBuilder::jsGetReqeust($url, $data, $component);
    //     };
    // }
    //
    // public function callRegisteredFunctions()
    // {
    //     $callFunction = $_GET['jsCallbackFunction'];
    //     if ($this->registeredFunctions[$callFunction]) {
    //         $this->registeredFunctions[$callFunction]();
    //         die();
    //     }
    // }

    public function render()
    {
        $this->content = $this->panel->render();
        require '../vendor-no-composer/robinthehood/ModifiedUi/Templates/Page.tmpl.php';
    }
}
