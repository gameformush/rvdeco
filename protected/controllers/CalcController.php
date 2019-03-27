<?php

class CalcController extends Controller {

    public function actionIndex() {
		$this->pageTitle = "Chiffrage immédiat";
		
		$model = Calc::model()->findAll("status_select_2 = 'Активный'");
		$this->render('index', array('model' => $model));		
    }
}

?>