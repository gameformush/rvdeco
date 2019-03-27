<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'ctype-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'weight'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Ctype_page',$_GET['Ctype_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Ctype_page'=>$_GET['Ctype_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'weight',array('class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Ctype_page'=>$_GET['Ctype_page'])); ?>
	</div>
<? $this->endWidget(); ?>
