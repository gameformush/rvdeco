<strong>Удалённые записи (<?=$model->trashCount();?>)</strong><br> 
<?    
    $records = $model->getRemoved()->findAll(array('limit'=>5));    
	foreach ($records as $record){
			
		echo CHtml::tag('span',array('class'=>'span3'),$record->title).'<br>'.
		CHtml::link('Восстановить', array('restore','id'=>$record->id),array('class'=>'btn small success','data-title'=>CHtml::encode($record->title),'data-id'=>$record->id,'data-type'=>'restore')).'&nbsp;'.
		CHtml::link('Удалить', array('delete','id'=>$record->id,'ajax'=>true),array('class'=>'btn small danger','data-title'=>CHtml::encode($record->title),'data-id'=>$record->id,'data-type'=>'delete')).'<hr>';
	}
?>