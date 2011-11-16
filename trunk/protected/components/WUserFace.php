<?php
class WUserFace extends CWidget
{
	public $uid = '';
    public $size = 'small';
    public $user;

	/**
	 * @author :majc
	 * 页面渲染
	 */
	public function run()
	{
        if(empty($this->user))
        {
		    $user = User::model()->findByPk($this->uid);
        }
        else
        {
            $user=$this->user;
        }

        $avatar = $user->profile->avatar;
        $name = $user->profile->name;

        $url = Yii::app()->controller->createUrl('/space/index',array('uid'=>$this->uid));
        $span_class = $this->size=='small'?'headpic50':'';
        if(!empty($avatar))
        {
            if($this->size != 'small')
            {
                $avatar = str_replace('/50/','/180/',$avatar);
            }
        }
        else
        {
            //男或女
		    if($user->profile->sex == 1) {
			    $avatar = 'http://'.SUB_DOMAIN.Yii::app()->theme->baseUrl."/images/pic1.gif";
		    }else {
			    $avatar = 'http://'.SUB_DOMAIN.Yii::app()->theme->baseUrl."/images/pic2.gif";
		    }
        }
        echo '<span class="media-grid"><a href="'.$url.'">';
        echo "<img class='thumbnail {$this->size}' src='{$avatar}' alt='{$name}' title='{$name}' />";
        echo '</a></span>';
        return ;

        echo '<span class="headpic50"><a href="'.$url.'">';
        $this->widget('ext.yii-gravatar.YiiGravatar', array(
            'email'=>$user['email'],
            'size'=>$this->size,
            'defaultImage'=>'http://www.amsn-project.net/images/download-linux2.png',
            'defaultImage'=>$avatar,
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
