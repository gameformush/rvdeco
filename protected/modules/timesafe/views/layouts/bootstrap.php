<!DOCTYPE html>
<html lang="en">`
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<script type="text/javascript" src="/my/jquery.js"></script>
    <title><?=$this->pageTitle?> - Система администрирования сайта</title>    
    <link rel="shortcut icon" href="/css/bootstrap/favicon.ico" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/timesafe.css" media="all">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap/font-awesome.css" media="all">
    <style type="text/css">
        body {
            padding-top: 60px;
        }
    </style>

</head>

<body>
<?php# $this->widget('BootNav'); ?>
<?php $this->widget('bootstrap.widgets.BootNavbar', array(
    'brand'=>'<i class="icon-external-link"></i> '.Yii::app()->name,
    'brandUrl'=>'/',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'items'=>array(
            
       
            array('label'=>'Контент','url'=>'#','icon'=>'icon-th','items'=>array(
                array('label'=>'Публикации', 'url'=>array('news/list'),'icon'=>'icon-pencil'),
				array('label'=>'Текстовые страницы', 'url'=>array('page/list'),'icon'=>'icon-pencil'),
            )),
			array('label'=>'Обсуждения','url'=>'#','icon'=>'icon-align-center','items'=>array(
                array('label'=>'Темы', 'url'=>array('forum/list'),'icon'=>'icon-pencil'),
				array('label'=>'Категории', 'url'=>array('forumcategory/list'),'icon'=>'icon-folder-open'),
            )),
			array('label'=>'Навигация','url'=>'#','icon'=>'icon-align-center','items'=>array(
                array('label'=>'Главное меню', 'url'=>array('navigation/list'),'icon'=>'icon-folder-open'),
            )),
			array('label'=>'Пользователи','url'=>'#','icon'=>'icon-align-center','items'=>array(
                array('label'=>'Список пользователей', 'url'=>array('profile/list'),'icon'=>'icon-folder-open'),
            )),
            /*array('label'=>'Модерация','url'=>'#','icon'=>'icon-th','items'=>array(
                array('label'=>'Категории каталога', 'url'=>array('catalogCategory/list'),'icon'=>'icon-folder-open'),
                array('label'=>'Модулор', 'url'=>array('modular/list'),'icon'=>'icon-folder-open'),                
                array('label'=>'Слайдер', 'url'=>array('slider/list'),'icon'=>'icon-film'),
                array('label'=>'Специализации', 'url'=>array('ctype/list'),'icon'=>'icon-folder-open'),
                array('label'=>'Темы вопросов', 'url'=>array('ftype/list'),'icon'=>'icon-folder-open'),
             )), 
            
            array('label'=>'Рассылка','url'=>'#','icon'=>'icon-align-center','items'=>array(
                array('label'=>'Подписчики', 'url'=>array('subscriber/list'),'icon'=>'user'),
                array('label'=>'Выпуски', 'url'=>array('subscribe/list'),'icon'=>'icon-align-center'),
            )),
            array('label'=>'Купоны','url'=>'#','icon'=>'icon-align-center','items'=>array(
                array('label'=>'Выданные купоны', 'url'=>array('kupon/list'),'icon'=>'user'),
            )),
			array('label'=>'Мультиязычность','url'=>'#','icon'=>'icon-folder-open','items'=>array(
                array('label'=>'Перевод слов', 'url'=>array('language/list'),'icon'=>'icon-pencil'),
				array('label'=>'Настройки', 'url'=>array('kupon/list'),'icon'=>'cogs'),
            )),
             //  array('label'=>'Навигация', 'url'=>array('navigation/list'),'icon'=>'icon-align-center'), 
            */
            ),
        ),
         
        array(
            'class'=>'bootstrap.widgets.BootMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Настройки', 'url'=>'#','icon'=>'cogs', 'items'=>array(                                    
                    array('label'=>'Настройки', 'url'=>array('sysSetting/index'),'icon'=>'icon-wrench'),
//                    array('label'=>'Системные фразы', 'url'=>array('translate/'),'icon'=>'cog'),
                    
                       array('label'=>'Администраторы', 'url'=>array('user/list'),'icon'=>'user'),
                )),
                array('label'=>Yii::app()->user->name, 'url'=>'#','icon'=>'user', 'items'=>array(
               
                  /*  array('label'=>'Права доступа', 'url'=>array('authItem/permissions'),'icon'=>'cog'),*/
                    
                    '---',
                    array('label'=>'Выход', 'url'=>'/site/logout', 'icon'=>'off'),
                )),
            ),
        ),        
    ),
)); ?>


<div class="container-fluid">
    <div class="row-fluid">
<? if(count($this->menu)>0 || count($this->filter)>0):?>
    <? if (!Yii::app()->user->isGuest): ?>
    
        <div class="span2">
        <? if(count($this->menu)>0): ?>
        <div class="well">            
            <h4><i class="icon-list"></i> Меню</h4>
            <hr>
            <ul class="vmenu">
                <? foreach ($this->menu as $menu):?>
                <li><a href="<?=CHtml::normalizeUrl($menu['url'])?>"><?=$menu['label']?></a></li>
                <? endforeach; ?>
            </ul>            
        </div>
        <? endif ?>

        <? $this->widget('timesafe.components.WFilter'); ?>
        <? $this->widget('timesafe.components.WTrash'); ?>
      
        </div>
    
    <? endif ?>
    <div class="span10">
        <div class="content">
<? else: ?>
    <div class="span12">
    <div class="content" style="margin-left:0">
<? endif;?>

        
        <?php if (!empty($this->breadcrumbs)):?>
        <?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'homeLink'=>array('label'=>'Главная','url'=>array('hello/index')),
        )); ?>
        <? endif;?>
        <?php
            echo $content;
        ?>
                 <?php $this->beginWidget('BootModal', array('id' => 'listing')); ?>
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3><i class="icon-th-list"></i> </h3>
            </div>
            <div class="modal-body">
                <p></p>
                <strong></strong>
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="icon-ok"></i> Закрыть', '#',array('class'=>'btn', 'data-dismiss'=>'modal')); ?>                                
            </div>

            <?php $this->endWidget(); ?>
        <script type="text/javascript" src="/js/admin/plugins.js"></script>
        <script type="text/javascript" src="/js/admin/script.js"></script>
        <script type="text/javascript">
        
$(function(){
    $('.auto-list').click(function(){                    
        var t = $(this);
        $.ajax({ url:'/timesafe/json/list',data:{model:t.attr('data-model'),title:t.attr('data-title')},
            dataType:'json',
            success:function(m){
                if(m.title!=undefined){
                    $('#listing').find('h3').html('<i class="icon-th-list"></i> '+m.title);
                }
                var list = '';
                var id = $('#'+t.attr('data-source')).val();
                for (i in m.data){
                    list +='<label class="radio"><input id="list-'+m.data[i].id+'" type="radio" value="'+m.data[i].id+'" '+(id==i?'checked="checked"':'')+' name="list'+t.attr('data-model')+'">'+m.data[i].title+'</label>';
                }
                $('#listing').find('.modal-body').html(list);
                $('#listing input').change(function(){
                    $('#'+t.attr('data-source')).val(this.value);
                    $('#'+t.attr('data-sourceTitle')).val(m.data[this.value].title);
                });
            }
        });
    });
})
</script>
    </div>
    </div>
</div>

    <footer>
        <p>&copy; Разработчик: Рудаков Андрей<br/>Контакт для связи: 8 707 276 000 6</p>
    </footer>
    <div class="timesafe-message"><?php $this->widget('bootstrap.widgets.BootAlert');?></div>
</body>
</html>


