<?php
$this->breadcrumbs=array(
    Faq::modelTitle()=> array('list'),
    'Редактирование "'.$model->title.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>