<?php
class SysSettingController extends RController
{
    public $type = null;

    /**
     * Manages all models.
     */
    public function actionIndex()
    {
        $model = new SysSetting('search');
        $model->unsetAttributes();
        $type = Yii::app()->request->getParam('type');
        if ($type) {
            if ($type === 'all') {
                Yii::app()->user->setState('_type_SysSetting', null);
            } else {
                Yii::app()->user->setState('_type_SysSetting', $type);
            }
        }
        $this->type = Yii::app()->user->getState('_type_SysSetting');
        if ($this->type) $model->type = $this->type;


        if (isset($_GET['SysSetting'])) {
            $model->attributes = $_GET['SysSetting'];
        }
        if (isset($_GET['_filter'])) {
            Yii::app()->user->setState('_filter_SysSetting', $_GET['_filter']);
        }
        if (Yii::app()->user->hasState('_filter_SysSetting')) {
            $model->attributes = Yii::app()->user->getState('_filter_SysSetting');
            $this->filter = $model->attributes;
        }

        if (isset($_GET['ajax'])) {
            if ($_GET['ajax'] == 'state') {
                if ($_GET['SysSetting']) {
                    foreach ($_GET['SysSetting'] as $column => $value) {
                        foreach ($value as $id => $val) {
                            SysSetting::model()->updateByPk((int)$id, array($column => (int)$val));
                        }
                    }
                }
            } else {
                $this->renderPartial('_grid', array(
                    'model' => $model,
                ));
            }
        }
        else
        {
            $this->render('index', array(
                'model' => $model,
            ));
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     */
    public function actionCreate()
    {
        $model = new SysSetting;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['SysSetting'])) {
            $model->attributes = $_POST['SysSetting'];
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('flashMessage', array('type' => 'notice', 'text' => 'Сохранено'));
                $this->redirect(array('index'));
            } else {
                Yii::app()->user->setFlash('flashMessage', array('type' => 'error', 'text' => 'Ошибка при сохранении'));
            }
        }else{
            $model->type=Yii::app()->user->getState('_type_SysSetting');
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $this->performAjaxValidation($model);

        $page = (int)Yii::app()->request->getParam('SysSetting_page');

        if (isset($_POST['SysSetting'])) {
            $model->attributes = $_POST['SysSetting'];
            if ($model->save()) {
                $this->saveMeta($model, $_POST['_meta']);
                Yii::app()->user->setFlash('flashMessage', array('type' => 'notice', 'text' => 'Сохранено'));
                $this->redirect(array('index', 'SysSetting_page' => $page));
            } else {
                Yii::app()->user->setFlash('flashMessage', array('type' => 'error', 'text' => 'Ошибка при сохранении'));
            }
        }
        $this->render('update', array(
            'model' => $model, 'page' => $page
        ));
    }

    public function actionDelete()
    {
        $id = Yii::app()->request->getQuery('id');
        $ids = Yii::app()->request->getPost('ids');
        if (Yii::app()->request->isPostRequest) {
            if (count($ids) > 0) {
                foreach ($ids as $val) {
                    $this->loadModel($val['value'])->delete();
                }
            }
            else
                $this->loadModel($id)->delete();
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        }
        else
        {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = SysSetting::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-setting-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
