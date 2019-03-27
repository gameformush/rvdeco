<?php

class FeedbackController extends Controller {

    public function actionIndex() {
		$this->pageTitle = "Contact";
		
		$model = Obsh::model()->findByPk(1);
		$this->render('index', array('model' => $model));		
    }
	
	public function actionCreate() {
		$model = new Feedback();
		$error = CActiveForm::validate($model);      
		if( $error != '[]') {
			echo $error; 
			Yii::app()->end();
		} else {
			$model->attributes = $_POST['Feedback'];
			$model->save();
			echo CJSON::encode(array(
				'status'=>'ok',
			));
			Yii::app()->end();
		}	
    }
	
}

?>