<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'faq-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'parent_Ftype_id'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Faq_page',$_GET['Faq_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Faq_page'=>$_GET['Faq_page'])); ?>    </div>
    	<?php echo $form->autoFieldRow($model, 'parent_Ftype_id', array('class' => 'span6'), array('relation'=>'parentFtype','title'=>'title'));; ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'name', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'question',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'question')); ?>	<?php echo $form->textAreaRow($model, 'answer',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'answer')); ?>	<?php echo $form->dateFieldRow($model, 'created_at',array('class'=>'span2'));; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Faq_page'=>$_GET['Faq_page'])); ?>
	</div>
<? $this->endWidget(); ?>
