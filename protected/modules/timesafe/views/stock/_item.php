<div class="row">
        <div class="span2">
    <? $img = json_decode($data->image,true);?>
    <? if($img):?>
    <img src="/upload/Stock/sm/<?= $img[0];?>">
    <? endif;?>
    </div>
    <div class="offset2">
        <p class="pull-right">
            <a class="btn" href="<?=$this->createUrl('update', array('id' => $data->id))?>"><i class="icon-pencil"></i> Ред.</a>
            <a class="btn btn-danger delete-link-list" href="#modal-delete" data-toggle="modal" data-title="<?=CHtml::encode($data->title)?>" data-id="<?=$data->id?>"><i class="icon-trash"></i> Уд.</a>
        </p>
        <p class="pull-right">
            <?=CHtml::checkbox('StockCheck[status][' . $data->id . ']', $data->status, array('class' => 'toggle-on-check'))?>
            <span class="label label-info"><i class="icon-eye-open"></i> Видимость</span>
        </p>
        <p class="pull-right">
            <?=CHtml::checkbox('StockCheck[subscribe][' . $data->id . ']', $data->subscribe, array('class' => 'toggle-on-check'))?>
            <span class="label label-info"><i class="icon-eye-open"></i> Рассылка</span>
        </p>
        
        <span class="label">c <?=date('d.m.Y', $data->created_at)?> по <?=date('d.m.Y', $data->end_at)?></span><br>
        <strong><?=$data->title?></strong><br>
            </div>
</div>