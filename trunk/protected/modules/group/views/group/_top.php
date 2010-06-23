<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/group.css');?>

<div class=page_title> <!-- page_title begin -->
	<div class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app05.gif" class="img" /><?php echo Yii::t('sns', 'group');?></div>

	<?php if(!empty($group)){?>
	<div class="left" style="width:580px;">
		<h2><?php echo $group['name']?></h2>
		<p><strong>成员：</strong><?php echo $group['membercount']?>人   <if condition=" $groupinfo['need_verify'] "> <if condition=" $isadmin "><strong>等待审核成员：</strong>{$gid|getApplyCount}人</if></if>         </p>
		
		<p><strong>创建：</strong><?php echo friendlyDate('Y-m-d H:i:s',$group['ctime'])?></p>
		<p><strong>介绍：</strong><?php echo $group['intro']?></p>
		
	</div>
	<div class="rmenu left" style="width:150px;">
	  <if condition=" $mid "><?php if(isAddApp('share')) {  ?>
		<a href="javascript:void(0)"
			onclick="sharePop('{$gid}','__URL__','{$gid}')"  id="BtnShare_{$gid}">分享该群组</a>
			<?php }?>
		<?php if($group->isAdmin($mid,$gid)){ ?>
			<a href="__APP__/Manage/index/gid/{$groupinfo['id']}">管理该群</a>
		<?php }else{ ?>
		{:W('Report',array( 'type'=>'群组举报','appid'=>$APPINFO['APP_ID'],'url'=>'Group/index/gid/'.$groupinfo['id'],'title'=>$groupinfo['name'],'recordId'=>$groupinfo['id']))}
		<?php } ?>
		<?php //if(checkPriv('invite',$groupinfo['need_invite'],$mid,$gid)) {  ?>
			
			 <a href="__APP__/Invite/create/gid/{$groupinfo['id']}">邀请朋友加入</a>
			 <a href="__TS__/Invite/index/uid/{$mid}/gid/{$gid}">邀请站外好友加入</a>
			
		<?php //}  ?>
		
		
		<?php if(!$group->isAdmin($mid,$gid) && !$group->isMember($mid,$gid)){ ?>
			<?php if($groupinfo['membercount'] == $config['groupMaxUser']){ ?>
				人数已经满({$groupinfo['membercount']})
			<?php }else{ ?>
				<a href="javascript:joingroup({$gid})">申请加入该群</a>
			<?php } ?>
		<?php } elseif($group->isCreater($mid,$gid)){ ?>
			<a href="javascript:delgroup({$gid})">删除该群</a>
		<?php } else { ?>
			<a href="javascript:quitgroup({$gid})">脱离该群</a>
		<?php } ?>
		</if>
	  </div>

	<?php }?>
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
				array('label'=>'<span>群首页</span>', 'url'=>array('/group/friend','id'=>$gid)),
				array('label'=>'<span>群话题</span>', 'url'=>array('/group/topic','id'=>$gid)),
				array('label'=>'<span>群相册</span>', 'url'=>array('/group/all')),
				array('label'=>'<span>群文件</span>', 'url'=>array('/group/top')),
				array('label'=>'<span>成员</span>', 'url'=>array('/group/top')),
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