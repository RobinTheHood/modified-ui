<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

class State extends View
{
    private $values = [];

    public function registerGet($name, $default = '')
    {
        if (isset($_GET[$name])) {
            $value = $_GET[$name];
            $this->values[$name] = $value;
            $_SESSION['state']['values'][$name] = $value;
        } elseif (isset($_SESSION['state']['values'][$name])) {
            $this->values[$name] = $_SESSION['state']['values'][$name];
        } elseif ($default) {
            $this->values[$name] =  $default;
        }
    }

    public function get($name)
    {
        if (isset($this->values[$name])) {
            return $this->values[$name];
        } else {
            return '';
        }
    }
}
