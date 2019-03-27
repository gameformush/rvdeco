<?php
class SubscribeController extends RController
{
    public $filterOption = array(
        'model'  => 'Subscribe',
        'fields' => array(            
            'title'=>array('type'=>'text'),
			'created_at'=>array('type'=>'date'),
			'send_at'=>array('type'=>'date'),
			'status'=>array('type'=>'checkbox'),
			            
        )
    );

    public $defaultAction = 'list';


    public function actionIndex() {
        $this->redirect('list');
    }

    public function actionList() {
        $model = new Subscribe('search');
        $model->unsetAttributes();

        if (isset($_GET['Subscribe'])) {
            $model->attributes = $_GET['Subscribe'];
            Yii::app()->user->setState('_filter_Subscribe', $_GET['Subscribe']);
        } else
            if (Yii::app()->user->hasState('_filter_Subscribe')) {
                $model->attributes = Yii::app()->user->getState('_filter_Subscribe');
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
        $model = new Subscribe;

        $this->performAjaxValidation($model);

        if (isset($_POST['Subscribe'])) {
            $model->attributes = $_POST['Subscribe'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               
                $this->redirect(array('list'));
            } else {
                Yii::app()->user->setFlash('error', 'Ошибка при сохранении');

            }            
        } else {
			$model->created_at = time();
			$model->send_at = time();            
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
        $page = (int)Yii::app()->request->getParam('Subscribe_page');

        if (isset($_POST['Subscribe'])) {
            $model->attributes = $_POST['Subscribe'];
                        
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('success', 'Сохранено');               

                $this->redirect(
                    array(
                         'list',
                         'Subscribe_page' => $page));
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
                    $model = Subscribe::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Страница не существует.');
        }
        return $model;
    }

    public function actionNosend() {
        if ($_POST["type"] == "stock") {
            $stock = Stock::model()->findByPk($_POST["id"]);
            $stock->subscribe = 0;
            $stock->save();
        }
        if ($_POST["type"] == "news") {
            $news = News::model()->findByPk($_POST["id"]);
            $news->subscribe = 0;
            $news->save();
        }
    }

    public function actionSend() {
        if ((int)$_POST["id"] > 0) {
            $model = Subscribe::model()->findByPk($_POST["id"]);
        }
        else {
            $model = new Subscribe;
            $model->created_at = time();
        }
        $model->title = $_POST["title"];
        $model->content = $_POST["text"];
        $model->send_at = time();
        $model->save(false);
        $stocks = Stock::model()->findAll("status='1' AND subscribe='1'");
        $news = News::model()->findAll("status='1' AND subscribe='1'");
        $subscribers = Subscriber::model()->findAll("status='1'");
        $n = new Notifier();
        $n->subscribe($model,$stocks,$news,$subscribers);
    }

    /**
     * AJAX валидация
     *
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'subscribe-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function beforeAction($action) {
        if ($_GET['ajax'] === 'state')
            if (count($_GET['SubscribeCheck']) > 0) {
                foreach ($_GET['SubscribeCheck'] as $column => $value) {
                    foreach ($value as $id => $val) {
                        Subscribe::model()->updateByPk((int)$id, array($column => (int)$val));
                    }
                }
                Yii::app()->end();
            }

        return parent::beforeAction($action);
    }
}


