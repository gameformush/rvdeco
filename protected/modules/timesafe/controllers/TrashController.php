<?php

class TrashController extends RController {
    public function actionIndex($model) {
        $ar              = CActiveRecord::model($model);
        $ar->findRemoved = true;
        $dataProvider    = new CActiveDataProvider($ar,
            array(
                 'criteria'  => array(
                     'condition'=> 'is_removed=1',
                 ),
                 'pagination'=> array('pageSize' => 20)
            ));
        Yii::app()->clientScript->registerScript(
            'timesafe-trash', "
$('.timesafe-trash .row a').live('click',function(e){
	$('#modal-restore').bootModal('open');
	var t = $(this);
	var type = t.attr('data-type');
	if(type==='restore') {
		$('#modal-restore .danger').hide();
		$('#modal-restore .success').show();
	}else{
		$('#modal-restore .success').hide();
		$('#modal-restore .danger').show();
	}
    $('#modal-restore').data('id',t.attr('data-id'));
    $('#modal-restore strong').html('\"'+t.attr('data-title')+'\"');		
	e.preventDefault();
});");
        $this->render('index', compact('dataProvider', 'model'));
    }

    public function actionRecycle($model) {
        $model = CActiveRecord::model($model);
        if ($model->hasAttribute('is_removed'))
            $this->renderPartial('timesafe.components.views._wTrash', compact('model'));
    }
}

?>