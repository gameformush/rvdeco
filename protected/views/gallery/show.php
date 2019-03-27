<style> iframe { width:100%;    height: auto; } </style>
<!-- 	<div style = "width:100%; display:block;">
		<img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:5px;">Acceuil</a> / <a href = "/gallery/">Nos réalisations</a> / <?=$model->title_text?>
	</div> -->

	<section id="gallery">
	  <nav class="top clearfix">
	    <div class="front-right">
	      <a href="">вход | регистрация</a>
	    </div>
	  </nav>
	   <div class="section-title">
	    <div class="bg"><p>фото</p><p class="second">галерея</p></div>
	    <p class="actual"><span class="underline">гал</span>ерея</p>
	  </div>

	  <nav class="gallery-menu">
	    <ul>
	    	<? foreach ($all as $value) { ?>
	    		<? $img = json_decode($value->image_image, true); ?>
	        <li><a  <? if($value->title_text == $model->title_text) { ?> class="active"<? } ?>  style="text-decoration: none;" href = "/gallery/show/id/<?=$value->id?>"><?=$value->title_text?></a></li>
	  		<? } ?>
	    </ul>
	  </nav>


	  <div class="gallery clearfix">
	    <div class="row">
	    	<? $images = json_decode($model->pimages_pimages, true); ?>
	    	<? $index = 0;?>
	    	<? foreach ($images as $value) { ?>
	    		<? $img = json_decode($value->image_image, true); ?>
	    		<? if($index % 3 == 0) {?> <div class="column"> <?}?>
		        <img src="https://admin.devis-travaux-online.fr/upload/Gallery/tm/<?=$value?>" onclick="openModal();currentSlide(<? echo $index + 1?>)" class="hover-shadow <?$index?>">
	    		<? if($index % 3 == 2) {?> </div> <?}?>
		        <? $index++; ?>
	     	<? } ?>
	     	<? if ($model->video_bigtext != null) { ?>
	     	  <div class="col-md-3 col-sm-4 col-xs-6">
	     	    <?=$model->video_bigtext?>
	     	  </div>
	     	<? } ?>
	      <div id="myModal" class="modal">
	        <span class="close cursor" onclick="closeModal()">&times;</span>
	        <div class="modal-content">
		    	<? $images = json_decode($model->pimages_pimages, true); ?>
		    	<? foreach ($images as $value) { ?>
		    		<? $img = json_decode($value->image_image, true); ?>
			        <div class="mySlides">
			          <img src="https://admin.devis-travaux-online.fr/upload/Gallery/full/<?=$value?>">
			        </div>
		     	<? } ?>

	          <!-- Next/previous controls -->
	          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	          <a class="next" onclick="plusSlides(1)">&#10095;</a>

	        </div>
	      </div>
	    </div>
	    

	      <a href="/calc/" class="calc"><span class="icon calc-icon"></span><span>Рассчитать</span></a>
	  </div>
	  

	</section>


  <script>
 
    $(function() {
      $('.column').each((index, elem) => {
        let count = $(elem).find('img').length;
        if (count != 3) {
          $(elem).find('img').css('flex-grow', 0);
        }
      })
      if ($('.column').length === 1) {
        $('.modal-content').css('top', 0);
        $('#myModal').css('min-height', "500px");
      }
    })
function openModal() {
   if (window.innerWidth < 1000 ) {return}
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  if (window.innerWidth < 1000 ) {return}
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
  </script>