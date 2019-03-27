<?php
class SubscriberController extends RController
{
    public $filterOption = array(
        'model'  => 'Subscriber',
        'fields' => array(            
            'email'=>array('type'=>'text'),
			'created_at'=>array('type'=>'date'),
			'status'=>array('type'=>'checkbox'),
			            
        )
    );

    public $defaultAction = 'list';


    public function actionIndex() {
        $this->redirect('list');
    }

    public function actionList() {
        $model = new Subscriber('search');
        $model->unsetAttributes();

        if (isset($_GET['Subscriber'])) {
            $model->attributes = $_GET['Subscriber'];
            Yii::app()->user->setState('_filter_Subscriber', $_GET['Subscriber']);
        } else
            if (Yii::app()->user->hasState('_filter_Subscriber')) {
                $model->attributes = Yii::app()->user->getState('_filter_Subscriber');
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
        $model = new Subscriber;

        $this->performAjaxValidation($model);

        if (isset($_POST['Subscriber'])) {
            $model->attributes = $_POST['Subscriber'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               
                $this->redirect(array('list'));
            } else {
                Yii::app()->user->setFlash('error', 'Ошибка при сохранении');

            }            
        } else {
			$model->created_at = time();            
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
        $page = (int)Yii::app()->request->getParam('Subscriber_page');

        if (isset($_POST['Subscriber'])) {
            $model->attributes = $_POST['Subscriber'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               

                $this->redirect(
                    array(
                         'list',
                         'Subscriber_page' => $page));
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
                    $model = Subscriber::model()->findByPk($id);

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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subscriber-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function beforeAction($action) {
        if ($_GET['ajax'] === 'state')
            if (count($_GET['SubscriberCheck']) > 0) {
                foreach ($_GET['SubscriberCheck'] as $column => $value) {
                    foreach ($value as $id => $val) {
                        Subscriber::model()->updateByPk((int)$id, array($column => (int)$val));
                    }
                }
                Yii::app()->end();
            }

        return parent::beforeAction($action);
    }
}


