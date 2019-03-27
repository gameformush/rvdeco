<?php

class Departments extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Отделы';
	}

	public function tableName()
	{
		return 'departments';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('title', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
		);
	}

	public function relations()
	{
		return array( );
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'parent_id' => 'Управляющий',
		);
	}

	public function search()
	{
		return array();
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
            'order' => 'id ASC',
        );
    }

}