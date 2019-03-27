<?php
/**
 * User: strannik
 * Date: 13.09.2010
 * Time: 16:06:46
 */

class SHelper {

    static function authUser(){        
        if (Yii::app()->user->isGuest){
            if(Yii::app()->request->isAjaxRequest) exit;
            Yii::app()->request->redirect(CHtml::normalizeUrl(array('/site/login', 'returnUrl' => str_replace('/', '|', $_SERVER['REQUEST_URI']))));
        }
        else return Yii::app()->user->getId();

    }
}
