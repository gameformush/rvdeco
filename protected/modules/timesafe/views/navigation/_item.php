<?php if ($data->parent_id == 0): ?>
<?php $subdatas = Navigation::model()->findAll("parent_id='".$data->id."'"); ?>
<div class="row">
    <div>
        <p class="pull-right">
            <a class="btn" href="<?php echo $this->createUrl('update', array('id' => $data->id)); ?>"><i class="icon-pencil"></i> Ред.</a>
            <a class="btn btn-danger delete-link-list" href="#modal-delete" data-toggle="modal" data-title="<?php echo CHtml::encode($data->title); ?>" data-id="<?php echo $data->id; ?>"><i class="icon-trash"></i> Уд.</a>
        </p>
        <p class="pull-right">
            <?php echo CHtml::checkbox('NavigationCheck[status][' . $data->id . ']', $data->status, array('class' => 'toggle-on-check')); ?>
            <span class="label label-info"><i class="icon-eye-open"></i> Видимость</span>
        </p>
        <strong><?php echo $data->title?></strong><br>Порядковый номер: <?=$data->weight?>
        <?php if ($subdatas != NULL): ?>
        <br><br><br>
        <?php foreach ($subdatas as $subdata): ?>
        <div class="row">
            <div>
                <p class="pull-right">
                    <a class="btn" href="<?php echo $this->createUrl('update', array('id' => $subdata->id)); ?>"><i class="icon-pencil"></i> Ред.</a>
                    <a class="btn btn-danger delete-link-list" href="#modal-delete" data-toggle="modal" data-title="<?php echo CHtml::encode($subdata->title); ?>" data-id="<?php echo $subdata->id; ?>"><i class="icon-trash"></i> Уд.</a>
                </p>
                <p class="pull-right">
                    <?php echo CHtml::checkbox('NavigationCheck[status][' . $subdata->id . ']', $subdata->status, array('class' => 'toggle-on-check')); ?>
                    <span class="label label-info"><i class="icon-eye-open"></i> Видимость</span>
                </p>
                <strong><?php echo $subdata->title?></strong><br>Порядковый номер: <?=$subdata->weight?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>