<?php

class SessionController extends RController
{

    public function actionLogin()
    {
        $id = Yii::app()->request->getParam('id');
        $title = Yii::app()->request->getParam('title');


        Yii::log('Пользователь "' . Yii::app()->user->name . '" входит под именем компании <a href="/admin/session/history/id/'.$id.'">"'.$title.'"</a>', 'event', 'root.addSession');
        $db = Yii::app()->db;
        $sid =md5(Yii::app()->user->id.'-addY11-Sessions');
        $params = array(
            'id' => $sid,
            'created_at' => time(),
            'ended_at' => time() + 3600,
            'status' => 1,
            'parent_User_id' => $id,
            'title' => $title,
            'name'=>Yii::app()->user->name
        );
        if((int)$db->createCommand("select count(id) from sys_Session where id='$sid'")->queryScalar()>0){
            $db->createCommand()->update('sys_Session',$params,'id=:sid',array(':sid'=>$sid));
        }else{            
            $db->createCommand()->insert('sys_Session',$params);
        }

        Yii::app()->user->setState('rootState', $sid);

        $this->redirect('/account.html');
    }

    public function actionError()
    {
        $this->render('error');
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionLogout()
    {
        $t=Yii::app()->user->name;
        $id = Yii::app()->request->getParam('sid');
        Yii::app()->db->getDb()->session->update(array('_id' => new MongoId($id)), array('$set' => array('status' => 0)));

        Yii::app()->user->setState('rootState', null);

        $user = Profile::model()->findByPk(Yii::app()->user->getId(), array('name' => 1, 'companyTitle' => 1, 'companyType' => 1, 'nickname' => 1));
        Yii::app()->user->name = $user->title;
        Yii::log('Пользователь "' . Yii::app()->user->name . '" вышел из ЛК компании <a href="/admin/session/history/id/'.$id.'">"'.$t.'"</a>', 'event', 'root.removeSession');
        if (strstr($_SERVER['HTTP_REFERER'], $_SERVER['REQUEST_URI']) === false) {
            $this->redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->redirect('/');
        }

        //
        //		$this->redirect('/profile.html');
    }


}