<?php
$this->breadcrumbs=array(
    Language::modelTitle()=> array('list'),
    'Редактирование "'.$model->name.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>