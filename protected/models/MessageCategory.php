<?php

class MessageCategory extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'sys_SourceMessageCategory':
     * @var string $name
     * @var string $title
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
        return 'sys_SourceMessageCategory';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'length', 'max' => 20),
            array('title', 'length', 'max' => 30),
            array('name, title', 'required'),
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
            'sys_SourceMessages' => array(self::HAS_MANY, 'SysSourceMessage', 'category'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Name',
            'title' => 'Title',
        );
    }
}