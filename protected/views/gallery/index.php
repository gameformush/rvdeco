<!-- <div class="content__block content__block-size-3 content__block_faq"> -->
<!-- 	<div style = "width:100%; display:block;">
		<img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:5px;">Acceuil</a> / Nos réalisations
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
	    	<? foreach ($model as $value) { ?>
	    		<? $img = json_decode($value->image_image, true); ?>
	        <li><a style="text-decoration: none;" href = "/gallery/show/id/<?=$value->id?>"><?=$value->title_text?></a></li>
	  		<? } ?>
	    </ul>
	  </nav>
	</section>


<!-- </div> -->