<?php include('_top.php'); ?>
<script type="text/javascript">
	var url = '__URL__';
	$(function(){
		selectItems(1);
		<?php if($_GET["uid"] && $_GET['uid'] != $mid){?>
				//指定发给某人
				var uid = <?php echo $user['id']?$user['id']:'';?>;
				if(uid){
					$(".ui-fs-input").remove();
					var image = "<?php echo $user['face']?>";
					var name  = "<?php echo $user['username']?>";
					$(".ui-fs-result").append("<a href='javascript:void(0)' ><img width='20' height='20' src='" + image + "' title='" + name + "' alt='' />" + name + "</a>");
					$("#ui_fri_ids").val(uid);
				}
		<?php }?>
	});
	function selectItems(id){
		$('.gift_items').each(function(test){
			$(this).attr('class','gift_items');
		});
		$('.giftblock').each(function(){
			$(this).css('display','none');
		});
		$('#gifts'+id).css('display','block');
		$('#item'+id).attr('class','gift_items on');
	}
	
	function sendGift(id){
		var clickid = 'gift'+id;
		$('.gifts').each(function(){
			if($(this).attr('id')==clickid){
				$(this).attr('class','gifts hand on');
			}else{
				$(this).attr('class','gifts hand');
			}
		});
		var temp_gift = $('#gift'+id).clone();
		$('#gift_info').html('');
		$('#gift_info').append(temp_gift.html());
		$('#gift_id').val(id);
		$('#sendInfo').val(temp_gift.find('img').attr('desc'));
		scroller('sendto', 1000);
	}
	function check(){
		if(!$('#gift_id').val()){
			Alert('请选择礼物');
			return false;
		}
		if(!($('#ui_fri_ids').val())){
			Alert('请选择礼物发送对象');
			return false;
		}
	}
</script>
<div style="padding-left:20px;">
	<div class="f14px fB lh35" style=" margin-top:30px;">
		选择一个礼物:
	</div>
	<div class="tab_lw">
		<?php foreach ($giftCategory as $key => $category):?>
			<a href="javascript:void(0)" class="gift_items on" onclick='selectItems(<?php echo $category['id'];?>)' id='item{<?php echo $category['id'];?>}'><?php echo $category['name'];?></a>
		<?php endforeach;?>
	</div>
	<?php foreach ($giftCategory as $key => $category):?>
		<div class="giftblock" id='gifts<?php echo $category['id'];?>' style="display:none;">
			<ul>
				<?php foreach ($category['gifts'] as $key => $gift):?>
					<li class='gifts hand' title="点击选择" id="gift<?php echo $gift['id'];?>" onclick="sendGift(<?php echo $gift['id'];?>)">
						<?php echo CHtml::image($this->image_dir.$gift->img,$gift->name,array('desc'=>$gift->desc));?>
						<br/>
						<?php echo $gift['name'];?>
						<br/>
						限量：<?php echo $gift['num'];?>个
						<br/>
						<?php echo '免费';//echo $gift['price'].'个{$config.creditName} ';?>
					</li>
				<?php endforeach;?>
				<div class="c"></div>
			</ul>
		</div>
	<?php endforeach;?>
	<a name="sendto" id="sendto"></a>
	<div id='gift_info'></div>
	<?php echo EHtml::beginForm('','POST',array('onsubmit'=>'return check()'));?>
		<div style="margin-top:20px;" class="hidden">
			<h2 class="f14px fB lh30">我目前拥有的{$config.creditName}是： {$money}</h2>
		</div>
		<div style="margin-top:30px;">
			<h2 class="f14px fB lh30">选择接收人：</h2>
			<div style="width:360px;">
				<?php $this->widget('WFriendSelect'); ?>
			</div>
			<div style="margin-top:20px;">
				<h2 class="f14px fB lh30">附加消息：</h2>
				<p style="margin:0; padding:0;">
					不能超过200个字符
				</p>
				<?php echo EHtml::activeTextArea($model, 'content', array('cols'=>50,'rows'=>6,'class'=>'Text20','id'=>'sendInfo'));?>
			</div>
			<div>
				<div class="lh30 fB f14px">
					选择赠送的方式：
				</div>
				<div>
					<div class="left">
						<input checked="checked" value="1" id="public" name="GiftUser[access]" type="radio" />
					</div>
					<div style="margin:0 0 20px 20px;" class="lh18">
						<label for="public">
							<strong>公开赠送</strong>
							<br/>
							<span class="cGray2">其他人可以看见你的礼物和消息。
								<br/>
								这个礼物将显示在接受人的礼物盒和新鲜事里。
							</span>
						</label>
					</div>
					<div class="left">
						<input value="2" id="private" name="GiftUser[access]" type="radio"/>
					</div>
					<div style="margin-left:20px;" class="lh18">
						<label for="private">
							<strong>私下赠送</strong>
							<br/>
							<span class="cGray2">其他人只能看见礼物，只有接收礼物的人能看见你的名字和消息
								<br/>
								这个礼物将只出现在接收人的礼物盒里。
							</span>
						</label>
					</div>
					<br/>
					<div class="left">
						<input value="3" id="anonymous" name="GiftUser[access]" type="radio" />
					</div>
					<div style="margin:0 0 20px 20px;" class="lh18">
						<label for="anonymous">
							<strong>匿名赠送</strong>
							<br/>
							<span class="cGray2">其他人只能看见礼物，只有接收礼物的人能看见你的消息，但不显示你的名字。
								<br/>
								这个礼物将显示在接收人的礼物盒里。
							</span>
						</label>
					</div>
					<?php echo EHtml::activeHiddenField($model,'giftId',array('id'=>'gift_id'));?>
				</div>
			</div>
			<div class="mt10">
				<input type="submit" class="btn_b" style="margin-right:5px;" value="赠送礼物" /><input type="button" class="btn_w" value="取消" />
			</div>
		</div>
	<?php echo EHtml::endForm(); ?>
</div>