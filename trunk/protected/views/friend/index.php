<?php
    include('_top.php');
?>
<div class="sidebar pt10">
	<div class="FSort">
		<div class="tit">
			<a class="f12px fn right mr5" href="javascript:addGroup()">添加分组</a>
			好友分组
		</div>
		<ul id="f_group">
			<li class="on"><a href="http://localhost/thinksns/index.php?s=/Friend/index">所有好友(2)</a></li>
			<li id="fli_1"><a href="http://localhost/thinksns/index.php?s=/Friend/index/gid/1">未分组(0)</a></li>
		<div class="btm"></div>
	</div>
</div>

<div class="FList"><!-- 我的好友 begin  -->
	<ul style="padding: 0px;margin: 10px auto 0px auto;">
		<?php foreach($friends as $friend){?>
			<li class="btmlineD li pb10 pt5" id="fri_<?php echo $friend['id']?>" >
				<div class="left" style="width:70px;"><span class="headpic50">
						<a href="__APP__/space/{$user.fuid}"  class="tips" rel="__TS__/Index/userInfo/uid/{$user['fuid']}"><img src="{$user.fuid|getUserFace='middle'}" /></a></span></a></div>
				<div class="left" style="width:450px; margin-right:50px;">
					<p class="lh20">
						<?php echo CHtml::link($friend['username'],array('/space/','uid'=>$friend['id']),array('id'=>'fname_'.$friend['id']));?>
					</p>

					<p class="cGray2 lh20">分组：
						<?php echo CHtml::link('分组',array('/friend/group','id'=>$friend['id']),array('class'=>'thickbox','title'=>'修改好友分组'))?>
					</p>
					<p class="cGray2 lh20"><span class="wn">心情：</span>{$user.fuid|getUserMini}</p>
				</div>
				<div class="left" style="width:60px;">
					<p class="lh20">
						<?php echo CHtml::link('查看空间',array('/space/','uid'=>$friend['id']));?>
					</p>
					<p class="lh20">
						<?php echo CHtml::link('发送短信',array('/notice/write','uid'=>$friend['id']));?>
					</p>
					<p class="lh20">
						<?php echo CHtml::link('解除关系',array('/friend/delete','uid'=>$friend['id']),array('class'=>'thickbox'));?>
					</p>
				</div>
				<div class="c"></div>
			</li>
		<?php }?>
	</ul>

	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>

</div><!-- 我的好友 end  -->