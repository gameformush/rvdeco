<?php

class Students extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Ученики';
	}

	public function tableName()
	{
		return 'students';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('fam_text, name_text, otchestvo_text', 'required'),
			array('created_at', 'numerical', 'integerOnly'=>true),
			array('fam_text, name_text, otchestvo_text, age_text, gruppa_select_groups, tema_text, uchitel_select_teachers, office_select_offices, cena_text, dolg_text, dr_calendar, pol_select, rodfio_text, 	phone_text, email_text, rejim_select, propusk_select', 'length', 'max'=>255),
			array('primechanie_bigtext', 'length', 'max'=>1000)
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
			'fam_text' => 'Фамилия',
			'name_text' => 'Имя',
			'otchestvo_text' => 'Отчество',
			'age_text' => 'Возраст',
			'gruppa_select_groups' => 'Группа',
			'tema_text' => 'Тема урока',
			'uchitel_select_teachers' => 'Учитель',
			'office_select_offices' => 'Офис',
			'cena_text' => 'Стоимость',
			'dolg_text' => 'Долг/Переплата',
			'created_at' => 'Дата',
			'dr_calendar' => 'Дата рождения',
			'pol_select' => 'Пол ребенка',
			'rodfio_text' => 'ФИО родителей',
			'phone_text' => 'Телефон',
			'email_text' => 'Электронная почта',
			'rejim_select' => 'Режим оплаты',
			'propusk_select' => 'Условия пропусков',
			'primechanie_bigtext' => 'Особые примечания'
		);
	}
}