<?php
$this->breadcrumbs = array(
    Navigation::modelTitle()=> array('list'),
    'Добавить'
);
$this->renderPartial(
    '_form', 
    array(
		'model' => $model,
	)
); ?>
