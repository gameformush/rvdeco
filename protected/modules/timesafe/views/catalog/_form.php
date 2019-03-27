<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'catalog-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'parent_CatalogCategory_id'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Catalog_page',$_GET['Catalog_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Catalog_page'=>$_GET['Catalog_page'])); ?>    </div>
    	<?php echo $form->autoFieldRow($model, 'parent_CatalogCategory_id', array('class' => 'span6'), array('relation'=>'parentCatalogCategory','title'=>'title'));; ?>
        <?php echo $form->textFieldRow($model, 'weight', array('size' => 60, 'maxlength' => 4, 'class'=>'span12')); ?>
        <?php echo $form->textFieldRow($model, 'url', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title_kaz', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'internetshop', array('size' => 60, 'maxlength' => 255, 'class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model, 'text',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text')); ?>	
		<?php echo $form->textAreaRow($model, 'text_kaz',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'text_kaz')); ?>
		<?php echo $form->textAreaRow($model, 'description',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'description')); ?>	
		<?php echo $form->textAreaRow($model, 'description_kaz',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'description_kaz')); ?>	
		<?php echo $form->textAreaRow($model, 'instruction',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'instruction')); ?>	
		<?php echo $form->textAreaRow($model, 'instruction_kaz',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'instruction_kaz')); ?>	
		<?php echo $form->textAreaRow($model, 'technicaldata',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'technicaldata')); ?>	
		<?php echo $form->textAreaRow($model, 'technicaldata_kaz',array('class'=>'span12'));; ?><?php $this->widget('application.extensions.elrte.elRTE', array('model'=>$model,'attribute'=>'technicaldata_kaz')); ?>	
		<?php echo $form->fileFieldRow($model, 'image',array('class'=>'input-file'));; ?>	
		<?php echo $form->checkBoxRow($model, 'status');; ?>
        <?php echo $form->checkBoxRow($model, 'main');; ?>

        <fieldset title="Информация для калькулятора">
            <legend>Информация для калькулятора</legend>
‌                <div id="calculator">
                    <div class="control-group">
                        <label class="control-label" for="Catalog_room">Тип помещения</label>
                        <div class="controls">
                            <?php echo CHtml::activeDropDownList($model,'room',$model->roomArr); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Catalog_work">Вид работ</label>
                        <div class="controls">
                            <?php echo CHtml::activeDropDownList($model,'work',$model->workArr); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="Catalog_color">Цвет</label>
                        <div class="controls">
                            <?php echo CHtml::activeDropDownList($model,'color',$model->colorArr); ?>
                        </div>
                    </div>
                    <?php echo $form->textFieldRow($model, 'pack', array('style'=>'width:210px;', 'size' => 5, 'maxlength' => 255, 'class'=>'span12')); ?>
                    <?php echo $form->textFieldRow($model, 'cons', array('style'=>'width:210px;', 'size' => 5, 'maxlength' => 255, 'class'=>'span12')); ?>
                    <?php echo $form->checkBoxRow($model, 'att'); ?>
                </div>
        </fieldset>
	    
    <? $this->widget('timesafe.components.WMeta',array('model'=>$model))?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Catalog_page'=>$_GET['Catalog_page'])); ?>
	</div>
<? $this->endWidget(); ?>
