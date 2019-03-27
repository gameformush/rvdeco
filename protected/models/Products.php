<?
class Products extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	public static function modelTitle()
	{
		return {{title_model}};
	}
	*/
	
	public function tableName()
	{
		return 'products';
	}
	
	public function getNiceDate() {
		return date( 'd.m.Y', $this->created );
	}

	public function rules()
	{
		return array(
			array('created', 'numerical', 'integerOnly'=>true),
			array('title_text', 'length', 'max'=>255),
			array('image_image', 'length', 'max'=>255),
			array('images_pimages', 'length', 'max'=>2000),
			array('description_bigtext', 'length', 'max'=>2000),
			array('params_bigtexteditor', 'length', 'max'=>2000),
			array('cena_text', 'length', 'max'=>255),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Дата создания',
			'title_text' => 'Заголовок',
			'image_image' => 'Изображение',
			'images_pimages' => 'Картинки',
			'description_bigtext' => 'Описание',
			'params_bigtexteditor' => 'Параметры',
			'cena_text' => 'Цена',

		);
	}
	
	public function beforeValidate() {
		if ($this->created==0) {
			$this->created=time();	
		}
		if (strstr($this->created,'-')) {
				$date=explode('-',$this->created);
				$minute = $hour = 0;
				if(isset($_POST['_time']['created'])){
					$time = explode(':',$_POST['_time']['created']);
					$hour = (int)$time[0];
					$minute = (int)$time[1];
				}
				$this->created=mktime( $hour, $minute, 0, $date[1], $date[0], $date[2] );
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
                    'type' => 'crop'
                ),
                'tm' => array(
                    'width' => 300,
                    'height' => 300,
                    'type' => 'crop'
                ),
				 'table' => array(
                    'width' => 50,
                    'height' => 50,
                    'type' => 'crop'
                ),
            )
        );
	}
}
?>