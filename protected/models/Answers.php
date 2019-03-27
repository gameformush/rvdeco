<?
class Answers extends CActiveRecord
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
            array('created, next_select_questionss, isrequare_checkbox, finish_checkbox, qid_text', 'numerical', 'integerOnly'=>true),
            array('type_select_5', 'length', 'max'=>255),
            array('name_text', 'length', 'max'=>255),
            array('group_text', 'length', 'max'=>255),
            array('code_text', 'length', 'max'=>255),
            array('kind_select_kind', 'length', 'max'=>255),
            array('price_text', 'length', 'max'=>255),
            array('info_bigtext', 'length', 'max'=>2000),
            array('message_bigtexteditor', 'length', 'max'=>2000),
            array('postfix_text', 'length', 'max'=>255),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'created' => 'Дата создания',
            'type_select_5' => 'Type',
            'name_text' => 'Title',
            'group_text' => 'Group',
            'code_text' => 'Code',
            'isrequire_checkbox' => 'Is require',
            'kind_select_kind' => 'Kind',
            'price_text' => 'Price',
            'info_bigtext' => 'Info',
            'message_bigtexteditor' => 'Message',
            'hidden_nexttable_answers' => 'Answers',
            'hidden_nexttable_products' => 'Products',
            'postfix_text' => 'Postfix',
            'hidden_nexttable_questionss' => 'Questions',
            'next_select_questionss' => 'Идёт после',
            'isrequare_checkbox' => 'Is requare',
            'finish_checkbox' => 'Конец секции',
            'weight_text' => 'Порядковый номер',
            'hidden_nexttable_questionss' => 'Questions2',
            'qid_text' => 'Кому принадлежит',
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