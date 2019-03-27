<?
class Calcitem extends CActiveRecord
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
		return 'calcitem';
	}
	
	public function getNiceDate() {
		return date( 'd.m.Y', $this->created_calendar );
	}

	public function rules()
	{
		return array(
			array('created_calendar', 'numerical', 'integerOnly'=>true),
			array('name_text, name2_text', 'length', 'max'=>255),
			array('info_bigtexteditor', 'length', 'max'=>2000),
			array('calcitem_select_2', 'length', 'max'=>255),
			array('rod_select_calc', 'length', 'max'=>255),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_calendar' => 'Дата создания',
			'name_text' => 'Название',
			'info_bigtexteditor' => 'Инфо',
			'calcitem_select_2' => 'Статус',
			'rod_select_calc' => 'Родитель',
			'name2_text' => 'Второе название'

		);
	}
	
    public function beforeValidate() {
        if ($this->created_calendar==0) {
            $this->created_calendar=time();
        }
        if (strstr($this->created_calendar,'-')) {
            $date=explode('-',$this->created);
            $minute = $hour = 0;
            if(isset($_POST['_time']['created_calendar'])){
                $time = explode(':',$_POST['_time']['created_calendar']);
                $hour = (int)$time[0];
                $minute = (int)$time[1];
            }
            $this->created_calendar=mktime( $hour, $minute, 0, $date[1], $date[0], $date[2] );
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