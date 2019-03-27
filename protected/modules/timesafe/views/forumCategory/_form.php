<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'forum-category-form',
    'type'=>'horizontal',
    'enableAjaxValidation' => true,
    	'focus' => array($model, 'url'),

    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Navigation_page',$_GET['Navigation_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
    	<?=CHtml::link('назад', array('list','Navigation_page'=>$_GET['Navigation_page'])); ?>    </div>
        <?php echo $form->textFieldRow($model, 'url', array('size' => 60, 'maxlength' => 250, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 150, 'class'=>'span12')); ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Navigation_page'=>$_GET['Navigation_page'])); ?>
	</div>
<? $this->endWidget(); ?>

