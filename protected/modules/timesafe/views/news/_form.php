<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'news-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'title'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('News_page',$_GET['News_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','News_page'=>$_GET['News_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'content',array('class'=>'span12'));; ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span12'));; ?>
		<?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text')); ?>	
		<?php echo $form->dateFieldRow($model, 'created_at',array('class'=>'span2'));; ?>
		<?php echo $form->singlefileFieldRow($model, 'image',array('class'=>'input-file'));; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
		
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','News_page'=>$_GET['News_page'])); ?>
	</div>
<? $this->endWidget(); ?>

