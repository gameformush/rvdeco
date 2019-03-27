<?php

class ProductsController extends Controller {

    public function actionIndex() {
		$this->pageTitle = "Les produits";
		
		$model = Products::model()->findAll();
		$this->render('index', array('model' => $model));		
    }
	public function actionShow($id) {
		$model = Products::model()->findByPk($id);
		$this->pageTitle = $model->title_text;
		$this->render('show', array('model' => $model));		
    }
	
}

?>