<?php
/**
 * @author: Rogee<rogeeyang@gmail.com>
 */

namespace Form;


use Models\Category;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Form;

class ArticleForm extends Form
{
    public function initialize($model)
    {
        $this->add(new Text('name', array(
            'class' => 'form-control input-lg',
            'style' => 'border:none; border-radius: 0;',
            'autocomplete' =>"off",
            'maxlength' => 40,
            'placeholder'=>'文章名称'
        )));

        $this->add(new TextArea('description', array(
            'class' => 'form-control',
            'maxlength' => 100,
            'placeholder'=>'文章描述',
            'style' => 'height: 84px;'
        )));

        $this->add(new Text('slug', array(
            'class' => 'form-control',
            'maxlength' => 120,
            'placeholder'=>'文章别名'
        )));

        $this->add(new Text('tag', array(
            'class' => 'form-control',
            'placeholder'=>'文章Tag'
        )));

        $this->add(new Select('category_id', Category::find(), array(
            'using' => array('id', 'name'),
            'class' => 'form-control'
        )));

        $this->add(new TextArea('content', array(
            'placeholder'=>'文章内容',
            'id' => "content_container",
            'class' => 'form-control',
            'style' => "min-height: 500px;width:100%"
        )));
    }
} 