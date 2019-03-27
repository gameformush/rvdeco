<?php

class Customers extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Клиенты';
	}

	public function tableName()
	{
		return 'customers';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('fio, phone', 'required'),
			array('created_at', 'numerical', 'integerOnly'=>true),
			array('fio, phone, address, email, city, index, birthday', 'length', 'max'=>255),
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
			'fio' => 'Ф.И.О',
			'phone' => 'Номер телефона',
			'created_at' => 'Дата создания',
			'city' => 'Город',
			'address' => 'Адрес',
			'email' => 'Электронная почта',
			'index' => 'Индекс',
			'birthday' => 'День рождения',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
        $pagination = array('CustomersSize'=> 30);
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