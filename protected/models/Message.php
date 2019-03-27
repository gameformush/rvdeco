<?php

class Message extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'sys_Message':
     * @var integer $id
     * @var string $language
     * @var string $translation
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
        return 'sys_Message';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('language', 'length', 'max' => 16),
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
            'source' => array(self::BELONGS_TO, 'MessageSource', 'id'),
            'language' => array(self::BELONGS_TO, 'Language', 'language'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Id',
            'language' => 'Язык',
            'translation' => 'Перевод',
        );
    }

    public function lang($lang = 'en')
    {
        //        $this->getDbCriteria()->mergeWith(array(
        //           // 'condition'=>"language='$lang'",
        //        ));
        return $this;
    }
}