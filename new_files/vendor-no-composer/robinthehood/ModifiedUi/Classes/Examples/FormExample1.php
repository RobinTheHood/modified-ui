<?php
namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Form;
use RobinTheHood\ModifiedUi\Classes\Admin\Label;
use RobinTheHood\ModifiedUi\Classes\Admin\TextField;
use RobinTheHood\ModifiedUi\Classes\Admin\Action;

class FormExample1
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Form Example 1');
        $page->setSubHeading('A nice subheading for form example 1');
        $page->setIconPath(DIR_WS_ICONS . 'heading/fw_multi_order.png');

        $form = new Form();
        $page->addComponent($form);

        $label = new Label();
        $label->setValue('Firstname:');
        $textField1 = new TextField('firstName');
        $form->addComponent($label);
        $form->addComponent($textField1);

        $label = new Label();
        $label->setValue('Lastname:');
        $textField2 = new TextField('lastName');
        $form->addComponent($label);
        $form->addComponent($textField2);

        $action = new Action();
        $action->setCaption('Submit');
        $form->addComponent($action);

        $form->onSend(function($form) use ($textField1, $textField2) {
            $textField1->setValue($_POST['firstName']);
            $textField2->setValue($_POST['lastName']);
        });

        $page->render();
    }
}