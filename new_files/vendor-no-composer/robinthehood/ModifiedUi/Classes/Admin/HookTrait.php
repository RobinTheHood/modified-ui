<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

trait HookTrait
{
    public function addHook($type, $callFunction)
    {
        $hookName = $this->getViewId() . '_' . $type;
        $this->hook[$this->getViewId() . '_' . $type] = $callFunction;
        return $hookName;
    }

    public function callHook()
    {
        $name = $_GET['jsCallFunction'];
        if ($name) {
            $function = $this->hook[$name];
            if ($function) {
                $resultFunction = $function();
                return $resultFunction();
            }
        }
    }

    public function callHooksRecursiv()
    {
        if (\method_exists($this, 'callHook')) {
            return $this->callHook();
        }

        $result = '';
        foreach($this->components as $component) {
            $result .= $component->callHooks();
        }

        return $result;
    }

    public function callHooks()
    {
        $result = $this->callHooksRecursiv();
        if ($result) {
            echo $result;
            die();
        }
    }
}
