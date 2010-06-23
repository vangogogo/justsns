<?php
	include('_top.php');
?>
<div class="groupBox">
	<div class="sidebar">
		<?php if(!empty($adminList)):?>
		<div class="FSort">
			<div class="tit">
				创始人与管理员
			</div>
			<ul class="pic_list">
				<?php foreach($adminList as $member):?>
				<li>
					<span class="headpic50">
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$member['id']));?>">
							<img src="<?php echo $member['face'];?>" />
						</a>
					</span>
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$member['id']));?>">
						<?php echo $member['username'];?>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<div class="more">
				<?php echo CHtml::link('所有成员>>',array('group/member','gid'=>$group['id']));?>
			</div>
			<div class="btm">
			</div>
		</div>
		<?php endif;?>
		<?php if(!empty($memberList)):?>
		<div class="FSort">
			<div class="tit">
				新加入成员
			</div>
			<ul class="pic_list">
				<?php foreach($memberList as $member):?>
				<li>
					<span class="headpic50">
						<a href="<?php echo $this->createUrl('/space/',array('uid'=>$member['id']));?>">
							<img src="<?php echo $member['face'];?>" />
						</a>
					</span>
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$member['id']));?>">
						<?php echo $member['username'];?>
					</a>
				</li>
				<?php endforeach;?>
			</ul>
			<div class="more">
				<?php echo CHtml::link('所有新成员>>',array('group/member','gid'=>$group['id']));?>
			</div>
			<div class="btm">
			</div>
		</div>
		<?php endif;?>
	</div>
	<div class="boxL" style="width:640px;">
		<?php if(t($group['announce'])!=''):?>
		<div class="box1">
			<h3>群公告</h3>
			<div class="pl10">
				<?php echo $group['announce'];?>
			</div>
		</div>
		<?php endif;?>
		<div class="box1">
			<h3>成员动态</h3>
			<ul class="list pl10">
				<volist name="groupFeed" id="feed">
					<if condition="$feed['type'] eq 'group_join' ">
						<li class="btmlineD">
							<div class="right alR" style="width:14%;">
								<em>{:date('m-d H:i',$feed['cTime'])}</em>
							</div>
							<div class="cGray2" style="width:85%;">
								{$feed.title|stripGroupName}
							</div>
						</li>
						<else/>
						<li class="btmlineD">
							<div class="right alR" style="width:14%;">
								<em>{:date('m-d H:i',$feed['cTime'])}</em>
							</div>
							<div class="cGray2" style="width:85%;">
								{$feed.title|stripGroupName}:  {$feed.body}
							</div>
						</li>
					</if>
				</volist>
			</ul>
		</div>
		<?php
			//话题列表
			$this->renderPartial('../topic/list',array('threads'=>$threads,'group'=>$group));
		?>
		<if condition=" $groupinfo['openAlbum'] ">
			<div class="box1">
				<h3>群相册(共{$photoCount}张)</h3>
				<ul class="piclist">
					<volist name="photoList" id="photo">
						<li>
							<a href="__APP__/Photo/getPhoto/gid/{$gid}/albumId/{$photo.albumId}/photoId/{$photo.id}" class="preview" rel="{$photo.savepath|get_photo_url}" title="{$photo.name}"><img src="__ROOT__/thumb.php?w=134&h=91&t=f&url={$photo.savepath|get_photo_url}"/></a>
							<br/>
							<a href="__APP__/Photo/getPhoto/gid/{$gid}/albumId/{$photo.albumId}/photoId/{$photo.id}">{$photo.name|msubstr=0,13}</a>
						</li>
					</volist>
				</ul>
				<div class="alR lh30">
					<a href="__APP__/Photo/upload/gid/{$gid}">上传照片</a>
					┊<a href="__APP__/Album/index/gid/{$gid}">进入群相册>></a>
				</div>
			</div>
		</if>
		<if condition=" $groupinfo['openUploadFile'] ">
			<div class="box1">
				<h3>群文件(共{$fileCount}个)</h3>
				<p class="cGray2">
					该群还没有人上传文件 <a href="__APP__/Dir/upload/gid/{$gid}">上传文件</a>
				</p>
				<ul class="file">
					<?php 
						if(!$fileList) { 
					 ?>
					<li>
						还没有文件
					</li>
					<?php 
						} else{ 
					 ?>
					<li>
						<div class="c1">
							文件名称
						</div>
						<div class="c2">
							大小
						</div>
						<div class="c3">
						</div>
					</li>
					<volist name="fileList" id="file">
						<li>
							<div class="c1">
								<img src="../Public/images/icon/{$file.filetype}.gif" /><a href="__APP__/Dir/file/gid/{$gid}/fid/{$file.id}">{$file.name}</a>
							</div>
							<div class="c2">
								{$file.filesize|formatsize}
							</div>
							<div class="c3">
								<a href="javascript: download({$file['id']});">下载</a>
							</div>
						</li>
					</volist>
					<?php 
						}
					 ?>
				</ul>
				<div class="alR lh30">
					<a href="__APP__/Dir/index/gid/{$gid}">进入文件共享区>></a>
				</div>
			</div>
		</if>
	</div>
	<!-- end  -->
</div>