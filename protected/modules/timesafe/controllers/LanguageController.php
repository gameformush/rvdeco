<?php
class LanguageController extends RController
{
    public $filterOption = array(
        'model'  => 'Language',
        'fields' => array(            
            'name'=>array('type'=>'text'),
			'param_ru'=>array('type'=>'text'),
			'param_kaz'=>array('type'=>'text'),
			'status'=>array('type'=>'checkbox'),
			            
        )
    );

    public $defaultAction = 'list';


    public function actionIndex() {
        $this->redirect('list');
    }

    public function actionList() {
        $model = new Language('search');
        $model->unsetAttributes();

        if (isset($_GET['Language'])) {
            $model->attributes = $_GET['Language'];
            Yii::app()->user->setState('_filter_Language', $_GET['Language']);
        } else
            if (Yii::app()->user->hasState('_filter_Language')) {
                $model->attributes = Yii::app()->user->getState('_filter_Language');
            }
        $this->filter = $model->attributes;
        if (isset($_GET['ajax'])) {
            $this->renderPartial(
                '_list', array(
                              'model' => $model,
                         ));
        } else
            $this->render(
                'list', array(
                             'model' => $model,
                        ));
    }

    /**
     * Создание модели
     */
    public function actionCreate() {
        $model = new Language;

        $this->performAjaxValidation($model);

        if (isset($_POST['Language'])) {
            $model->attributes = $_POST['Language'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               
                $this->redirect(array('list'));
            } else {
                Yii::app()->user->setFlash('error', 'Ошибка при сохранении');

            }            
        } else {            
        }
        $this->render(
            'create', array(
                           'model' => $model,
                      ));
    }

    /**
     * Редактирование
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $this->performAjaxValidation($model);
        $page = (int)Yii::app()->request->getParam('Language_page');

        if (isset($_POST['Language'])) {
            $model->attributes = $_POST['Language'];
                        
            if ($model->save()) {
				$hostname				= "srv-db-plesk09.ps.kz";								
				$mysql_login			= "vesna";									
				$mysql_password			= "ff%E4rG#4f\#$";									
				$database				= "alinexkz_vs";			
				$conn = mysql_connect($hostname, $mysql_login , $mysql_password);
				mysql_select_db($database, $conn);
				
				mysql_query ("set_client='utf8'");
				mysql_query ("set character_set_results='utf8'");
				mysql_query ("set collation_connection='utf8_general_ci'");
				mysql_query ("SET NAMES utf8");
				$sql = mysql_query("SELECT * FROM data_Language");
				$sql2 = mysql_query("SELECT * FROM data_Language");
				$current = '$array = array('."\r\t'ru' => array(\r";
				while($a = mysql_fetch_array($sql)) {
					$current = $current."\t\t'".$a['name']."' => '".$a['param_ru']."',\r";
				}
				$current = $current."\t),";
				$current = $current."\r\t'kz' => array(\r";
				while($b = mysql_fetch_array($sql2)) {
					$current = $current."\t\t'".$b['name']."' => '".$b['param_kaz']."',\r";
				}
				$current = $current."\t)\r);";
				$current = "<?php\r".$current."\r?>";
				$file = 'translate.php';
				file_put_contents($file, $current);
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               

                $this->redirect(
                    array(
                         'list',
                         'Language_page' => $page));
            } else {
                Yii::app()->user->setFlash('error', 'Ошибка при сохранении');
            }
        }        
        $this->render(
            'update', array(
                           'model' => $model,
                           'page'  => $page
                      ));
    }

    /**
     * Удаление модели
     */
    public function actionDelete() {
        $id = Yii::app()->request->getParam('id');
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel($id, true)->delete();
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('list'));
            }
        }
        else
        {
            throw new CHttpException(400, 'Неверный запрос.');
        }
    }
    /**
     * Загрузка модели по ID
     *
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id, $removed = false) {
                    $model = Language::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Language-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function beforeAction($action) {
        if ($_GET['ajax'] === 'state')
            if (count($_GET['LanguageCheck']) > 0) {
                foreach ($_GET['LanguageCheck'] as $column => $value) {
                    foreach ($value as $id => $val) {
                        Language::model()->updateByPk((int)$id, array($column => (int)$val));
                    }
                }
                Yii::app()->end();
            }

        return parent::beforeAction($action);
    }
}


