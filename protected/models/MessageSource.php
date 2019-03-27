<?php

class MessageSource extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'sys_SourceMessage':
     * @var integer $id
     * @var string $category
     * @var string $message
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'sys_SourceMessage';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
        );
    }
    public function defaultScope(){
        return array(
            'order'=>'message'
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'messages' => array(self::HAS_MANY, 'Message', 'id'),
            'category' => array(self::BELONGS_TO, 'MessageCategory', 'category'),

        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'category' => 'Категория',
            'message' => 'Сообщение',
        );
    }
}