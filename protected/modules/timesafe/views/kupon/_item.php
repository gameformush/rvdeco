<div class="row">
        <div>
			<p class="pull-right">
				<a class="btn btn-danger delete-link-list" href="#modal-delete" data-toggle="modal" data-title="<?=CHtml::encode($data->kod)?>" data-id="<?=$data->id?>"><i class="icon-trash"></i> Удалить</a>
			</p>
			
			ID: <strong><?=$data->id?></strong><br>
			Дата создания: <strong><?=date('d.m.Y H:i', $data->created_at)?></strong><br>
			Код купона: <strong><?=$data->kod?></strong><br>
			Город: <strong><?=$data->city?></strong><br>
                        IP-адрес: <strong><?=$data->ip?></strong><br>
		</div>
</div>