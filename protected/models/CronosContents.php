<?php

class CronosContents extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Разделы';
	}

	public function tableName()
	{
		return 'cronoscontents';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created );
    }

	public function rules()
	{
		return array(
			array('url_text, title_text, name_text', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('url_text, title_text, name_text, cash_select, status_select_2', 'length', 'max'=>255),
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
			'url_text' => 'URL',
			'title_text' => 'Название',
			'name_text' => 'Имя модели',
			'fields_hidden_full' => 'Набор полей',
			'cash_select' => 'Кеширование',
			'status_select_2' => 'Статус',
			'created' => 'Дата создания'
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