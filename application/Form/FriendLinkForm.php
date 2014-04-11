<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Form;


use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class FriendLinkForm extends Form
{
    public function initialize($model)
    {
        $this->add(new Text('name', array(
            'class' => 'form-control',
            'maxlength' => 20,
            'placeholder'=>'链接名称'
        )));

        $this->add(new Text('link', array(
            'class' => 'form-control',
            'maxlength' => 120,
            'placeholder'=>'链接地址'
        )));

        $this->add(new Text('logo', array(
            'class' => 'form-control',
            'maxlength' => 250,
            'placeholder'=>'LOGO'
        )));

        $this->add(new Select('weight', array(0,1,2,3,4,5)));
    }
} 