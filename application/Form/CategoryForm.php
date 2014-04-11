<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Form;


use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;

class CategoryForm extends Form
{
    public function initialize($model)
    {
        $this->add(new Text('name', array(
            'class' => 'form-control'
        )));

        $this->add(new Text('slug', array(
            'class' => 'form-control'
        )));
    }
} 