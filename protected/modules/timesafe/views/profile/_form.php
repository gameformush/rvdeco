<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'Profile-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'name'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Profile_page',$_GET['Profile_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Profile_page'=>$_GET['Profile_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'fam', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'about',array('class'=>'span12'));; ?>
		<?php echo $form->dateFieldRow($model, 'date_reg',array('class'=>'span2'));; ?>
		<?php echo $form->singlefileFieldRow($model, 'image',array('class'=>'input-file'));; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
		
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Profile_page'=>$_GET['Profile_page'])); ?>
	</div>
<? $this->endWidget(); ?>



