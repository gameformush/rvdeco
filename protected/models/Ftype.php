<?php
/**
 * Модель для таблицы "data_Ftype".
 *
 * Поля:
 * @property integer $id
 * @property integer $weight
 * @property string $title
 * @property integer $status
 */
class Ftype extends CActiveRecord
{
	/**
	 * @return Ftype the static model class
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
		return 'Темы вопросов';
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'data_Ftype';
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
			'childFaq'=>array( self::HAS_MANY, 'Faq', 'parent_Ftype_id'),
			'count'=>array(self::HAS_MANY,'Faq','parent_Ftype_id')
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

	public function getFaqCount(){
		$count = Faq::model()->count("status='1' AND parent_Ftype_id='".$this->id."' AND answer<>''");
		if (Yii::app()->controller->padej($count) == 1) {
			return $count.' вопрос';
		}
		else if (Yii::app()->controller->padej($count) == 2) {
			return $count.' вопроса';
		}
		else {
			return $count.' вопросов';
		}
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