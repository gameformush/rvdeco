<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'Language-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'name'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Language_page',$_GET['Language_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Language_page'=>$_GET['Language_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 150, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'param_ru', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'param_kaz', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
	    
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Language_page'=>$_GET['Language_page'])); ?>
	</div>
<? $this->endWidget(); ?>
