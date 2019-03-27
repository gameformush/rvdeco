<?php
class OrdersController extends Controller
{
	public function actionIndex() {	
		
		$criteria = new CDbCriteria();
		$criteria->condition = "";
		$model = Orders::model()->findAll($criteria);
		
		$filtr = "Orders";
		$this->render('index', compact('model', 'filtr'));
	}
	
	
	public function actionGetform() {
		$id = $_POST['id'];
		$zakaz_id = 0;
		if ($_POST['zakaz_id'] != null) {
			$zakaz_id = $_POST['zakaz_id'];
		}
		if ($id == 0) {
			$model = null;
		} else {
			$model = Orders::model()->findByPk($id);
			$zakaz_id = $model->client_id;
		}
		
		if(Yii::app()->request->isAjaxRequest)
		{	
			$this->renderPartial('_form', array(
				'model' => $model, 'zakaz_id' => $zakaz_id
			), false, true);

			Yii::app()->end();
		}	
	}
	
	public function actionCreate() {	
		$model = new Orders();
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			$error = CActiveForm::validate($model);
			
			if( $error != '[]') {
				echo $error; 
				Yii::app()->end();
			} else {
				$model->attributes = $_POST['Orders'];
				if (strlen($_POST['Orders']['adress']) > 3) {
					$model->dostavka = 1;
				} else if (strlen($_POST['Orders']['index']) > 1) {
					$model->dostavka = 2;
				} else {
					$model->dostavka = 0;
				}
				$client = Customers::model()->findByPk($_POST['Orders']['client_id']);
				$model->parent_id = Yii::app()->user->getState('id');
				$model->parent_data = Yii::app()->user->getState('first_name').' '.Yii::app()->user->getState('last_name');
				$model->client_data = $client->fio.", ".$client->phone;
				$model->save();
				echo CJSON::encode(array(
					'status'=>'ok',
					/*'id'=>$model->id,
					'fio'=>$model->fio,
					'phone'=>$model->phone,
					'email'=>$model->email,
					'city'=>$model->city,
					'address'=>$model->address,
					'index'=>$model->index,
					'created_at'=>$model->getNiceDate(),*/
				));
				Yii::app()->end();
			}
		}
	}
	
	public function actionUpdate() {	
		$id = $_POST['Orders']['id'];
		
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			
			$model = $this->loadModel($id);
			$error = CActiveForm::validate($model);
			
			if( $error != '[]') {
				echo $error; 
				Yii::app()->end();
			} else {
				$model->attributes = $_POST['Orders'];
				if (strlen($_POST['Orders']['adress']) > 3) {
					$model->dostavka = 1;
				} else if (strlen($_POST['Orders']['index']) > 1) {
					$model->dostavka = 2;
				} else {
					$model->dostavka = 0;
				}
				$model->save();
				echo CJSON::encode(array(				
					'status'=>'ok',
					/*'id'=>$model->id,
					'fio'=>$model->fio,
					'phone'=>$model->phone,
					'email'=>$model->email,
					'city'=>$model->city,
					'address'=>$model->address,
					'index'=>$model->index,
					'created_at'=>$model->getNiceDate(),*/
				));
				Yii::app()->end();
			}
		}
	}
	
	public function actionDelete() {	
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			$id = $_POST['Orders']['id'];
			Orders::model()->deleteByPk($id);
			echo CJSON::encode(array(
				'status'=>'ok',
			));
		}
	}
	
	public function actionGetorders() {
		
		$id = $_POST['id'];
		
		if ($id == 0) {
			$model = new CDbCriteria();
			$model->order = "created_at DESC";
			$model = Orders::model()->findAll($criteria);
		}
		
		foreach ($model as $value) {
			$result = $result.'
				<tr role="row" class="odd">
					<td tabindex="0" class="sorting_1">'.$value->status_id.'</td>
					<td><a href="#">'.$value->status_id.'</a></td>
					<td>Traffic Court Referee</td>
					<td>22 Jun 1972</td>
					<td><span class="label label-success">Active</span></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>

								<ul class="dropdown-menu dropdown-menu-right">
									<li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
									<li><a href="#"><i class="icon-file-excel"></i> Export to .csv</a></li>
									<li><a href="#"><i class="icon-file-word"></i> Export to .doc</a></li>
								</ul>
							</li>
						</ul>
					</td>
				</tr>
			';
		}
		
		if ($result != null) {
			echo $result;
		} else {
			echo 'Клиенты не найдены.';
		}
	}
	
	public function actionGetl_0_10000() {
		$criteria = new CDbCriteria();
		$criteria->order = "id DESC";
		$criteria->limit = 10000;
		$orders = Orders::model()->findAll($criteria);
		foreach ($orders as $value) {
			if ($records == null) {
				$records = '["'.$value->id.'", "", "'.$value->parent_data.'", "'.$value->client_data.'", "'.$value->summa.'", "'.$value->getNiceDate().'"]';
			} else {
				$records = $records.', ["'.$value->id.'", "", "'.$value->parent_data.'", "'.$value->client_data.'", "'.$value->summa.'", "'.$value->getNiceDate().'"]';
			}
		}
		file_put_contents("files/orders/0-10000", $records);	
	}	
	
	
	public function actionGetorderslist() {
		$r_0_10000 = file_get_contents("files/orders/0-10000");
		
		$records = $r_0_10000;
		
		$results = '{ '.$meta.' "data": [ '.$records.' ] }';
		echo $results;
	}
	
	
	public function actionGetcustomer() {
		$query = $_POST['query'];
		$c = new CDbCriteria();
		$c->limit = 5;
		$c->compare('fio', $query, true, 'OR');
		$c->compare('phone', $query, true, 'OR');
		$model = Customers::model()->findAll($c);
		
		foreach ($model as $value) {
			if ($result == null) {
				$result = '<div class = "ccustomer" id = "id_'.$value->id.'" data-id = "'.$value->id.'" data-fio = "'.$value->fio.'">Ф.И.О: '.$value->fio.', Телефон: '.$value->phone.'</div>';
			} else {
				$result = $result.'<div class = "ccustomer" id = "id_'.$value->id.'" data-id = "'.$value->id.'" data-fio = "'.$value->fio.'">Ф.И.О: '.$value->fio.', Телефон: '.$value->phone.'</div>';
			}
		}
		if ($model != null) {
			echo $result;
		} else {
			echo "Ничего не найдено";
		}
	}
	
	
	public function actionShow($id) {	
		
		$model = Orders::model()->findByPk($id);
		$this->render('show', compact('model'));
	}
	
	protected function performAjaxValidation($model) {
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
	
    public function loadModel($id, $removed = false) {
        $model = Orders::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }
	
}