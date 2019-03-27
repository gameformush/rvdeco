<?php
class UsersController extends Controller
{
	public function actionIndex() {	
		$this->render('index');
	}
	
	public function actionGetusers() {
		
		$query = $_POST['query'];
		
		$criteria = new CDbCriteria( array(
			'order' => 'created_at ASC',
			'condition' => "(first_name LIKE :query OR last_name LIKE :query OR position LIKE :query)",         
			'params'    => array(':query' => "%$query%")  
		));
		
		$model = Users::model()->findAll($criteria);
		foreach ($model as $value) {
			$department = Departments::model()->findByPk($value->department);
			$result = $result.'
				<div class = "col-sm-6 col-lg-4">
					<div class = "content-group">
						<div class = "panel-body border-radius-top bg-primary text-center" style = "background:#273246;">
							<div class = "content-group-sm">
								<h5 class = "text-semibold no-margin-bottom">
									'.$value->first_name.' '.$value->last_name.'
								</h5>

								<span class = "display-block">'.$value->position.'</span>
							</div>

							<a href = "#" class = "display-inline-block content-group-sm">
								<img src = "/images/no-photo.png" class = "img-circle img-responsive" alt = "" style = "width: 120px; height: 120px;">
							</a>

							<ul class = "list-inline no-margin-bottom">
								<li><a href = "#" data-popup = "tooltip" data-original-title = "Позвонить" class = "btn bg-blue-700 btn-rounded btn-icon"><i class = "icon-phone"></i></a></li>
								<li><a href = "#" data-popup = "tooltip" data-original-title = "Чат" class = "btn bg-blue-700 btn-rounded btn-icon"><i class = "icon-bubbles4"></i></a></li>
								<li><a href = "#" data-popup = "tooltip" data-original-title = "Написать письмо" class = "btn bg-blue-700 btn-rounded btn-icon"><i class = "icon-envelop4"></i></a></li>
								<li><a href = "/users/update/id/'.$value->id.'" data-popup = "tooltip" data-original-title = "Редактировать" class = "btn bg-blue-700 btn-rounded btn-icon"><i class = "icon-pencil"></i></a></li>
							</ul>
						</div>

						<div class = "panel panel-body no-border-top no-border-radius-top">
							<div class = "form-group no-margin-bottom">
								<label class = "text-semibold">Отдел:</label>
								<span class = "pull-right-sm">'.$department->title.'</span>
							</div>
							<div class = "form-group no-margin-bottom">
								<label class = "text-semibold">Сотовый номер:</label>
								<span class = "pull-right-sm">'.$value->mobile_phone.'</span>
							</div>
							<div class = "form-group no-margin-bottom">
								<label class = "text-semibold">Городской номер:</label>
								<span class = "pull-right-sm">'.$value->city_phone.'</span>
							</div>
							<div class = "form-group no-margin-bottom">
								<label class = "text-semibold">E-Mail адрес:</label>
								<span class = "pull-right-sm"><a href = "#">'.$value->login.'@maint.kz</a></span>
							</div>
							<div class = "form-group no-margin-bottom">
								<label class = "text-semibold">Статус:</label>
								<span class = "pull-right-sm"><span class = "label bg-grey-400">Не в сети</span></span>
							</div>
						</div>
					</div>
				</div>
			';
		}
		
		if ($result != null) {
			echo $result;
		} else {
			echo 'Сотрудники не найдены.';
		}
	}
	
	public function actionCreate() {
		$model = new Users;
		$this->performAjaxValidation($model);
		if (isset($_POST['Users'])) {
			$model->attributes = $_POST['Users'];
			if ($model->save()) {
				$this->redirect('/users/');
			}
		}
		$this->render('create', compact('model'));
	}
	
	public function actionUpdate($id) {	
		$model = $this->loadModel($id);
		$this->performAjaxValidation($model);
		if (isset($_POST['Users'])) {
			$model->attributes = $_POST['Users'];
			if ($model->save()) {
				$this->redirect('/users/');
			}
		}
		$this->render('update', compact('model'));
	}
	
	protected function performAjaxValidation($model) {
        if (Yii::app()->getRequest()->getIsAjaxRequest()) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }	
	
	public function loadModel($id, $removed = false) {
        $model = Users::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }
	
}