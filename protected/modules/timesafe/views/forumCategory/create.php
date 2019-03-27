<?php
$this->breadcrumbs = array(
    ForumCategory::modelTitle()=> array('list'),
    'Добавить'
);
$this->renderPartial(
    '_form', 
    array(
		'model' => $model,
	)
); ?>
