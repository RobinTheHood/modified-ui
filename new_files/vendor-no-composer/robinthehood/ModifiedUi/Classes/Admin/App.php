<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;


class App
{
    public static $callFunctions = [];

    public static function callFunctions($view)
    {
        if ($_GET['__rth_modified_ui_reload']) {
            $component = $view->getComponentsByViewId($_GET['__rth_modified_ui_reload']);
            if ($component) {
                $html = json_encode($component->render());
                $result['js'] = '$(\'#' . $component->getViewId() . '\').html(' . $html . ');';
                echo \json_encode($result);
                die();
            }
        }
        // if ($_GET['jsCallFunction']) {
        //
        //
        //     $html = json_encode($_GET);
        //     $result['html'] = $html;
        //     //$result['js'] = '$(\'#' . $component->getViewId() . '\').html(' . $html . ');';
        //     echo \json_encode($result);
        //     die();
        // }

        $callFunctionName = $_GET['jsCallbackFunction'];
        // var_dump($_GET);
        // var_dump(self::$callFunctions);
        if (self::$callFunctions[$callFunctionName]) {
            $jsBuildFunction = self::$callFunctions[$callFunctionName]();
            $js = $jsBuildFunction();
            $result['js'] = $js;
            echo \json_encode($result);
            die();
        }
    }

    public static function registerFunction($callFunction)
    {
        $functionName = 'jsCallbackFunction' . count(self::$callFunctions);
        self::$callFunctions[$functionName] = $callFunction;
        return $functionName;
    }
}
