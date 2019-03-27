<!-- 
	<div style = "width:100%; display:block;">
		<img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:5px;">Acceuil</a> / Avis
	</div> -->
	<section id="reviews" class="center-title" >
	  <nav class="top clearfix">
	    <div class="front-right">
	      <a href="">вход | регистрация</a>
	    </div>
	  </nav>
	   <div class="section-title">
	    <div class="bg"><p>Отзывы</p></div>
	    <p class="actual"><span class="underline">отзы</span>вы</p>
	  </div>

	<div class="reviews-list">
		<? $index = 0;?>
		<? foreach ($model as $value) { ?>
		<? if ($index % 2 == 0) {?> <div class="row"> <?}?>
		<div class="review">
		  <div class="avatar">
			<? if ($index % 7 == 0) {?> <img src="/images/woman-squar.png" alt=""> <?}?>
			<? if ($index % 7 == 1) {?> <img src="/images/woman-circle.png" alt=""> <?}?>
			<? if ($index % 7 == 2) {?> <img src="/images/men-young.png" alt=""><?}?>
			<? if ($index % 7 == 3) {?> <img src="/images/men-old.png" alt=""><?}?>
			<? if ($index % 7 == 4) {?> <img src="/images/woman-squar.png" alt=""> <?}?>
			<? if ($index % 7 == 5) {?> <img src="/images/woman-circle.png" alt=""> <?}?>
			<? if ($index % 7 == 6) {?> <img src="/images/woman-circle.png" alt=""> <?}?>
		  </div>
		  <div class="content">
		    <h3><?=$value->name_text?></h3>
		    <p><?=$value->review_bigtext?></p>
		    <div class="stars">
		      <span class="icon icon-star"></span>
		    </div>
		  </div>
		</div>
		<? if ($index % 2 == 1) {?> </div> <?}?>
		<? $index++;?>
		<? } ?>
	</div>
</section>

<section id="your-review">
   <div class="section-title">
    <div class="bg"><p>оставьте</p><p class="second">свой отзыв</p></div>
    <p class="actual"><span class="underline">Ваш</span> отзыв</p>
  </div>
  <div class="form labeled-form search-form" style="padding-bottom: 50px">
		<div class="widget widget-form">
			<div class="widget-form__body">
				<?
					$form=$this->beginWidget('BootActiveForm', array(
						'id'=> 'reviews-form',
						'enableAjaxValidation' => true,
						'enableClientValidation' => true,
						'action' => '/reviews/create/',
						'clientOptions'=>array(
							'validateOnSubmit'=>false,
							'validateOnChange'=>false,
						),
						'htmlOptions' => array(
							'enctype'=>'multipart/form-data'
						),
					)); 
					$mod = new Reviews();
				?>
					
					<div class="form-group has-feedback">
						<label class="control-label" for="name">Nom</label>
						<? echo $form->textField($mod, "name_text", array('class'=>'form-control')); ?>
						<? echo $form->error($mod, "name_text", array('class'=>'text-small text-muted')); ?>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label" for="message">Laissez votre avis ici</label>
						<style>
							textarea {
								resize: none;
								width: 90%;
							}
						</style>
						<? echo $form->textArea($mod, "review_bigtext", array('class'=>'form-control')); ?>
						<? echo $form->error($mod, "review_bigtext", array('class'=>'text-small text-muted')); ?>
					</div>
					<input type="submit" class="avis btn btn-default" value="Valider votre avis"></input>
				<?php $this->endWidget(); ?>
			</div>
	    </div>
	</div>
</section>

<script>
	$("body").on("click", ".avis", function () {
		var name_model = "reviews";
		var form = $('form')[0]; 
		var formData = new FormData(form);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/reviews/create/",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				if (data.status == "ok") {
					$(".widget-form__body").html("Merci, votre avis nous est bien parvenu!");
				} else {
					$.each(data, function(key, val) {
						if (key == "Reviews_name_text") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Ce champs est obligatoire");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						} else if (key == "Reviews_review_bigtext") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Oups, votre avis n'apparait pas, vérifiez si le champs est rempli.");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						}
					});
				}
			},
		});
		return false;
	});
</script>