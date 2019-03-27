

<section class="news fix">
    <div class="news-list">
        <div class="list-item" style = "padding:20px; text-align:center;">
            <h1 style = "color:#fff; text-transform:uppercase;">Вход в административную часть</h1>
            <?php $form = $this->beginWidget('CActiveForm', array('id' => 'login-form', 'method' => 'post', 'enableAjaxValidation' => 'false')); ?>
            <div class="pb-20">
                <?php echo $form->textField($model, 'username', array('class'=>'field', 'style'=>"width:240px; padding:10px 6px; border: 1px solid #f8b803;")); ?>
                <div class="pt-5"><span class="t-orange" style = "color:red; padding:20px;"><?php echo $form->error($model,'username');?></span></div>
            </div>
            <div class="pb-20"">
                <?php echo $form->passwordField($model, 'password', array('class'=>'field','style'=>"width:240px; padding:10px 6px; border: 1px solid #f8b803;"))?>
                <div class="pt-5"><span class="t-orange" style = "color:red; padding:20px;"><?php echo $form->error($model,'password');?></span></div>
            </div>
            <div class="pb-20" style = "padding-top:10px; text-align:center;">
                <button style = "position:relative; background:#ab0e0e; border:none; color:#fff; text-transform: uppercase; width:240px; padding:10px 0;" type="submit" class="read-btn">Войти</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>

</section>


