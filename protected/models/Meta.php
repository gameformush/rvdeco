<?php
/**
 * Модель для таблицы "sys_Meta".
 *
 * Поля:
 * @property integer $id
 * @property integer $parent_id
 * @property string $module
 * @property string $lang
 * @property string $title
 * @property string $keywords
 * @property string $description
 */
class Meta extends CActiveRecord {
    /**
     * @return Meta the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string title of model
     */
    public static function modelTitle() {
        return 'Meta';
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_Meta';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('parent_id, module, lang', 'required'),
            array('parent_id', 'numerical', 'integerOnly' => true),
            array('module', 'length', 'max' => 20),
            array('lang', 'length', 'max' => 4),
            array('title, keywords, description, title_kaz, keywords_kaz, description_kaz', 'length', 'max' => 255),
            array('id, parent_id, module, lang, title, title_kaz, keywords, keywords_kaz, description, description_kaz', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parent_id' => 'Верхний уровень',
            'module' => 'Module',
            'lang' => 'Lang',
            'title' => 'Заголовок RU',
			'title_kaz' => 'Заголовок KZ',
            'keywords' => 'Ключевые слова RU',
			'keywords_kaz' => 'Ключевые слова KZ',
            'description' => 'Мета-описание RU',
			'description_kaz' => 'Мета-описание KZ',
        );
    }

    /**
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('module', $this->module, true);
        $criteria->compare('lang', $this->lang, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('keywords', $this->keywords, true);
        $criteria->compare('description', $this->description, true);
		$criteria->compare('title_kaz', $this->title_kaz, true);
        $criteria->compare('keywords_kaz', $this->keywords_kaz, true);
        $criteria->compare('description_kaz', $this->description_kaz, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeValidate() {
        return true;
    }

    /**
     * @return array of model options
     */
    public function options() {
        return array();
    }
}