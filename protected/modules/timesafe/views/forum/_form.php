<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'Forum-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'title'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Forum_page',$_GET['Forum_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Forum_page'=>$_GET['Forum_page'])); ?>    
	</div>
	<div class="control-group">
		<label class="control-label" for="url">Автор</label>
		<div class="controls">
			<select name="author" id="url" onchange="$('#Forum_author').val(this.value);">
				<? 
					$criteria = new CDbCriteria();
					$criteria->order = "name ASC";
					$authors = Profile::model()->findAll($criteria); 
				?>
				<? foreach ($authors as $value): ?>
					<option <?php echo ($model->author==$value->id) ? 'selected="selected"' : ''; ?> value="<?=$value->id?>"><?=$value->name?> <?=$value->fam?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>
	<div style = "display:none;"><?php echo $form->textFieldRow($model, 'author', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?></div>
	<?php echo $form->autoFieldRow($model, 'parent_ForumCategory_id', array('class' => 'span6'), array('relation'=>'parentForumCategory','title'=>'title'));; ?>
	<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
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
        <?=CHtml::link('назад', array('list','Forum_page'=>$_GET['Forum_page'])); ?>
	</div>
<? $this->endWidget(); ?>

