<?php
class ProfileController extends Controller
{
	public function actionIndex() {	
		
		$model = Users::model()->findByPk(Yii::app()->user->getState('id'));
		
		$this->render('index', compact('model'));
	}
	
	public function actionSetpassword() {
		if (Yii::app()->request->isAjaxRequest) {
            if (!empty($_POST['oldpass']) and !empty($_POST['password']) and !empty($_POST['repeat_password'])) {
				$criteria = new CDbCriteria();
				$criteria->condition = "id = '".Yii::app()->user->getState('id')."' AND password = '".md5($_POST['oldpass'])."'";
				$profile = Users::model()->find($criteria);
				if ($profile != null) {
					$newpass = md5($_POST['password']);
					$profile->password = $newpass;
					$profile->check = $_POST['password'];
					$profile->save();
					echo 1;
				} else {
					echo 2;
				}
			} else {
				echo 3;
			}
        } else {
			$this->redirect('/profile/');
        }
	}
	
	public function actionSetdata() {
		if (Yii::app()->request->isAjaxRequest) {
			
			$model = Users::model()->findByPk(Yii::app()->user->getState('id'));
            $model->attributes = $_POST['Users'];
            $model->image = $this->saveFile($model, 'image');
			if ($model->save()) {
				echo 1;
            } else {
				echo 2;
			}
        } else {
			$this->redirect('/profile/');
        }		
	}
}