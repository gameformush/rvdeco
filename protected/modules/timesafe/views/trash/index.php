<h2>Корзина <small> <a href="<?=$this->createUrl(strtolower($model).'/list')?>">&larr;Вернуться</a></small></h2>
<div class="timesafe-trash">
<?
$this->widget('BootMediaGrid', array(
	'id'=>'trashList',
    'dataProvider'=>$dataProvider,    
    'itemView'=>'timesafe.views.'.strtolower($model).'._itemTrash', 
    'afterAjaxUpdate'=>'js:function(){ $(\'.toggle-on-check\').toggleit(); }',
    'sortableAttributes'=>array(
        'title_ru',
        'created_at',
    ),
));
?>
</div>
 <?php $this->beginWidget('BootModal',array(
        'id'=>'modal-restore',
        'options'=>array(
            'title'=>'Удаление',
            'backdropClose'=>true, 
            'escapeClose'=>true,
            'open'=>false,
            'closeTime'=>350,
            'openTime'=>500,
            'buttons'=>array(
                array(
                    'label'=>'Восстановить',
                    'class'=>'btn success',
                    'click'=>"js:function() {                       
                        $.get('".$this->createUrl(strtolower($model).'/restore')."',{id:$('#modal-restore').data('id')}, function(){
                            $('#modal-restore').bootModal('close');	
               				$.fn.yiiListView.update('trashList');                         
                        });
                    }",
                ),
                array(
                    'label'=>'Удалить навсегда',
                    'class'=>'btn danger',
                    'click'=>"js:function() {
                        $.post('".$this->createUrl(strtolower($model).'/delete')."?ajax=1',{id:$('#modal-restore').data('id')}, function(){
                            	$.fn.yiiListView.update('trashList');
                            	$('#modal-restore').bootModal('close');	                         
                        	});
                    }",
                ),
                array(
                    'label'=>'Отмена',
                    'class'=>'btn',
                    'click'=>"js:function() {
                        $('#modal-restore').bootModal('close');                        
                        return false;
                    }",
                ),
            ),      
        ),
    )); ?> 
    <p>Вы действительно хотите удалить запись?</p>
    <strong></strong> 
    <?php $this->endWidget(); ?> 
