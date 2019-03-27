<?php

class GalleryController extends Controller {

    public function actionIndex() {
		$this->pageTitle = "Nos réalisations";
		
		$model = Gallery::model()->findAll();
		$this->render('index', array('model' => $model));		
    }
	public function actionShow($id) {
		$model = Gallery::model()->findByPk($id);
		$all = Gallery::model()->findAll();
		$this->pageTitle = $model->title_text;
		$this->render('show', array('model' => $model, 'all' => $all));		
    }
}

?>