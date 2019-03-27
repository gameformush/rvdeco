<?php

class Activity extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Уведомления';
	}

	public function tableName()
	{
		return 'activity';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('user_id, type', 'required'),
			array('created_at, status, user_id', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Пользователь',
			'type' => 'Тип',
			'status' => 'Статус',
			'created_at' => 'Дата создания',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
        $pagination = array('ActivitySize'=> 30);
        return new CActiveDataProvider($this,array(
            'criteria'   => $criteria,
            'pagination' => $pagination
        ));
	}
    
    public function beforeValidate() {
		if ($this->created_at==0) {
			$this->created_at=time();	
		}
		if (strstr($this->created_at,'-')) {
				$date=explode('-',$this->created_at);
				$minute = $hour = 0;
				if(isset($_POST['_time']['created_at'])){
					$time = explode(':',$_POST['_time']['created_at']);
					$hour = (int)$time[0];
					$minute = (int)$time[1];
				}
				$this->created_at=mktime( $hour, $minute, 0, $date[1], $date[0], $date[2] );
		}
        return true;
    }
    public function defaultScope() {
        return array(
            'order' => 'created_at DESC',
        );
    }


    
}