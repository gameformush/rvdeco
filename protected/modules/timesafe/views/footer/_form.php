<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'footer-form',             
    'type'=>'horizontal',
    'enableAjaxValidation' => true,    
    	'focus' => array($model, 'url'),
    
    'htmlOptions' => array(
        'class' => 'form form-horizontal',
        'enctype'=>'multipart/form-data'
    ),
));
echo CHtml::hiddenField('Footer_page',$_GET['Footer_page']);
?>
    <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>        
    	<?=CHtml::link('назад', array('list','Footer_page'=>$_GET['Footer_page'])); ?>    </div>
        <div class="control-group">
            <label class="control-label" for="url">Выберите ссылку</label>
            <div class="controls">
                <select name="url" id="url" onchange="$('#Footer_url').val(this.value);">
                    <option value="/">Главная страница</option>
                    <option value="/catalog/index.html">Каталог</option>
                    <option value="/faq/index.html">Вопрос-ответ</option>
                    <option value="/club/index.html">Клуб AlinEX Profi</option>
                    <option value="/photo/index.html">Фотогалерея</option>
                    <?php $pages = Photo::model()->findAll(); ?>
                    <?php if ($pages != NULL): ?>
                    <?php foreach ($pages as $page): ?>
                    <option value="/photo/show/id/<?php echo $page->id; ?>.html"><?php echo $page->title; ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <option value="/video/index.html">Видео</option>
                    <option value="/stock/index.html">Акции</option>
                    <option value="/calculator/index.html">Калькулятор</option>
                    <option value="/glossary/index.html">Глоссарий</option>
                    <option value="/news/index.html">Новости</option>
                    <option value="/news/index/innovation/1.html">Инновации</option>
                    <option value="/site/map.html">Карта сайта</option>
                    <option value="/site/contact.html">Обратная связь</option>
                    <option value="/site/feedback.html">Дилерам</option>
                    <?php $pages = Pages::model()->findAll(); ?>
                    <?php if ($pages != NULL): ?>
                    <?php foreach ($pages as $page): ?>
                    <option value="/page/show/name/<?php echo $page->name; ?>.html"><?php echo $page->title; ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
        </div>
    	<?php echo $form->textFieldRow($model, 'url', array('size' => 60, 'maxlength' => 150, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title', array('size' => 60, 'maxlength' => 150, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'title_kaz', array('size' => 60, 'maxlength' => 150, 'class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'weight',array('class'=>'span12')); ?>
		<?php echo $form->checkBoxRow($model, 'status');; ?>
	    
        <div class="form-actions">
        <button class="btn btn-success" type="submit">
            <?=$model->isNewRecord ? 'Добавить' : 'Сохранить'; ?>
        </button>
        <span class="text_button_padding">или</span>
        <?=CHtml::link('назад', array('list','Footer_page'=>$_GET['Footer_page'])); ?>
	</div>
<? $this->endWidget(); ?>
