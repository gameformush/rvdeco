<?php
class BaseController extends Controller
{
	public function actionIndex() {	
		
		$this->render('index', compact('model', 'filtr'));
	}
	
	public function actionGetstudentslist() {	
		
		$students = new Students();
		$config = Fields::model()->findByPk(1);
		$arr_conf = explode(":", $config->config);
		
		$model = Students::model()->findAll();
		
		foreach ($model as $value) {
			$menu = '<ul class=\"icons-list\"><li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-menu9\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\"><li><a class = \"action-button\" data-id = \"'.$value->id.'\" data-type = \"global\" data-title = \"Редактировать\" href=\"#\"><i class=\"icon-pencil4\"></i> Изменить</a></li><li><a class = \"action-btn\" data-id = \"'.$value->id.'\" data-type = \"delete\" href=\"#\"><i class=\"icon-x\"></i> Удалить</a></li></ul></li></ul>';
			$rec = "";
			foreach($students->attributes as $key => $val) {
				if (in_array($key, $arr_conf)) {
					if ($rec == null) {
						$rec = '"'.$value->{$key}.'"';
					} else {
						$rec = $rec.', "'.$value->{$key}.'"';
					}
				}
			}
			if ($records == null) {
				$records = '['.$rec.', "'.$menu.'"]';
			} else {
				$records = $records.', ['.$rec.', "'.$menu.'"]';
			}
		}
	
		$results = '{ '.$meta.' "data": [ '.$records.' ] }';
		echo $results;
	}
	
	public function actionGetgroupslist() {
		$groups = Groups::model()->findAll("id <= 300");
		$menu = '<ul class=\"icons-list\"><li class=\"dropdown\"><a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"icon-menu9\"></i></a><ul class=\"dropdown-menu dropdown-menu-right\"><li><a href=\"#\"><i class=\"icon-pencil4\"></i> Изменить</a></li><li><a href=\"#\"><i class=\"icon-x\"></i> Удалить</a></li></ul></li></ul>';
		
		if (file_exists("asd")) {
			foreach ($groups as $value) {
				if ($records == null) {
					$records = '["'.$value->id.'", "'.$value->name_text.'", "'.$value->category_select.'", "'.$value->uchitel_select.'", "'.$value->office_select.'", "'.$value->kol_text.'", "'.$value->tema_text.'", "'.$value->days_text.'", "'.$value->time_text.'", "'.$value->getNiceDate().'", "'.$menu.'"]';
				} else {
					$records = $records.', ["'.$value->id.'", "'.$value->name_text.'", "'.$value->category_select.'", "'.$value->uchitel_select.'", "'.$value->office_select.'", "'.$value->kol_text.'", "'.$value->tema_text.'", "'.$value->days_text.'", "'.$value->time_text.'", "'.$value->getNiceDate().'", "'.$menu.'"]';
				}	
			}
			$results = '{ '.$meta.' "data": [ '.$records.' ] }';
			file_put_contents("asd", $results);
		} else {
			$results = file_get_contents("asd");
		}
		echo $results;
	}
	
	public function actionGo() {
		for($i = 0; $i < 1000; $i++) {
			$model = new Students();
			$model->fam = $i;
			$model->name = $i;
			$model->otchestvo = $i;
			$model->save();
		}
	}
	
	public function actionGetform() {
		if(Yii::app()->request->isAjaxRequest) {
			
			$id = $_POST['id'];
			$type = $_POST['type'];
			$base = $_POST['base'];
			$modal = $_POST['modal'];
			$field = $_POST['field'];
				
			if ($base == "setfield") {
				$vid = $_POST['vid'];
				$this->renderPartial('forms/_setfield_form', array(
					'name_model' => $type, 
					'vid' => $vid,
				), false, true);
			} else if ($type == "select") {
				$selected = $_POST['selected'];
				
				if(ctype_digit($base)) {
					$model = Cronosselects::model()->findByPk($base);
					$model = explode(":", $model->spisok_bigtext);
					$digit = 1;
				} else {
					$model = $base::model()->findAll();
					$digit = 0;
				}
				
				$this->renderPartial('forms/_select_form', array(
					'model' => $model, 
					'selected' => $selected,
					'digit' => $digit,
				), false, true);

				Yii::app()->end();
			} else if ($type == "global") {
				if ($id == 0) {
					$tip = "create";
					$model = new $base();
				} else {
					$tip = "update";
					$model = $base::model()->findByPk($id);
				}
				$this->renderPartial('forms/_global_form', array(
					'model' => $model, 
					'base' => $base,
					'tip' => $tip,
					'modal' => $modal,
					'field' => $field
				), false, true);
			}
		}
	}
	
	public function actionSaveform() {
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			
			$id = $_POST['id'];
			$base = $_POST['base'];
			
			if ($id == null) {
				$model = new $base();
			} else {
				$model = $base::model()->findByPk($id);
			}
			$error = CActiveForm::validate($model);      
			if( $error != '[]') {
				echo $error; 
				Yii::app()->end();
			} else {
				$model->attributes = $_POST[$base];
				$model->save();
				echo CJSON::encode(array(
					'status'=>'ok',
				));
				Yii::app()->end();
			}
		}
	}
	
	
	public function actionDelete() {
		if (Yii::app()->getRequest()->getIsAjaxRequest()) {
			$id = $_POST['id'];
			$name_model = $_POST['name_model'];
			Yii::app()->db
			->createCommand("DELETE FROM `".$name_model."` WHERE id='".$id."'")
			->execute();
		}
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
	
	public function actionUpdatefield() {
		if(Yii::app()->request->isAjaxRequest) {
			$id = $_POST['id'];
			$name_model = $_POST["name_model"];
			$val = $_POST['val'];
			$field = $_POST['edit_field'];
			Yii::app()->db
			->createCommand("UPDATE ".$name_model." SET `".$field."` = '".$val."' WHERE id='".$id."'")
			->execute();
		}
	}
	
	public function actionUpdateselect() {
		if(Yii::app()->request->isAjaxRequest) {
			$id = $_POST['id'];
			$val = $_POST['val'];
			$field = $_POST['edit_field'];
			$name_model = $_POST["name_model"];
			Yii::app()->db
			->createCommand("UPDATE ".$name_model." SET `".$field."` = '".$val."' WHERE id='".$id."'")
			->execute();
		}
	}
	
	public function actionSetfields() {
		$arr = $_POST['fields_list'];
		$table = $_POST['table'];
		$vid = $_POST['vid'];
		if(Yii::app()->request->isAjaxRequest) {
			foreach ($arr as $key => $value) {
				if ($settings == null) {
					$settings = $value;
				} else {
					$settings = $settings.":".$value;
				}
			}
			Yii::app()->db
			->createCommand("UPDATE field_settings SET config = '".$settings."' WHERE base='".$table."' AND type = '".$vid."'")
			->execute();
		}
	}
	
}