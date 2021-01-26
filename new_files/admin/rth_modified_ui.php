<?php
require_once 'includes/application_top.php';
require_once DIR_FS_DOCUMENT_ROOT . '/vendor-no-composer/autoload.php';

restore_error_handler();
restore_exception_handler();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

\RobinTheHood\ModifiedUi\Classes\Examples\Example1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\PageExample1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\PanelExample1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\TableExample1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\FormExample1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\FormExample2::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\FormExample3::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\TabPanelExample1::run();
// \RobinTheHood\ModifiedUi\Classes\Examples\JsEventExample1::run();