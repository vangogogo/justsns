<?php
/**
 * CActiveForm class file.
 */

class YiicmsActiveForm extends CActiveForm
{
	public function textField($model,$attribute,$htmlOptions=array())
	{
        if(empty($htmlOptions['class']))
        {
            $htmlOptions['class'] = 't_input';
        }
		return CHtml::activeTextField($model,$attribute,$htmlOptions);
	}

}

