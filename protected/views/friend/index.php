<!-- 切换标签 begin  -->
<div class="tab-menu">
	<?php
		$uid = Yii::app()->request->getParam('uid');
		
		if(!empty($uid)) {
			$is_me = ($this->mid == $uid);
		}else {
			$uid = $this->mid;
			$is_me = true;
		}	
		
		if($is_me)
		{
			$items =array(
				array('label'=>'<span>全部</span>', 'url'=>array('/friend/index','gid'=>0)),
			);
            if(!empty($friendGroup))
            {
                foreach($friendGroup as $tmp)
                {
                    $items[]= array('label'=>'<span>'.$tmp['name'].'</span>', 'url'=>array('/friend/index','gid'=>$tmp['id']));
                }
            }
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的好友</span>', 'url'=>array('/friend/index','uid'=>$uid)),
				array('label'=>'<span>邀请好友</span>', 'url'=>array('/invite/index')),
			);
		}
		
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>

    <?php if(!empty($friends)):?>
	<ul class="user-list">
		<?php foreach($friends as $friend){?>
			<li class="info" id="fri_<?php echo $friend['id']?>" >
				<div class="left" style="width:70px;">
                    <?php $this->widget('WUserFace',array('uid'=>$friend['id']));?>
				</div>
				<div class="left" style="width:400px; margin-right:30px;">
					<p class="lh20">
						<?php echo CHtml::link($friend['username'],array('/space/','uid'=>$friend['id']),array('id'=>'fname_'.$friend['id']));?>
					</p>

					<p class="cGray2 lh20"> 分组：
						<?php 
						echo Friend::model()->getGroupsName($uid,$friend['id']);
						if($is_me){
							echo CHtml::link('分组',array('/friend/group','fuid'=>$friend['id']),array('class'=>'thickbox','title'=>'修改好友分组'));
						}
						else echo CHtml::encode('分组');
						?>

					</p>
                    <p>
                        <span class="wn">心情：</span><?php echo $friend['mini'];?>
                    </p>
				</div>
				<div class="left" style="width:60px;">
					<p class="lh20">
						<?php echo CHtml::link('发送短信',array('/notify/write','uid'=>$friend['id']));?>
					</p>
					
					<p class="lh20">
						<?php if($is_me) echo CHtml::link('解除关系',array('/friend/DoDelFriend','uid'=>$friend['id']),array('class'=>'a_confirm_link','title'=>'确认解除关系?'));?>
					</p>
				</div>
				<div class="clear"></div>
			</li>
		<?php }?>
	</ul>

	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
    <?php endif;?>

