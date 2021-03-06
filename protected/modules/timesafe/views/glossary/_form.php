<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'glossary-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'title'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Glossary_page',$_GET['Glossary_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Glossary_page'=>$_GET['Glossary_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title_kaz', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'text')); ?>
		<?php echo $form->textAreaRow($model, 'text_kaz',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'text_kaz')); ?>
		<?php echo $form->checkBoxRow($model, 'status'); ?>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Glossary_page'=>$_GET['Glossary_page'])); ?>
	</div>
<? $this->endWidget(); ?>
