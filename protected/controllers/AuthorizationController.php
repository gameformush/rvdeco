<?php
class AuthorizationController extends Controller
{
	public function actionIndex() {	
		$this->pageTitle = "Авторизация";
		$this->render('index');
	}
}
