<?php

class CronosSelects extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Списки SELECT';
	}

	public function tableName()
	{
		return 'cronosselects';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created);
    }

	public function rules()
	{
		return array(
			array('title_text', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('title_text', 'length', 'max'=>255),
			array('spisok_bigtext', 'length', 'max'=>2000),
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
			'title_text' => 'Название',
			'spisok_bigtext' => 'Список',
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