<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'photo-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'title'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Photo_page',$_GET['Photo_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Photo_page'=>$_GET['Photo_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span8')); ?>
		<?php echo $form->textFieldRow($model, 'title_kaz', array('size' => 60, 'maxlength' => 255, 'class'=>'span8')); ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span8'));; ?>
			<?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text')); ?>	
		<?php echo $form->textAreaRow($model, 'text_kaz',array('class'=>'span8'));; ?>
			<?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text_kaz')); ?>	
            <?php //echo $form->textFieldRow($model, 'views',array('class'=>'span2')); ?>
		<?php echo $form->singlefileFieldRow($model, 'image',array('class'=>'input-file'));; ?>
		<?php echo $form->fileFieldRow($model, 'imagelist',array('class'=>'input-file'));; ?>
			<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'imagelist')); ?>	<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Photo_page'=>$_GET['Photo_page'])); ?>
	</div>
<? $this->endWidget(); ?>
