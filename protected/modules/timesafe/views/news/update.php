<?php
$this->breadcrumbs=array(
    News::modelTitle()=> array('list'),
    'Редактирование "'.$model->title.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>