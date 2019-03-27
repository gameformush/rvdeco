<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'ftype-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'weight'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Ftype_page',$_GET['Ftype_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Ftype_page'=>$_GET['Ftype_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'weight',array('class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Ftype_page'=>$_GET['Ftype_page'])); ?>
	</div>
<? $this->endWidget(); ?>
