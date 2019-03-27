<?
class Feedback extends CActiveRecord
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
		return 'feedback';
	}
	
	public function getNiceDate() {
		return date( 'd.m.Y', $this->created );
	}

	public function rules()
	{
		return array(
            array('name_text, email_text, message_bigtext', 'required'),
			array('created', 'numerical', 'integerOnly'=>true),
			array('contacts_bigtexteditor', 'length', 'max'=>2000),
			array('name_text', 'length', 'max'=>255),
			array('email_text', 'length', 'max'=>255),
			array('message_bigtext', 'length', 'max'=>2000),
            array('name_text, email_text, message_bigtext', 'safe'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Дата создания',
			'name_text' => 'Имя',
			'email_text' => 'E-Mail',
			'message_bigtext' => 'Сообщение',
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