<div class="row">
    <a href="/upload/Navigation/full/<?=$data->image?>">
        <?=$data->getPreview('sm', true)?>
    </a>
    <div class="offset3">
        <p class="pull-right">
            <a class="btn success" data-type="restore" href="<?=$this->createUrl('navigation/restore', array('id' => $data->id))?>"><i class="icon-share-alt"></i> Вернуть</a>
            <a  class="btn danger" data-type="delete"  href="<?=$this->createUrl('navigation/delete', array('id'  => $data->id,'ajax' => true))?>" data-title="<?=CHtml::encode($data->title)?>" data-id="<?=$data->id?>"><i class="icon-trash"></i> Уд.</a>
        </p>        
                <strong><?=$data->title?></strong><br>
            </div>
</div>