<?php
$this->breadcrumbs=array(
    Subscriber::modelTitle()=> array('list'),
    'Редактирование "'.$model->email.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>