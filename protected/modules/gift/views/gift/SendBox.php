<div class="gift_list">
	<?php foreach($gifts as $gift):?>
	<div class="gift_box">
		<div class="left" style="width:80px;">
            <?php $this->widget('WUserFace',array('uid'=>$gift['toUserId'])); ?>
			<?php echo CHtml::image($this->image_dir.$gift['gift']->img,$gift['gift']->name,array('desc'=>$gift['gift']->desc));?>
		</div>
		<div class="left" style="width:480px;">
			<div class="lh20">
				<?php if($gift['access'] == 3 AND $gift['fromUserId'] != $this->mid)
					echo CHtml::encode('神秘人士');
				else
					 echo CHtml::link($gift['fromUsername'],array('/space/','uid'=>$gift['fromUserId']));?>
				在<?php echo friendlyDate('Y-m-d',$gift['ctime']);?> 赠送给 
				<?php echo CHtml::link($gift['toUsername'],array('/space/','uid'=>$gift['toUserId']));?>
				<br/>
				<div class="cGray2 lh30">赠言：</div>
				<div class="quote" style="margin:0;">
					<p>
						<?php echo $gift['content']?$gift['content']:'没有留言';?><span class="quoteR">&nbsp;</span>
					</p>
				</div>
			</div>
		</div>
		<div class="clear">
		</div>
	</div>
	<?php endforeach;?>
	<div id="Pagination" class="pagination">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
</div>
