<script type="text/javascript">
	var url = '__URL__';
	$(function(){
		//selectItems(1);
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

<?php
foreach ($giftCategory as $key => $category)
{
    $cate_name = $category['name'];
    $tabs[$cate_name] = array(
        'content'=>$this->renderPartial('_gifts',array('category'=>$category),true),'id'=>$key
   );
}

$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>$tabs,
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>false,
    ),
));

?>



    <div class="clear"></div>



<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	#'disableAjaxValidationAttributes'=>array('LoginForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	#'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>


	<a name="sendto" id="sendto"></a>	<div id='gift_info'></div>

			<div class="row">
                <label class="left">接收人：</label>
				<div style="width:300px" class="left"><?php $this->widget('WFriendSelect'); ?></div>
			</div>
            <div class="clear"></div>
			<div class="row">
				<h2>附加消息</h2>
				<?php echo $form->textArea($model, 'content', array('class'=>'t_input t_area','id'=>'sendInfo'));?>
			</div>
			<div>
				<h2>
					选择赠送的方式：
				</h2>
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
					<?php echo $form->hiddenField($model,'giftId',array('id'=>'gift_id'));?>
				</div>
			</div>
            <div class="row">
				<input type="submit" class="btn" style="margin-right:5px;" value="赠送礼物" /><input type="button" class="btn" value="取消" />
			</div>

<?php $this->endWidget(); ?>
