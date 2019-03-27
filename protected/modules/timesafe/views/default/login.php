
<blockquote style="width:350px;">
    <p>Представьтесь, пожалуйста!</p>

</blockquote>

<?php $form = $this->beginWidget('BootActiveForm', array(
    'id' => 'login-form',
    'stacked' => false, // should this be a stacked form?
    'errorMessageType' => 'block', // how to display errors, inline or block?
    'enableAjaxValidation' => true,
)); ?>

<?php echo $form->textFieldRow($model, 'username', array('class' => 'span4')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span4')); ?>
<?php echo $form->checkBoxRow($model, 'rememberMe'); ?>


<? if (extension_loaded('gd') && Yii::app()->user->isGuest): ?>
    <? echo $form->textFieldRow($model, 'verifyCode', array('class' => 'span2'))?>
    <div class="clearfix">
        <div class="input">
            <span class="span3">
                <?$this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true))?>
            </span>
        </div>
        
    </div>
<? endif ?>
    <div class="clearfix">
        <label>&nbsp;</label>
        <div class="input">
            <?php echo CHtml::submitButton('Войти', array('class' => 'btn primary')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
