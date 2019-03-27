<div class="row">
    <a href="/upload/Profile/full/<?=$data->image?>">
        <?=$data->getPreview('sm', true)?>
    </a>
    <div class="offset3">
        <p class="pull-right">
            <a class="btn success" data-type="restore" href="<?=$this->createUrl('Profile/restore', array('id' => $data->id))?>"><i class="icon-share-alt"></i> Вернуть</a>
            <a  class="btn danger" data-type="delete"  href="<?=$this->createUrl('Profile/delete', array('id'  => $data->id,'ajax' => true))?>" data-name="<?=CHtml::encode($data->name)?>" data-id="<?=$data->id?>"><i class="icon-trash"></i> Уд.</a>
        </p>        
        <span class="label"><?=date('d.m.Y H:i', $data->created_at)?></span><br>
        <strong><?=$data->name?> <?=$data->fam?></strong><br>
	</div>
</div>