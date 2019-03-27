<?php

class Users extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function modelTitle()
	{
		return 'Сотрудники';
	}

	public function tableName()
	{
		return 'users';
	}
	
    public function getNiceDate() {
        return date( 'd.m.Y', $this->created_at );
    }

	public function rules()
	{
		return array(
			array('login, password, first_name, last_name, department, position, level_id', 'required'),
			array('created_at, status, level_id', 'numerical', 'integerOnly'=>true),
			array('login, password, first_name, last_name, position, image, mobile_phone, city_phone', 'length', 'max'=>255),
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
			'login' => 'Логин',
			'password' => 'Пароль',
			'vn_phone' => 'Внутренний телефон',
			'first_name' => 'Имя',
			'last_name' => 'Фамилия',
			'position' => 'Должность',
			'image' => 'Фотография',
			'created_at' => 'Дата создания',
			'department' => 'Отдел',
			'mobile_phone' => 'Мобильный телефон',
			'city_phone' => 'Городской телефон',
			'status' => 'Видимость',
			'level_id' => 'Уровень доступа',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('status',$this->status);
        $pagination = array('UsersSize'=> 30);
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

    public function beforeDelete(){
        $option  = $this->options();
        foreach ($option['images'] as $type=>$size){  
                      
            if(is_file('upload/'.__CLASS__.'/'.$type.'/'.$this->image)){
                unlink('upload/'.__CLASS__.'/'.$type.'/'.$this->image);
            }
        }
        return true;
    }  
	
	public function options()
	{
        return array(
            'images' => array(
                'full' => array(
                    'width' => 600,
                    'height' => 600,
                    'type' => 'resize'
                ),
            
                'sm' => array(
                    'width' => 200,
                    'height' => 200,
                    'type' => 'resize'
                ),
            )
        );
	}
    
}