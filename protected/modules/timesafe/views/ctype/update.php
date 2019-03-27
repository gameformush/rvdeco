<?php
$this->breadcrumbs=array(
    Ctype::modelTitle()=> array('list'),
    'Редактирование "'.$model->title.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>