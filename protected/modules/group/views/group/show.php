<div id="maincon">
	<h1><?php echo $group['name'];?></h1>
	<br/>
	<br/>
	<div id="maincon_l">
		<div id="groupintro">
			<table class="groupintro_t">
				<tr>
					<td width="76">
						<div id="image">
							<?php echo $group['logo'];?>
						</div>
					</td>
					<td>
						<?php echo $group['intro'];?>
					</td>
				</tr>
			</table>
			<div class="cdate">
				创建于 <?php echo friendlyDate('m-d H:i',$group['ctime'])?>
			</div>
		</div>
		<br/>
		<br/>
		<h2>小组最近话题 ······</h2>
		<table class="disli">
			<tr>
				<td>
					话题
				</td>
				<td width="120">
					作者
				</td>
				<td width="36">
					回应
				</td>
				<td width="110" align=right>
					最后回应
				</td>
			</tr>
			<?php if(!empty($threads)){?>
				<?php foreach($threads as $topic):?>
			<tr>
				<td>
					<?php if($topic['top']):?><span class="zd">顶</span><?php endif;?>
					<?php if($topic['dist']):?><span class="jh">精</span><?php endif;?>
					<?php echo CHtml::link($topic['title'],array('topic/show','tid'=>$topic['id']),array('title'=>$topic['title']));?>
				</td>
				<td>
					<?php echo CHtml::link($topic['name'],array('space','uid'=>$topic['uid']));?>
				</td>
				<td>
					<?php echo $topic['postcount']?>/<?php echo $topic['viewcount']?>
				</td>
				<td align="right">
					<span class="color02"><?php echo friendlyDate('m-d H:i',$topic['replytime'])?></span>
				</td>
			</tr>
				<?php endforeach;?>
			<?php }else{?>
				
				<tr><td colspan="8">还没有话题，你可以发表话题</td></tr>
			<?php }?>

		</table>
		<div class="dislib">
			<?php echo CHtml::link('> 更多小组话题',array('group/discussion','gid'=>$group['id']));?>
		</div>
	</div>

	<div id="maincon_r">
		<h2>
			<?php echo CHtml::link('> 小组首页',array('/group'));?>
		</h2>
		<br/>
		<h2><?php echo CHtml::link('> 浏览所有成员',array('group/member','gid'=>$group['id']));?> (3390)</h2>
		<br/>
		<?php if(!empty($group_list)):?>
		<h2>
		本小组油条还喜欢去
		</h2>
		<div id="grouplist">
			<ul>
				<?php foreach($group_list as $g):?>
				<li>
					<div id="image">
						<a href="/group/funny/"><img src="http://img.u148.net/ghead/2008/920071126145636.jpg" /></a>
					</div>
					<a href="/group/funny/">咦，有个笑话</a>(2611)
				</li>
				<?php endforeach;?>
			</ul>
			
		</div>
		<br/>
		<?php endif;?>
	</div>
</div>
