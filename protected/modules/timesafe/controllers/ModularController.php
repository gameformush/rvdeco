<?php
class ModularController extends RController
{
    public $filterOption = array(
        'model'  => 'Modular',
        'fields' => array(            
            'title'=>array('type'=>'text'),
			'status'=>array('type'=>'checkbox'),
			            
        )
    );

    public $defaultAction = 'list';


    public function actionIndex() {
        $this->redirect('list');
    }

    public function actionList() {
        $model = new Modular('search');
        $model->unsetAttributes();

        if (isset($_GET['Modular'])) {
            $model->attributes = $_GET['Modular'];
            Yii::app()->user->setState('_filter_Modular', $_GET['Modular']);
        } else
            if (Yii::app()->user->hasState('_filter_Modular')) {
                $model->attributes = Yii::app()->user->getState('_filter_Modular');
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
        $model = new Modular;

        $this->performAjaxValidation($model);

        if (isset($_POST['Modular'])) {
            $model->attributes = $_POST['Modular'];
                        
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
        $page = (int)Yii::app()->request->getParam('Modular_page');

        if (isset($_POST['Modular'])) {
            $model->attributes = $_POST['Modular'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               

                $this->redirect(
                    array(
                         'list',
                         'Modular_page' => $page));
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
                    $model = Modular::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }

    /**
     * AJAX валидация
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'modular-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function beforeAction($action) {
        if ($_GET['ajax'] === 'state')
            if (count($_GET['ModularCheck']) > 0) {
                foreach ($_GET['ModularCheck'] as $column => $value) {
                    foreach ($value as $id => $val) {
                        Modular::model()->updateByPk((int)$id, array($column => (int)$val));
                    }
                }
                Yii::app()->end();
            }

        return parent::beforeAction($action);
    }
}


