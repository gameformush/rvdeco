<?php

class TranslateController extends RController
{
	public function actionIndex()
	{
		$category = MessageCategory::model()->findAll();
		$this->render('index',compact('category'));		
	}

	public function actionSave()
	{
		if(Yii::app()->request->isAjaxRequest == TRUE)
		{	
		  	$value = Yii::app()->request->getPost('value');  
		  	$id = (int)Yii::app()->request->getPost('pk');  
		  	$name = Yii::app()->request->getPost('name');  		  	
		  	Message::model()->updateAll(array('translation'=>$value),'language=:lang and id=:id',array(':id'=>$id,':lang'=>$name));
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}