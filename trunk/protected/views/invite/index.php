<h1><?php echo $this->pageTitle;?></h1>
<div class="grid_23 suffix_1">
    <?php include('_top.php');?>
	<div class="friendBox">
		<div class="menuA" onmouseover="this.className='menuB'" onmouseout="this.className='menuA'">
			<h2 class="f14px fB lh35">
				<?php echo CHtml::link('导入邮箱的通讯录至邀请名单',array('postOffice','gid'=>$gid));?>
			</h2>
			<p class="cGray">支持
			<img src="<?php echo PUBLIC_URL;?>images/h/h_163.gif" width="17" height="15" />
			<img src="<?php echo PUBLIC_URL;?>images/h/h_gmail.gif" alt="" width="27" height="12" />
			<img src="<?php echo PUBLIC_URL;?>images/h/h_yahoo.gif" alt="" width="31" height="12" />
			等常用邮箱</p>
		</div>
		<div class="menuA" onmouseover="this.className='menuB'" onmouseout="this.className='menuA'">
			<h2 class="f14px fB lh35">
				<?php echo CHtml::link('发送邀请链接给朋友',array('directSendLink','gid'=>$gid));?>
			</h2>
			<p class="cGray">用
			<img src="<?php echo PUBLIC_URL;?>images/h/h_qq.gif" width="17" height="15" />
			<img src="<?php echo PUBLIC_URL;?>images/h/h_msn.gif" width="16" height="14" />
			等聊天工具邀请链接</p>
		</div>
		<div class="menuA" onmouseover="this.className='menuB'" onmouseout="this.className='menuA'">
			<h2 class="f14px fB lh35">
				<?php echo CHtml::link('导入MSN联系人至邀请名单',array('msn','gid'=>$gid));?>
			</h2>
			<p class="cGray">可导入你的MSN
			<img src="<?php echo PUBLIC_URL;?>images/h/h_msn.gif" width="16" height="14" />
			上的联系人名单</p>
		</div>
		<div class="menuA" onmouseover="this.className='menuB'" onmouseout="this.className='menuA'">
			<h2 class="f14px fB lh35">
				<?php echo CHtml::link('直接通过Email邀请',array('directSendEmail','gid'=>$gid));?>
			</h2>
			<p class="cGray">向对方的邮箱发送邀请邮件</p>
		</div>
	</div>
</div>
