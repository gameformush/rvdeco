<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'subscriber-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'kod'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Subscriber_page',$_GET['Subscriber_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Subscriber_page'=>$_GET['Subscriber_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'kod', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->dateFieldRow($model, 'created_at',array('class'=>'span2'));; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Subscriber_page'=>$_GET['Subscriber_page'])); ?>
	</div>
<? $this->endWidget(); ?>
