<?php
class CustomersController extends Controller
{
	public function actionIndex() {	
		
		$criteria = new CDbCriteria();
		$criteria->order = "created_at DESC";
		$model = Customers::model()->findAll();
		
		$filtr = "Customers";
		$this->render('index', array('model' => $model));
	}
	
	
	public function actionGetform() {
		$id = $_POST['id'];
		if ($id == 0) {
			$model = null;
		} else {
			$model = Customers::model()->findByPk($id);
			Yii::app()->user->setState('client_id', $id);
		}
		
		if(Yii::app()->request->isAjaxRequest)
		{
			$this->renderPartial('_form', array(
				'model' => $model,
			), false, true);

			Yii::app()->end();
		}	
	}
	
	public function actionCreate() {	

		$model = new Customers();
		
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			$error = CActiveForm::validate($model);
			
			if( $error != '[]') {
				echo $error; 
				Yii::app()->end();
			} else {
				$model->attributes = $_POST['Customers'];
				if ($_POST['Customers']['day'] != null and $_POST['Customers']['month'] != null) {
					$model->birthday = $_POST['Customers']['day'].".".$_POST['Customers']['month'];
				}
				$model->save();
				echo CJSON::encode(array(
					'status'=>'ok',
					'id'=>$model->id,
					'fio'=>$model->fio,
					'phone'=>$model->phone,
					'email'=>$model->email,
					'city'=>$model->city,
					'address'=>$model->address,
					'index'=>$model->index,
					'created_at'=>$model->getNiceDate(),
				));
				Yii::app()->user->setState('client_id', $model->id);
				Yii::app()->end();
			}
		}
	}
	
	public function actionUpdate() {	
		$id = $_POST['Customers']['id'];
		
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			
			$model = $this->loadModel($id);
			$error = CActiveForm::validate($model);
			
			if( $error != '[]') {
				echo $error; 
				Yii::app()->end();
			} else {
				$model->attributes = $_POST['Customers'];
				if ($_POST['Customers']['day'] != null and $_POST['Customers']['month'] != null) {
					$model->birthday = $_POST['Customers']['day'].".".$_POST['Customers']['month'];
				}
				$model->save();
				echo CJSON::encode(array(				
					'status'=>'ok',
					'id'=>$model->id,
					'fio'=>$model->fio,
					'phone'=>$model->phone,
					'email'=>$model->email,
					'city'=>$model->city,
					'address'=>$model->address,
					'index'=>$model->index,
					'created_at'=>$model->getNiceDate(),
				));
				Yii::app()->end();
			}
		}
	}
	
	public function actionDelete() {	
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			$id = $_POST['Customers']['id'];
			Customers::model()->deleteByPk($id);
			echo CJSON::encode(array(
				'status'=>'ok',
			));
		}
	}
	
	public function actionGo() {	
		for ($i = 1001; $i <= 2000; $i++) {
			$model = new Customers();
			$model->fio = "Клиент: ".$i;
			$model->mobile_phone = "Тел: ".$i;
			$model->save();
		}
	
	}
	
	public function actionGetl_0_10000() {
		$criteria = new CDbCriteria();
		$criteria->order = "id DESC";
		$criteria->limit = 10000;
		$customers = Customers::model()->findAll($criteria);
		foreach ($customers as $value) {
			if ($records == null) {
				$records = '["'.$value->id.'", "'.$value->fio.'", "'.$value->phone.'", "'.$value->email.'", "'.$value->city.'", "'.$value->address.'", "'.$value->index.'", "'.$value->getNiceDate().'"]';
			} else {
				$records = $records.', ["'.$value->id.'", "'.$value->fio.'", "'.$value->phone.'", "'.$value->email.'", "'.$value->city.'", "'.$value->address.'", "'.$value->index.'", "'.$value->getNiceDate().'"]';
			}
			
		}
		file_put_contents("files/customers/0-10000", $records);	
	}	
	
	public function actionGetl_10001_20000() {
		$criteria = new CDbCriteria();
		$criteria->order = "id DESC";
		$criteria->limit = 10000;
		$criteria->offset = 10001;
		$customers = Customers::model()->findAll($criteria);
		foreach ($customers as $value) {
			if ($records == null) {
				$records = '["'.$value->id.'", "'.$value->fio.'", "'.$value->phone.'", "'.$value->email.'", "'.$value->city.'", "'.$value->address.'", "'.$value->index.'", "'.$value->getNiceDate().'"]';
			} else {
				$records = $records.', ["'.$value->id.'", "'.$value->fio.'", "'.$value->phone.'", "'.$value->email.'", "'.$value->city.'", "'.$value->address.'", "'.$value->index.'", "'.$value->getNiceDate().'"]';
			}
			
		}
		file_put_contents("files/customers/10001-20000", $records);
	}	
	
	public function actionGetcustomerslist() {
		$r_0_10000 = file_get_contents("files/customers/0-10000");
		$r_100001_20000 = file_get_contents("files/customers/10001-20000");
		
		$records = $r_0_10000;
		
		$results = '{ '.$meta.' "data": [ '.$records.' ] }';

		echo $results;
		
	}
	

	
	public function actionShow($id) {	
		
		$model = Customers::model()->findByPk($id);
		$this->render('show', compact('model'));
	}
	
	protected function performAjaxValidation($model) {
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo CActiveForm::validate($model); 
            Yii::app()->end();
        }
    }
	
    public function loadModel($id, $removed = false) {
        $model = Customers::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }
	
}