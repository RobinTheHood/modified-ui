<?php

namespace RobinTheHood\ModifiedUi\Classes\Admin;

trait JsEventTrait
{
    /**
     * @var array<callable>
     */
    protected $jsOnClickFunctions = [];

    /**
     * @var array<callable>
     */
    protected $jsOnChangeFunctions = [];
    
    /**
     * @var array<callable>
     */
    protected $jsOnKeyupFunctions = [];

    /**
     * Add a PHP-Callable function which return JavaScript code that
     * will be executed on a JS onClick() event.
     *
     * @param callable():JavaScript $function
     */
    public function addJsOnClick($function)
    {
        if (is_callable($function)) {
            $this->jsOnClickFunctions[] = $function;
        } else {
            die('Error: $function has to be callable');
        }
    }

    /**
     * Add a PHP-Callabe function which return JavaScript code that
     * will be executed on a JS onChange() event.
     *
     * @param callable():JavaScript $function
     */
    public function addJsOnChange($function)
    {
        if (is_callable($function)) {
            $this->jsOnChangeFunctions[] = $function;
        } else {
            die('Error: $function has to be callable');
        }
    }

    /**
     * Add a PHP-Callable function which return JavaScript code that
     * will be executed on a JS onKeyup() event.
     *
     * @param callable():JavaScript $function
     */
    public function addJsOnKeyup($function)
    {
        if (is_callable($function)) {
            $this->jsOnKeyupFunctions[] = $function;
        } else {
            die('Error: $function has to be callable');
        }
    }

    /**
     * @param array<callable():JavaScript> $functions
     */
    public function renderJs(array $functions): string
    {
        $jsCode = '';
        foreach ($functions as $function) {
            $jsCode .= $function();
        } 
        return $jsCode;
    }

    /**
     * @param string $event 
     * @param array<callable():JavaScript> $functions
     */
    public function renderJsEvent(string $event, array $functions): string
    {
        $jsCode = $this->renderJs($functions);
        if ($jsCode) {
            return $event. '="' . $jsCode . '"';
        }
        return '';
    }

    public function renderJsOnClick(): string
    {
        return renderJsEvent('onclick', $this->jsOnClickFunctions);
    }

    public function renderJsOnChange()
    {
        return renderJsEvent('onchange', $this->jsOnChangeFunctions);
    }

    public function renderJsOnKeyup()
    {
        return renderJsEvent('onkeyup', $this->jsOnKeyupFunctions);
    }
}
