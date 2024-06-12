<?php

namespace RobinTheHood\ModifiedUi\Classes\Examples;

use RobinTheHood\ModifiedUi\Classes\Admin\Page;
use RobinTheHood\ModifiedUi\Classes\Admin\Form;
use RobinTheHood\ModifiedUi\Classes\Admin\Label;
use RobinTheHood\ModifiedUi\Classes\Admin\TextField;
use RobinTheHood\ModifiedUi\Classes\Admin\Checkbox;
use RobinTheHood\ModifiedUi\Classes\Admin\Radio;
use RobinTheHood\ModifiedUi\Classes\Admin\Select;
use RobinTheHood\ModifiedUi\Classes\Admin\TextArea;
use RobinTheHood\ModifiedUi\Classes\Admin\Action;

class FormExample2
{
    public static function run()
    {
        $page = new Page();
        $page->setHeading('Heading: Test06');
        $page->setSubHeading('Subheading: Form-Test 2');

        $form = new Form();
        $page->addComponent($form);

        // TEXTFIELD
        $label = new Label();
        $label->setValue('Name (Textfield)');
        $textField1 = new TextField('name');
        $form->addComponent($label);
        $form->addComponent($textField1);

        // CHECKBOX
        $label = new Label();
        $label->setValue('Bekleidung (Checkbox)');
        $checkbox1 = new Checkbox('clothing_a');
        $checkbox1->setLabel('T-Shirt');

        $checkbox2 = new Checkbox('clothing_b');
        $checkbox2->setLabel('Hose');

        $form->addComponent($label);
        $form->addComponent($checkbox1);
        $form->addComponent($checkbox2);

        // RADIO
        $label = new Label();
        $label->setValue('Geschlecht (Radio)');
        $radio1 = new Radio('gender');
        $radio1->setValue('female');
        $radio1->setLabel('weiblich');

        $radio2 = new Radio('gender');
        $radio2->setValue('male');
        $radio2->setLabel('männlich');

        $form->addComponent($label);
        $form->addComponent($radio1);
        $form->addComponent($radio2);

        // SELECT
        $label = new Label();
        $label->setValue('Wählen Sie aus (Select)');
        $select = new Select('hunger');

        $form->addComponent($label);
        $form->addComponent($select);

        // TEXTAREA

        $label = new Label();
        $label->setValue('Beschreibung');
        $textArea = new TextArea('description');
        $form->addComponent($label);
        $form->addComponent($textArea);

        $action = new Action();
        $action->setCaption('Absenden');
        $form->addComponent($action);

        $form->onSend(function ($form) use ($textField1) {
            $textField1->setValue($_POST['name']);
        });

        $page->render();
    }
}
