<?php

class Cronos__Validations extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Валидаторы';
	}

	public function tableName()
	{
		return 'cronos__validations';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created );
    }

	public function rules()
	{
		return array(
			array('name-text', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('config-bigtext', 'length', 'max'=>2000),
		);
	}

	public function relations ()
	{
		return array ();
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name-text' => 'Название',
			'config-bigtext' => 'Конфигуратор',
			'created' => 'Дата создания',
		);
	}
	
	public function beforeValidate() {
		if ($this->created==0) {
			$this->created=time();	
		}
		if (strstr($this->created,'-')) {
				$date=explode('-',$this->created);
				$minute = $hour = 0;
				if(isset($_POST['_time']['created'])){
					$time = explode(':',$_POST['_time']['created']);
					$hour = (int)$time[0];
					$minute = (int)$time[1];
				}
				$this->created=mktime( $hour, $minute, 0, $date[1], $date[0], $date[2] );
		}
        return true;
    }
}