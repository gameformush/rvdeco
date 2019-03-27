<?
class Questionss extends CActiveRecord
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
		return 'questionss';
	}
	
	public function getNiceDate() {
		return date( 'd.m.Y', $this->created );
	}

	
public function rules()
	{
		return array(
			array('created, finish_checkbox, qid_select_questionss', 'numerical', 'integerOnly'=>true),
			array('type_select_12, name_text, rod_select_kind, price_text, postfix_text, weight_text, info_bigtext, messagetext_text, products_text, next_select_questionss', 'length', 'max'=>255),
			array('message_bigtexteditor', 'length', 'max'=>3055),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created' => 'Дата создания',
			
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