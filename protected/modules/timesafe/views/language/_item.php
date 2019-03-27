<div class="row">
        <div>
			<p class="pull-right">
				<a class="btn" href="<?=$this->createUrl('update', array('id' => $data->id))?>"><i class="icon-pencil"></i> Ред.</a>
				<a class="btn btn-danger delete-link-list" href="#modal-delete" data-toggle="modal" data-title="<?=CHtml::encode($data->name)?>" data-id="<?=$data->id?>"><i class="icon-trash"></i> Уд.</a>
			</p>
			<p class="pull-right">
				<?=CHtml::checkbox('LanguageCheck[status][' . $data->id . ']', $data->status, array('class' => 'toggle-on-check'))?>
				<span class="label label-info"><i class="icon-eye-open"></i> Видимость</span>
			</p>
			
			ID: <strong><?=$data->id?></strong><br>
			Имя переменной: <strong><?=$data->name?></strong><br>
			Русский перевод: <strong><?=$data->param_ru?></strong><br>
			Казахский перевод: <strong><?=$data->param_kaz?></strong><br>
		</div>
</div>