<?
$dataProvider = $model->search();
$this->widget('BootMediaGrid', array(
    'dataProvider'=>$dataProvider,    
    'itemView'=>'_item',
    'afterAjaxUpdate'=>'js:function(){ $(\'.toggle-on-check\').toggleit(); }',
    'sortableAttributes'=>array(
        'name',
        'date_reg',
    ),
));
?>