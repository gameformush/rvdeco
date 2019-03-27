<div class="content__block content__block-size-2 content__block_form" style = "width:100%; max-width:100%;">
	<div class="widget widget-faq">
		<h2><?=$model->title_text?></h2>
		<? $img = json_decode($model->image_image, true); ?>
		<div style = "display:inline-block; position:relative; border:1px solid black;">
			<a style = "padding:0;" class="widget-gallery__item" data-fancybox="gallery_63" href="https://admin.devis-travaux-online.fr/upload/Products/full/<?=$img[0]?>"><img src = "https://admin.devis-travaux-online.fr/upload/Products/tm/<?=$img[0]?>" /></a>
			<div style="position: absolute; bottom: 30px; background: rgba(255, 255, 255, 0.67); width: 100%; padding: 10px;">Le prix <?=$model->cena_text?> €</div>
		</div>
		<div style = "display:inline-block; position:absolute;">
			<? $images = json_decode($model->images_pimages, true); ?>
			<? foreach ($images as $value) { ?>
				<div style = "border:1px solid black;">
					<a style = "padding:0;" class="widget-gallery__item" data-fancybox="gallery_63" href="https://admin.devis-travaux-online.fr/upload/Products/full/<?=$value?>"><img width = "50" class = "resposive" src = "https://admin.devis-travaux-online.fr/upload/Products/tm/<?=$value?>" /></a>
				</div>
			<? } ?>
		</div>
	</div>
</div>
<div class="content__block content__block-size-1 content__block_form" style = "width:100%; max-width:100%;">
<div class="widget widget-form">
	<div class="widget-form__heading">
		<div class="widget-form__heading-text">
			<h2>Description</h2>
		</div>
	</div>
	<div class="widget-form__body">
		<?=$model->description_bigtext?>
	</div>
	<div class="widget-form__heading">
		<div class="widget-form__heading-text">
			<h2>Paramètres</h2>
		</div>
	</div>
	<div class="widget-form__body">
		<?=$model->params_bigtexteditor?>
	</div>
	<div class="pclose btn btn-success" style="padding: 10px 20px; text-transform: uppercase;">Valide</div>
</div>

