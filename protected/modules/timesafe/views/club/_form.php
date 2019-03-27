<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'club-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'parent_Ctype_id'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Club_page',$_GET['Club_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Club_page'=>$_GET['Club_page'])); ?>    </div>
    	<?php echo $form->autoFieldRow($model, 'parent_Ctype_id', array('class' => 'span6'), array('relation'=>'parentCtype','title'=>'title'));; ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'phones',array('class'=>'span12'));; ?>
 	    <?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span12'));; ?>
		<?php $this->widget('application.extensions.redactor.VRedactor', array('model'=>$model,'attribute'=>'text')); ?>	
        <?php echo $form->singleFileFieldRow($model, 'logo',array('class'=>'input-file'));; ?>
        <?php $logo = json_decode($model->logo,true);?>
        <?php if (is_file("upload/Club/full/".$logo[0])): ?>
        <div class="control-group">
        <div class="controls">
            <div class="clearfix">
                <div class="span3">
                    <span class="label label-inverse"><i class="icon-caret-right"></i>&nbsp;&nbsp;&nbsp;</span>
                    <a href="/upload/Club/full/<?php echo $logo[0]; ?>" target="_blank">
                        <img width="110" height="110" alt="" src="/upload/Club/sm/<?php echo $logo[0]; ?>">
                    </a>&nbsp;
                </div>
                <div class="offset3">
                    <button class="btn btn-danger" type="button" name="yt1" onclick='js:if ($("#logo-delete-0").val()=="") { $(this).html("<i class=icon-ok-circle></i> Не удалять").addClass("btn-success"); $("#logo-delete-0").val(1); } else { $(this).html("<i class=icon-remove-circle></i> Удалить").removeClass("btn-success"); $("#logo-delete-0").val(""); }'><i class="icon-remove-circle"></i>Удалить</button>
                    <br>
                    <input id="logo-src-0" type="hidden" name="logo-src-0" value="<?php echo $logo[0]; ?>">
                    <input id="logo-delete-0" type="hidden" name="logo-delete-0" value="">
                </div>
            </div>
        </div>
        </div>
        <?php endif; ?>
        <?php echo $form->fileFieldRow($model, 'image',array('class'=>'input-file'));; ?>
        <?php echo $form->dateFieldRow($model, 'created_at',array('class'=>'span2'));; ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Club_page'=>$_GET['Club_page'])); ?>
	</div>
<? $this->endWidget(); ?>
