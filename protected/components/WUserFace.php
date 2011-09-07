<?php
class WUserFace extends CWidget
{
	public $uid = '';
    public $size = '48';

	/**
	 * @author :majc
	 * 页面渲染
	 */
	public function run()
	{
		$user = User::model()->findByPk($this->uid);
        
        //男或女
		if( !$user['sex'] ) {
			$default_img = SUB_DOMAIN.Yii::app()->theme->baseUrl."/images/pic2.gif";
		}else {
			$default_img = SUB_DOMAIN.Yii::app()->theme->baseUrl."/images/pic1.gif";
		}
        $url = Yii::app()->controller->createUrl('/space',array('uid'=>$this->uid));

        echo '<span class="headpic50"><a href="'.$url.'">';
        $this->widget('ext.yii-gravatar.YiiGravatar', array(
            'email'=>$user['email'],
            'size'=>$this->size,
            'defaultImage'=>'http://www.amsn-project.net/images/download-linux2.png',
            'defaultImage'=>'http://'.$default_img,
            'secure'=>false,
            'rating'=>'r',
            'emailHashed'=>false,
            'htmlOptions'=>array(
                'alt'=>$user['username'],
                'title'=>$user['username'],
            )
        ));
        echo '</a></span>';

	}
}
