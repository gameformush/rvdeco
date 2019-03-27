<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'stock-form',
    'type'=>'horizontal',
    'enableAjaxValidation' => true,
    	'focus' => array($model, 'title'),

    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Stock_page',$_GET['Stock_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <style type="text/css">
            .span3{
                width: 670px;
            }
        </style>
        <span class="text_button_padding">или</span>
    	<?=CHtml::link('назад', array('list','Stock_page'=>$_GET['Stock_page'])); ?>    </div>
    	<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title_kaz', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'vremiaakcyi', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->singleFileFieldRow($model, 'image',array('class'=>'input-file')); ?>
        <?php echo $form->singleFileFieldRow($model, 'image_1',array('class'=>'input-file')); ?>
        <?php $image_1 = json_decode($model->image_1,true);?>
        <?php if (is_file("upload/Club/full/".$image_1[0])): ?>
        <div class="control-group">
        <div class="controls">
            <div class="clearfix">
                <div class="span3">
                    <span class="label label-inverse"><i class="icon-caret-right"></i>&nbsp;&nbsp;&nbsp;</span>
                    <a href="/upload/Club/full/<?php echo $image_1[0]; ?>" target="_blank">
                        <img width="110" height="110" alt="" src="/upload/Club/sm/<?php echo $image_1[0]; ?>">
                    </a>&nbsp;
                </div>
                <div class="offset3">
                    <button class="btn btn-danger" type="button" name="yt1" onclick='js:if ($("#image_1-delete-0").val()=="") { $(this).html("<i class=icon-ok-circle></i> Не удалять").addClass("btn-success"); $("#image_1-delete-0").val(1); } else { $(this).html("<i class=icon-remove-circle></i> Удалить").removeClass("btn-success"); $("#image_1-delete-0").val(""); }'><i class="icon-remove-circle"></i>Удалить</button>
                    <br>
                    <input id="image_1-src-0" type="hidden" name="image_1-src-0" value="<?php echo $image_1[0]; ?>">
                    <input id="image_1-delete-0" type="hidden" name="image_1-delete-0" value="">
                </div>
            </div>
        </div>
        </div>
        <?php endif; ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text')); ?>	
		<?php echo $form->textAreaRow($model, 'text_kaz',array('class'=>'span12'));; ?>
			<?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text_kaz')); ?>	
            <?php echo $form->dateFieldRow($model, 'created_at',array('class'=>'span2'));; ?>
            <?php echo $form->dateFieldRow($model, 'end_at',array('class'=>'span2'));; ?>
		<?php echo $form->checkBoxRow($model, 'active');; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    <?php echo $form->checkBoxRow($model, 'subscribe');; ?>
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Stock_page'=>$_GET['Stock_page'])); ?>
	</div>
<? $this->endWidget(); ?>
