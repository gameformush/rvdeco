<?php

class CronosFields extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Поля';
	}

	public function tableName()
	{
		return 'cronosfields';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('label_text', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('base_select_cronoscontents, label_text, name_text, type_text, validation_select_validations, created', 'length', 'max'=>255),
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
			'base_select_cronoscontents' => 'База данных',
			'label_text' => 'Название',
			'name_text' => 'Имя',
			'type_text' => 'Тип',
			'validation_select_validations' => 'Валидация',
			'created' => 'Дата создания'
		);
	}
}