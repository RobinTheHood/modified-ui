<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

class JsBuilder
{
    /**
     * @param string $viewId
     * @param string $value
     * @return string Returns JavaScript code as string.
     */
    public static function jsSetValueRaw(string $viewId, $value): string
    {
        return 'document.getElementById(\'' . $viewId . '\').value=\'' . $value . '\';';
    }

    /**
     * @param View $view
     * @param string $value
     * @return string Returns JavaScript code as string.
     */
    public static function jsSetValue($view, $value)
    {
        return self::jsSetValueRaw($view->getViewId(), $value);
    }


    /**
     * @param string $viewIdSrc
     * @param string $viewIdDest
     * @return string Returns JavaScript code as string.
     */
    public static function jsCopyValueRaw($viewIdSrc, $viewIdDest): string
    {
        return '
            var copyValue = document.getElementById(\'' . $viewIdSrc . '\').value;
            document.getElementById(\'' . $viewIdDest . '\').value=copyValue;
        ';
    }

    /**
     * @param View $viewSrc
     * @param View $viewDest
     * @return string Returns JavaScript code as string.
     */
    public static function jsCopyValue($viewSrc, $viewDest): string
    {
        return self::jsCopyValueRaw($viewSrc->getViewId(), $viewDest->getViewId());
    }


    /**
     * @param string $viewId
     * @return string Returns JavaScript code as string.
     */
    public static function jsSubmitRaw(string $viewId): string
    {
        return 'document.getElementById(\'' . $viewId . '\').submit(); this.blur();';
    }

    /**
     * @param View $view
     * @return string Returns JavaScript code as string.
     */
    public static function jsSubmit($view): string
    {
        return self::jsSubmitRaw($view->getViewId());
    }



    /**
     * @param string $url
     * @param string $data
     * @param string $jsSuccessFunction
     * @return string Returns JavaScript code as string.
     */
    public static function jsGetRequestRaw($url, $data, $jsSuccessFunction): string
    {
        return '
            $.get(\'' . $url . '\', ' . $data . ', function(data) {
                ' . $jsSuccessFunction . '
            });
        ';
    }

    /**
     * @param string $url
     * @param array $params
     * @param string $jsSuccessFunction
     * @return string Returns JavaScript code as string.
     */
    public static function jsGetRequest($url, $params, $jsSuccessFunction): string
    {
        $data = '';
        foreach ($params as $key => $value) {
            $data .= $key . ': ' .  $value;
        }
        $data = '{' . $data . '}';

        return self::jsGetRequestRaw($url, $data, $jsSuccessFunction);
    }


    /**
     * @param string $viewIdSrc
     * @param string $viewIdDest
     * @return string Returns JavaScript code as string.
     */
    public static function jsCopyCheckedRaw(string $viewIdSrc, string $viewIdDest): string
    {
        return '
            var checked = document.getElementById(\'' . $viewIdSrc . '\').checked;
            document.getElementById(\'' . $viewIdDest . '\').checked=checked;
        ';
    }

    /**
     * @param View $viewSrc
     * @param View $viewDest
     * @return string Returns JavaScript code as string.
     */
    public static function jsCopyChecked($viewSrc, $viewDest): string
    {
        return self::jsCopyCheckedRaw($viewSrc->getViewId(), $viewDest->getViewId());
    }

    /**
     * @return string Returns JavaScript code as string.
     */
    public static function jsEvalGetResult()
    {
        return '
            var obj = JSON.parse(data);
            eval(obj.js);
        ';
    }
}
