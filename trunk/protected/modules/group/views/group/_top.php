<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/mood.css');?>
<div class=page_title> <!-- page_title begin -->
	<div class="left" style="width:100px;">
		<span class="pic80"><img src="__ROOT__/thumb.php?w=80&h=80&url={$groupinfo['logo']|get_photo_url}"/></span>
	</div>
	<div class="left" style="width:580px;">
		<h2>{$groupinfo['name']}</h2>
		<p><strong>成员：</strong>{$groupinfo['membercount']}人   <if condition=" $groupinfo['need_verify'] "> <if condition=" $isadmin "><strong>等待审核成员：</strong>{$gid|getApplyCount}人</if></if>         </p>
		
		<p><strong>创建：</strong>{$groupinfo['ctime']|friendlyDate}</p>
		<p><strong>介绍：</strong>{$groupinfo['intro']}</p>
		
	</div>
	<div class="rmenu left" style="width:150px;">
	  <if condition=" $mid "><php>if(isAddApp('share')) { </php>
		<a href="javascript:void(0)"
			onclick="sharePop('{$gid}','__URL__','{$gid}')"  id="BtnShare_{$gid}">分享该群组</a>
			<php> } </php>
		<php>if(isadmin($mid,$gid)){</php>
			<a href="__APP__/Manage/index/gid/{$groupinfo['id']}">管理该群</a>
		<php>}else{</php>
		{:W('Report',array( 'type'=>'群组举报','appid'=>$APPINFO['APP_ID'],'url'=>'Group/index/gid/'.$groupinfo['id'],'title'=>$groupinfo['name'],'recordId'=>$groupinfo['id']))}
		<php>}</php>
		<php>if(checkPriv('invite',$groupinfo['need_invite'],$mid,$gid)) { </php>
			
			 <a href="__APP__/Invite/create/gid/{$groupinfo['id']}">邀请朋友加入</a>
			 <a href="__TS__/Invite/index/uid/{$mid}/gid/{$gid}">邀请站外好友加入</a>
			
		<php>} </php>
		
		
		<php>if(!isadmin($mid,$gid) && !ismember($mid,$gid)){</php>
			<php>if($groupinfo['membercount'] == $config['groupMaxUser']){</php>
				人数已经满({$groupinfo['membercount']})
			<php>}else{</php>
				<a href="javascript:joingroup({$gid})">申请加入该群</a>
			<php>}</php>
		<php>} elseif(iscreater($mid,$gid)){</php>
			<a href="javascript:delgroup({$gid})">删除该群</a>
		<php>} else {</php>
			<a href="javascript:quitgroup({$gid})">脱离该群</a>
		<php>}</php>
		</if>
	  </div>
	<div class="c"></div>
</div><!-- page_title end -->
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
				array('label'=>'<span>群首页</span>', 'url'=>array('/group/friend')),
				array('label'=>'<span>群话题</span>', 'url'=>array('/group/my')),
				array('label'=>'<span>群相册</span>', 'url'=>array('/group/all')),
				array('label'=>'<span>群文件</span>', 'url'=>array('/group/top')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>发表话题</span>', 'url'=>array('/group/create')),
				array('label'=>'<span><div class="ico_add">&nbsp;</div>新建群组</span>', 'url'=>array('/group/create')),

			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的小组</span>', 'url'=>array('/friend/index','uid'=>$uid)),
			);
		}

		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>