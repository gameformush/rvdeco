<?php
$this->breadcrumbs=array(
    Profile::modelTitle()=> array('list'),
    'Редактирование "'.$model->name.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>