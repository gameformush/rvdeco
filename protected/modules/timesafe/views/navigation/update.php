<?php
$this->breadcrumbs=array(
    Navigation::modelTitle()=> array('list'),
    'Редактирование "'.$model->title.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>