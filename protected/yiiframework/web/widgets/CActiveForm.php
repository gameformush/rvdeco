<?php
/**
 * CActiveForm class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

class CActiveForm extends CWidget
{
	/**
	 * @var mixed the form action URL (see {@link CHtml::normalizeUrl} for details about this parameter).
	 * If not set, the current page URL is used.
	 */
	public $action='';
	/**
	 * @var string the form submission method. This should be either 'post' or 'get'.
	 * Defaults to 'post'.
	 */
	public $method='post';
	/**
	 * @var boolean whether to generate a stateful form (See {@link CHtml::statefulForm}). Defaults to false.
	 */
	public $stateful=false;
	/**
	 * @var string the CSS class name for error messages. Defaults to 'errorMessage'.
	 * Individual {@link error} call may override this value by specifying the 'class' HTML option.
	 */
	public $errorMessageCssClass='label label-danger label-block';
	/**
	 * @var array additional HTML attributes that should be rendered for the form tag.
	 */
	public $htmlOptions=array();
	
	public $clientOptions=array();
	/**
	 * @var boolean whether to enable data validation via AJAX. Defaults to false.
	 * When this property is set true, you should respond to the AJAX validation request on the server side as shown below:
	 * <pre>
	 * public function actionCreate()
	 * {
	 *     $model=new User;
	 *     if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
	 *     {
	 *         echo CActiveForm::validate($model);
	 *         Yii::app()->end();
	 *     }
	 *     ......
	 * }
	 * </pre>
 	 */
	public $enableAjaxValidation=false;
	/**
	 * @var boolean whether to enable client-side data validation. Defaults to false.
	 *
	 * When this property is set true, client-side validation will be performed by validators
	 * that support it (see {@link CValidator::enableClientValidation} and {@link CValidator::clientValidateAttribute}).
	 *
	 * @see error
	 * @since 1.1.7
	 */
	public $enableClientValidation=false;

	/**
	 * @var mixed form element to get initial input focus on page load.
	 *
	 * Defaults to null meaning no input field has a focus.
	 * If set as array, first element should be model and second element should be the attribute.
	 * If set as string any jQuery selector can be used
	 *
	 * Example - set input focus on page load to:
	 * <ul>
	 * <li>'focus'=>array($model,'username') - $model->username input filed</li>
	 * <li>'focus'=>'#'.CHtml::activeId($model,'username') - $model->username input field</li>
	 * <li>'focus'=>'#LoginForm_username' - input field with ID LoginForm_username</li>
	 * <li>'focus'=>'input[type="text"]:first' - first input element of type text</li>
	 * <li>'focus'=>'input:visible:enabled:first' - first visible and enabled input element</li>
	 * <li>'focus'=>'input:text[value=""]:first' - first empty input</li>
	 * </ul>
	 *
	 * @since 1.1.4
	 */
	public $focus;
	/**
	 * @var array the javascript options for model attributes (input ID => options)
	 * @see error
	 * @since 1.1.7
	 */
	protected $attributes=array();
	/**
	 * @var string the ID of the container element for error summary
	 * @see errorSummary
	 * @since 1.1.7
	 */
	protected $summaryID;

	/**
	 * Initializes the widget.
	 * This renders the form open tag.
	 */
	public function init()
	{
		if(!isset($this->htmlOptions['id']))
			$this->htmlOptions['id']=$this->id;
		if($this->stateful)
			echo CHtml::statefulForm($this->action, $this->method, $this->htmlOptions);
		else
			echo CHtml::beginForm($this->action, $this->method, $this->htmlOptions);
	}

	/**
	 * Runs the widget.
	 * This registers the necessary javascript code and renders the form close tag.
	 */
	public function run()
	{
		if(is_array($this->focus))
			$this->focus="#".CHtml::activeId($this->focus[0],$this->focus[1]);

		echo CHtml::endForm();
		$cs=Yii::app()->clientScript;
		if(!$this->enableAjaxValidation && !$this->enableClientValidation || empty($this->attributes))
		{
			if($this->focus!==null)
			{
				$cs->registerCoreScript('jquery');
				$cs->registerScript('CActiveForm#focus',"
					if(!window.location.hash)
						$('".$this->focus."').focus();
				");
			}
			return;
		}

		$options=$this->clientOptions;
		if(isset($this->clientOptions['validationUrl']) && is_array($this->clientOptions['validationUrl']))
			$options['validationUrl']=CHtml::normalizeUrl($this->clientOptions['validationUrl']);

		$options['attributes']=array_values($this->attributes);

		if($this->summaryID!==null)
			$options['summaryID']=$this->summaryID;

		if($this->focus!==null)
			$options['focus']=$this->focus;

		$options=CJavaScript::encode($options);
		$cs->registerCoreScript('yiiactiveform');
		$id=$this->id;
		$cs->registerScript(__CLASS__.'#'.$id,"\$('#$id').yiiactiveform($options);");
	}


	public function error($model,$attribute,$htmlOptions=array(),$enableAjaxValidation=true,$enableClientValidation=true)
	{
		if(!$this->enableAjaxValidation)
			$enableAjaxValidation=false;
		if(!$this->enableClientValidation)
			$enableClientValidation=false;

		if(!isset($htmlOptions['class']))
			$htmlOptions['class']=$this->errorMessageCssClass;

		if(!$enableAjaxValidation && !$enableClientValidation)
			return CHtml::error($model,$attribute,$htmlOptions);

		$id=CHtml::activeId($model,$attribute);
		$inputID=isset($htmlOptions['inputID']) ? $htmlOptions['inputID'] : $id;
		unset($htmlOptions['inputID']);
		if(!isset($htmlOptions['id']))
			$htmlOptions['id']=$inputID.'_em_';

		$option=array(
			'id'=>$id,
			'inputID'=>$inputID,
			'errorID'=>$htmlOptions['id'],
			'model'=>get_class($model),
			'name'=>$attribute,
			'enableAjaxValidation'=>$enableAjaxValidation,
		);

		$optionNames=array(
			'validationDelay',
			'validateOnChange',
			'validateOnType',
			'hideErrorMessage',
			'inputContainer',
			'errorCssClass',
			'successCssClass',
			'validatingCssClass',
			'beforeValidateAttribute',
			'afterValidateAttribute',
		);
		foreach($optionNames as $name)
		{
			if(isset($htmlOptions[$name]))
			{
				$option[$name]=$htmlOptions[$name];
				unset($htmlOptions[$name]);
			}
		}
		if($model instanceof CActiveRecord && !$model->isNewRecord)
			$option['status']=1;

		if($enableClientValidation)
		{
			$validators=isset($htmlOptions['clientValidation']) ? array($htmlOptions['clientValidation']) : array();
			foreach($model->getValidators($attribute) as $validator)
			{
				if($enableClientValidation && $validator->enableClientValidation)
				{
					if(($js=$validator->clientValidateAttribute($model,$attribute))!='')
						$validators[]=$js;
				}
			}
			if($validators!==array())
				$option['clientValidation']="js:function(value, messages, attribute) {\n".implode("\n",$validators)."\n}";
		}

		$html=CHtml::error($model,$attribute,$htmlOptions);
		if($html==='')
		{
			if(isset($htmlOptions['style']))
				$htmlOptions['style']=rtrim($htmlOptions['style'],';').';display:none';
			else
				$htmlOptions['style']='display:none';
			$html=CHtml::tag('div',$htmlOptions,'');
		}

		$this->attributes[$inputID]=$option;
		return $html;
	}

	public function errorSummary($models,$header=null,$footer=null,$htmlOptions=array())
	{
		if(!$this->enableAjaxValidation && !$this->enableClientValidation)
			return CHtml::errorSummary($models,$header,$footer,$htmlOptions);

		if(!isset($htmlOptions['id']))
			$htmlOptions['id']=$this->id.'_es_';
		$html=CHtml::errorSummary($models,$header,$footer,$htmlOptions);
		if($html==='')
		{
			if($header===null)
				$header='<p>'.Yii::t('yii','Please fix the following input errors:').'</p>';
			if(!isset($htmlOptions['class']))
				$htmlOptions['class']=CHtml::$errorSummaryCss;
			$htmlOptions['style']=isset($htmlOptions['style']) ? rtrim($htmlOptions['style'],';').';display:none' : 'display:none';
			$html=CHtml::tag('div',$htmlOptions,$header."\n<ul><li>dummy</li></ul>".$footer);
		}

		$this->summaryID=$htmlOptions['id'];
		return $html;
	}

	public function label($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeLabel($model,$attribute,$htmlOptions);
	}


	public function labelEx($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeLabelEx($model,$attribute,$htmlOptions);
	}


	public function textField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeTextField($model,$attribute,$htmlOptions);
	}

	public function hiddenField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeHiddenField($model,$attribute,$htmlOptions);
	}

	public function passwordField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activePasswordField($model,$attribute,$htmlOptions);
	}

	public function textArea($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeTextArea($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a file field for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeFileField}.
	 * Please check {@link CHtml::activeFileField} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes
	 * @return string the generated input field
	 */
	public function fileField($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeFileField($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a radio button for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeRadioButton}.
	 * Please check {@link CHtml::activeRadioButton} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated radio button
	 */
	public function radioButton($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeRadioButton($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a checkbox for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeCheckBox}.
	 * Please check {@link CHtml::activeCheckBox} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated check box
	 */
	public function checkBox($model,$attribute,$htmlOptions=array())
	{
		return CHtml::activeCheckBox($model,$attribute,$htmlOptions);
	}

	/**
	 * Renders a dropdown list for a model attribute.
	 * This method is a wrapper of {@link CHtml::activeDropDownList}.
	 * Please check {@link CHtml::activeDropDownList} for detailed information
	 * about the parameters for this method.
	 * @param CModel $model the data model
	 * @param string $attribute the attribute
	 * @param array $data data for generating the list options (value=>display)
	 * @param array $htmlOptions additional HTML attributes.
	 * @return string the generated drop down list
	 */
	public function dropDownList($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
	}


	public function listBox($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeListBox($model,$attribute,$data,$htmlOptions);
	}


	public function checkBoxList($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeCheckBoxList($model,$attribute,$data,$htmlOptions);
	}


	public function radioButtonList($model,$attribute,$data,$htmlOptions=array())
	{
		return CHtml::activeRadioButtonList($model,$attribute,$data,$htmlOptions);
	}

	public static function validate($models, $attributes=null, $loadInput=true)
	{
		$result=array();
		if(!is_array($models))
			$models=array($models);
		foreach($models as $model)
		{
			if($loadInput && isset($_POST[get_class($model)]))
				$model->attributes=$_POST[get_class($model)];
			$model->validate($attributes);
			foreach($model->getErrors() as $attribute=>$errors)
				$result[CHtml::activeId($model,$attribute)]=$errors;
		}
		return function_exists('json_encode') ? json_encode($result) : CJSON::encode($result);
	}
}