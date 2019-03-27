<?php
$this->breadcrumbs=array(
    Kupon::modelTitle()=> array('list'),
    'Редактирование "'.$model->kod.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>