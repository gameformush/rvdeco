<?
$models = MessageSource::model()->findAllByAttributes(array('category'=>$cat->name));

$translate = Message::model()->findAll();
foreach($translate as $k=>$t){
	$words[$t->id][$t->language] = $t->translation;
}
?>
<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Фраза</th>
      <th>Перевод</th>      
    </tr>
  </thead>
  <tbody>
  	<?php foreach ($models as $key => $model): ?>  		
    <tr>
      <td><?=$model->message?></td>
      <td><a href="#" title="" class="editable" data-pk="<?=$model->id?>" data-name='kz'><?=$words[$model->id]['kz']?></a></td>
      <td><a href="#" title="" class="editable" data-pk="<?=$model->id?>" data-name="en"><?=$words[$model->id]['en']?></a></td>
    </tr>
  	<?php endforeach ?>
  </tbody>
</table>
<?=$cat->title?>