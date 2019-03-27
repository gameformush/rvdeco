<?php
$this->breadcrumbs=array(
	'Translate',
);?>
<h1>Переводы фраз</h1>
<?php 
$tabs = array();
foreach ($category as $key => $cat) {
		$tabs[] = array('label'=>$cat->title,'content'=>$this->renderPartial('_words',compact('cat'),true));
}
$this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'above',
    'tabs'=>$tabs,
)); 
Yii::app()->clientScript->registerScriptFile('/js/admin/editable/bootstrap-editable.min.js');
Yii::app()->clientScript->registerCssFile('/js/admin/editable/bootstrap-editable.css');
?>

<script type="text/javascript">
	
	$('.editable').editable({
     type: 'text',
     url: '<?=$this->createUrl('save')?>',  
     title: 'Введите перевод'
  });
</script>