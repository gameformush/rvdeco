
<section id="cont-form">
  <nav class="top clearfix">
    <div class="front-right">
      <a href="">вход | регистрация</a>
    </div>
  </nav>
   <div class="section-title">
    <div class="bg"><p>контактная</p><p class="second">форма</p></div>
    <p class="actual"><span class="underline">кон</span>такты</p>
  </div>
  <div class="wrapper">
    <div class="search-info">
      <img class="search-icon" src="/images/search.png" alt="search">
      <p>RV DECO</p>
      <p>24, RUE MARCEAU</p>
      <p>92130 ISSY LES MOULINEAUX</p>
      <p><b>www.rvdeco.com</b></p>
      <p>rvdeco@yahoo.com</p>
      <p>06.50.35.47.52</p>
    </div>
    <div class="form search-form">
     	
     	<div class="widget widget-form">
     		<div class="widget-form__body">
     				<?
     					$form=$this->beginWidget('BootActiveForm', array(
     						'id'=> 'feedback-form',
     						'enableAjaxValidation' => true,
     						'enableClientValidation' => true,
     						'action' => '/feedback/create/',
     						'clientOptions'=>array(
     							'validateOnSubmit'=>false,
     							'validateOnChange'=>false,
     						),
     						'htmlOptions' => array(
     							'enctype'=>'multipart/form-data'
     						),
     					)); 
     					$mod = new Feedback();
     				?>
     				<div class="form-group has-feedback">
     					<label class="control-label" for="title">Votre nom</label>
              <style>
                textarea {
                  resize: none;
                  width: 90%;
                }
              </style>
     					<? echo $form->textField($mod, "name_text", array('class'=>'form-control')); ?>
     					<? echo $form->error($mod, "name_text", array('class'=>'text-small text-muted')); ?>
     				</div>
     				<div class="form-group has-feedback">
     					<label class="control-label" for="email">Votre e-mail</label>
     					<input class="form-control" name="Feedback[email_text]" id="Feedback_email_text" type="email" maxlength="255">
     					<? echo $form->error($mod, "email_text", array('class'=>'text-small text-muted')); ?>
     				</div>
     				<div class="form-group has-feedback">
     					<label class="control-label" for="message">Votre message</label>
              <style>
                textarea {
                  resize: none;
                  width: 90%;
                }
              </style>
     					<? echo $form->textArea($mod, "message_bigtext", array('class'=>'form-control')); ?>
     					<? echo $form->error($mod, "message_bigtext", array('class'=>'text-small text-muted')); ?>
     				</div>
     				<input type="submit" class="send-contact btn btn-default" value="Envoyer"></input>
     			<?php $this->endWidget(); ?>
     		</div>
     	</div>
    </div>
  </div>
  <div class="google-map">
   <!--  <div id="map"></div> -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.700193230553!2d2.2701113158198614!3d48.82578151095601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e67a9005120425%3A0xbdec59c7d7f49b08!2sRV+Deco!5e0!3m2!1sru!2sua!4v1551440226208" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>

  </div>
<!--       <script>
  function initMap() {
    var uluru = {lat: -25.344, lng: 131.036};

    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 4, center: uluru});
    var marker = new google.maps.Marker({position: uluru, map: map});
  }
      </script>

      <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBLTdu3q99UO7M23rnIyBI72265pQivEM&callback=initMap">
      </script> -->

</section>
