<?php
$this->breadcrumbs=array(
    Glossary::modelTitle()=> array('list'),
    'Редактирование "'.$model->title.'"'
);
$this->renderPartial('_form', array(
    'model' => $model, 'page'=>$page
)); ?>