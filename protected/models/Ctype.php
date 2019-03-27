<?php
/**
 * Модель для таблицы "data_Ctype".
 *
 * Поля:
 * @property integer $id
 * @property integer $weight
 * @property string $title
 * @property integer $status
 */
class Ctype extends CActiveRecord
{
	/**
	 * @return Ctype the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string title of model
	 */
	public static function modelTitle()
	{
		return 'Специализации';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_Ctype';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('title', 'required'),
			array('weight, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('id, weight, title, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'childClub'=>array( self::HAS_MANY, 'Club', 'parent_Сtype_id'),
			'count'=>array(self::HAS_MANY,'Club','parent_Сtype_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'weight' => 'Порядок',
			'title' => 'Название',
			'status' => 'Видимость',
		);
	}

	/**
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('status',$this->status);
        $pagination = array('pageSize'=> 30);
        return new CActiveDataProvider($this,array(
            'criteria'   => $criteria,
            'pagination' => $pagination
        ));
	}
    
    public function beforeValidate() {
        return true;
    }
    public function defaultScope() {
        return array(
            'order' => 'weight',
        );
    }
        
    /**
	 * @return array of model options
	 */     
	public function options()
	{
        return array();
	}

    
}