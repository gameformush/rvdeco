<?php

class FaqController extends Controller {

    public function actionIndex() {
		$this->pageTitle = "Foire Aux Questions";
		
		$model = Faq::model()->findAll("status_select_2 = 'Активный'");
		$this->render('index', array('model' => $model));		
    }
	public function actionCreate() {
		$model = new Faq();
		$error = CActiveForm::validate($model);      
		if( $error != '[]') {
			echo $error; 
			Yii::app()->end();
		} else {
			$model->attributes = $_POST['Faq'];
			$model->status_select_2 = "Неактивный";
			$model->save();
			echo CJSON::encode(array(
				'status'=>'ok',
			));
			Yii::app()->end();
		}	
    }
}

?>