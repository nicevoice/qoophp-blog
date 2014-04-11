<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Form;


use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class UserSettingForm extends Form
{
    public function initialize($user, $options)
    {

        $form['nickname'] = new Text("nickname", array(
            'maxlength' => 20,
            'class'=>"form-control"
        ));
        $form['nickname']->addValidator(new PresenceOf(array('message'=>'nickname is required')));
        $form['nickname']->addValidator(new StringLength(array(
            'min' => 5,
            'max' => 12,
            'messageMinimum' => 'The nickname is too short'
        )));

        //password
        $user->password = '';
        $form['password'] = new Password('password', array(
            'maxlength' => 16,
            'class'=>"form-control"
        ));

        //repassword
        $form['repassword'] = new Password('repassword', array(
            'maxlength' => 16,
            'class'=>"form-control"
        ));

        $this->generateForm($form);
    }

    private function generateForm($form)
    {
        foreach ($form as $value) {
            $this->add($value);
        }
    }
} 