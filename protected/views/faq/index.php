<!-- 	<div style = "width:100%; display:block;" >
		<img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:7px;">Acceuil</a> / Foire Aux Questions
	</div> -->
	<section id="questions">
	  <nav class="top clearfix">
	    <div class="front-right">
	      <a href="">вход | регистрация</a>
	    </div>
	  </nav>
	   <div class="section-title">
	    <div class="bg"><p>FAQ</p></div>
	    <p class="actual"><span class="underline">воп</span>рос ответ</p>
	  </div>
	<div class="questions-list">
	 	<? $index = 0;?>
	    <? foreach ($model as $value) { ?>
		 <? if($index % 2 == 0) {?> <div class="row"><?}?>
		    <div class="question">
		       <h3><?=$value->author_text?></h3>
		      <div class="marker">
		        <span class="icon question-indicator"></span>
		        <input type="checkbox" checked='checked' id='question-ctrl<?=$value->id?>'>
		        <label class="question-label" for="question-ctrl<?=$value->id?>"><span class="icon question-indicator"></span><p><?=$value->vopros_bigtext?></p></label>
		      </div>
		      <div class="content">
		        <p><?=$value->otvet_bigtext?> </p>
		      </div>
		    </div>
		 <? if($index % 2 == 1) {?> </div><?}?>
		<? $index++;?>
		<?}?>
	</section>


<section id="your-review" class="your-faq">
   <div class="section-title">
    <div class="bg"><p>вопросы?</p></div>
    <p class="actual"><span class="underline">ост</span>ались вопросы?</p>
  </div>
  <div class="wrapper">
    <div class="form labeled-form search-form">
        <div class="widget widget-form">
	    <div class="widget-form__body ">
				<?
					$form=$this->beginWidget('BootActiveForm', array(
						'id'=> 'faq-form',
						'enableAjaxValidation' => true,
						'enableClientValidation' => true,
						'action' => '/faq/create/',
						'clientOptions'=>array(
							'validateOnSubmit'=>false,
							'validateOnChange'=>false,
						),
						'htmlOptions' => array(
							'enctype'=>'multipart/form-data'
						),
					)); 
					$mod = new Faq();
				?>
	            
					<div class="form-group has-feedback">
						<label class="control-label" for="name">Nom</label>
						<? echo $form->textField($mod, "author_text", array('class'=>'form-control')); ?>
						<? echo $form->error($mod, "author_text", array('class'=>'text-small text-muted')); ?>
					</div>
					<div class="form-group has-feedback">
						<label class="control-label" for="name">Votre question</label>
						<style>
							textarea {
								resize: none;
								width: 90%;
							}
						</style>
						<? echo $form->textArea($mod, "vopros_bigtext", array('class'=>'form-control')); ?>
						<? echo $form->error($mod, "vopros_bigtext", array('class'=>'text-small text-muted')); ?>
					</div>
					<input type="submit" class="send-faq btn btn-default" value="send"></input>
				<?php $this->endWidget(); ?>
		    </div>
		</div>
	</div>
        <div class="questions">
          <p>helpful <br> <b>tips</b></p>
          <img src="/images/questions.png" alt="">
        </div>
      </div>

</section>


<script>
	$("body").on("click", ".send-faq", function () {
		var name_model = "faq";
		var form = $('form')[0]; 
		var formData = new FormData(form);
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "/faq/create/",
			data: formData,
			processData: false,
			contentType: false,
			success: function(data) {
				console.log(data);
				if (data.status == "ok") {
					$(".widget-form__body").html("Merci, votre question a bien été envoyé. On vous revient au plus vite.");
				} else {
					$.each(data, function(key, val) {
						if (key == "Faq_author_text") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Vous devez remplir ce champs");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						} else if (key == "Faq_vopros_bigtext") {
							$("#"+ name_model +"-form #"+key+"_em_").text("Question non renseignée");                                                    
							$("#"+ name_model +"-form #"+key+"_em_").show();
						}
					});
				}
			},
		});
		return false;
	});

	$('body').on('click', '.faq-click', function() {
		if ($(this).hasClass( "fact" )) {
			$(this).removeClass("fact");
			$("#id_" + $(this).attr("id")).hide();
			$(this).find("span").removeClass("glyphicon-minus");
		} else {
			$(this).addClass("fact");
			$("#id_" + $(this).attr("id")).show();
			$(this).find("span").addClass("glyphicon-minus");
		}
	});

</script>
<script>
  $(function() {
    $('.marker input').each(function(index, element) {
      let cont = $(element).parent().parent().find('.content');
      if( !$(element).is(':checked') ) {
       cont.show()
      } else {
       cont.hide()
      }
    })
    $(".marker input").click( function(){
      let cont = $(this).parent().parent().find('.content');
       if( !$(this).is(':checked') ) {
        cont.show()
       } else {
        cont.hide()
       }
    });
  })
</script>