<div class="content__block content__block-size-3 content__block_faq">
	<div style = "width:100%; display:block;">
		<img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:5px;">Acceuil</a> / Les produits
	</div>
	<div class="widget widget-faq">
		<h2>Les produits</h2>
		<? foreach ($model as $value) { ?>
			<? $img = json_decode($value->image_image, true); ?>
			<div class="col-md-3 col-sm-4 col-xs-6">
				<a href = "/products/show/id/<?=$value->id?>">
					<div class="widget-gallery__item" style="position: relative;">
						<img class="img-responsive" src="https://admin.devis-travaux-online.fr/upload/Products/tm/<?=$img[0]?>" alt="Nos travaux">
						<div style="position: absolute; bottom: 30px; background: rgba(255, 255, 255, 0.67); width: 100%; padding: 10px;"><?=$value->title_text?></div>
					</div>
				</a>
			</div>
		<? } ?>
	</div>
</div>