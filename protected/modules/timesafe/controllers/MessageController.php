<?php

class MessageController extends RController
{
	public function actionIndex()
	{
		$this->render('index');
	}
        public function actionSave()
	{            
            $ID=str_replace('tr_', '', Yii::app()->getRequest()->getParam('id'));
            $criteria = new CDbCriteria;
            $criteria->select=array('id');
            $criteria->condition="id='".$ID."' and language='".Yii::app()->getRequest()->getParam('lang')."'";
            $model=Message::model()->find($criteria);
            if($model===null){
                $m =new Message();
                $m->id=$ID;
                $m->language=Yii::app()->getRequest()->getParam('lang');
                $m->translation=Yii::app()->getRequest()->getParam('value');
                $m->save();
            }else{
                Message::model()->updateAll(array('translation'=>Yii::app()->getRequest()->getParam('value')),"id='".$ID."' and language='".Yii::app()->getRequest()->getParam('lang')."'");
            }
            
	}	
}