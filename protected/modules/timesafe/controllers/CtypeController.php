<?php
class CtypeController extends RController
{
    public $filterOption = array(
        'model'  => 'Ctype',
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
        $model = new Ctype('search');
        $model->unsetAttributes();

        if (isset($_GET['Ctype'])) {
            $model->attributes = $_GET['Ctype'];
            Yii::app()->user->setState('_filter_Ctype', $_GET['Ctype']);
        } else
            if (Yii::app()->user->hasState('_filter_Ctype')) {
                $model->attributes = Yii::app()->user->getState('_filter_Ctype');
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
        $model = new Ctype;

        $this->performAjaxValidation($model);

        if (isset($_POST['Ctype'])) {
            $model->attributes = $_POST['Ctype'];
                        
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
        $page = (int)Yii::app()->request->getParam('Ctype_page');

        if (isset($_POST['Ctype'])) {
            $model->attributes = $_POST['Ctype'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               

                $this->redirect(
                    array(
                         'list',
                         'Ctype_page' => $page));
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
                    $model = Ctype::model()->findByPk($id);

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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ctype-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function beforeAction($action) {
        if ($_GET['ajax'] === 'state')
            if (count($_GET['CtypeCheck']) > 0) {
                foreach ($_GET['CtypeCheck'] as $column => $value) {
                    foreach ($value as $id => $val) {
                        Ctype::model()->updateByPk((int)$id, array($column => (int)$val));
                    }
                }
                Yii::app()->end();
            }

        return parent::beforeAction($action);
    }
}


