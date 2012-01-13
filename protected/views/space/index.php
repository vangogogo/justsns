<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/space.css');?>

<div class="content">
<!--用户应用-->
<div class="tab-menu">
	<?php
	$items = array();
	if(!empty($apps))
	{
		foreach($apps as $attr => $vo)
		{
			$item = array(
				'label'=>$vo['name'],
				'url'=>array('/'.$vo['enname'].'/index','uid'=>$uid),
			);
			$items[] = $item;
		}
	}
	$this->widget('BootMenu', array(
	    'type'=>'tabs', // tabs or pills, defaults to tabs
	    'items'=>$items
	)); ?>
</div>
<!--用户应用end-->
	<?php if(!empty($space_privacy)){ ?>
	<br/>
	<?php if($is_hide){ ?>
	<div style="display: block;" class="ta_wqfw" id="limitdiv">{$uid|getUserName}的个人主页目前处于隐藏状态。</div>
	<?php }else{ ?>
	<div style="display: block;" class="ta_wqfw" id="limitdiv">由于对方的隐私设置，你没有权限查看。</div>
	<?php } ?>


	<?php } ?>


	<?php if(empty($space_privacy)){ ?>	 <!--隐私控制-->

	<div class="Feed"><!-- 个人动态 begin  -->
		<div class="tab-menu"><!-- 切换标签 begin  -->
			<div class="right lh35"><a href='__APP__/Home/allFeed/type/all/uid/{$uid}'>查看全部动态</a></div>
			<ul>
				<li><a class="on feed_item" ><span>{$show_sex}的动态</span></a></li>
			</ul>
		</div><!-- 切换标签 end  -->

		<div class="alR lh35"><a href='__APP__/Home/allFeed/type/all/uid/{$uid}'>查看全部动态</a></div>
	</div><!-- 个人动态 end  -->


	<?php if(!empty($wall_privacy)){ ?>
	<div class="Guestbook" id="wall"><!-- 留言板 begin  -->
		<div class="tit"><span class="pl5">留言板</span></div>
		<div class="GB_box">
			<textarea name="textarea2" cols="" id="wall_con"></textarea>
			<input type="button" class="btn_b" value="留 言" id="sub_button" onclick="wall()"/>
			(每条最多2000字)     
			<label><input type="checkbox" name="privacy" id="wall_privacy" value="1"/>悄悄话</label>
			<input type="hidden" name="uid" id="space_uid" value="{$uid}">
			<input type="hidden" id="my_name2" value="{$my_name}">
			<span style="display:none" id="my_face2"><img src="{$mid|getUserFace='middle'}" /></span>
		</div>
	</div>
	<div class="GBList" id="list_wall">

		<volist name="my_walls['data']" id="wall">
			<div class="Gli" id="wall_item_{$wall.id}">
				<div class="user_img"><span class="headpic50"><a href='__TS__/space/{$wall.fromUserId}' class="tips" rel="__TS__/Index/userInfo/uid/{$wall.fromUserId}"><img src="{$wall.fromUserId|getUserFace}" /></a></span></div>
				<div class="LC">
					<div class="MC">
						<h4 class="tit_Critique lh25 mb5 pl5"><span class="right"><a href="javascript:wall_reply_dis({$wall.id})">回复</a>
								<?php if($mid == $uid || $mid == $wall["fromUserId"]){ ?>&nbsp;<a href="javascript:wall_del({$wall.id})">删除</a>
								<?php } ?></span><a href="__TS__/space/{$wall.fromUserId}"><strong>{$wall.fromUserName}</strong></a><span class="cGray2">{$wall.cTime|friendlyDate="full"}</span><span><?php if($wall["privacy"] == 1){ ?><font color="red">【悄悄话】</font><?php } ?></span></h4>
						<p class="WB">
							{$wall.content|textarea_output}
						</p>
						<a id="d-{$vo.id}"href='###' onclick="deleteMini('{$vo.id }')" class="del" title="删除" style="display:none;">删除</a>		</div>
					<div class="RC">
						<span id="wall_reply_list_{$wall.id}">
							<sublist name="wall['replys']" id="reply">
								<div class="RLI">
									<div class="user_img"><span class="pic38"><a href="__APP__/space/{$reply.fromUserId}" class="tips" rel="__TS__/Index/userInfo/uid/{$reply.fromUserId}" ><img src="{$reply.fromUserId|getUserFace}" /></a></span></div>
									<div class="RLC">
										<h4 class="tit_Critique lh20 mb5 pl5"> <a href="__APP__/space/{$reply.fromUserId}"><strong>{$reply.fromUserName}</strong></a><span class="cGray2">{$reply.cTime|friendlyDate="full"}</span></h4>
										<p>{$reply.content|textarea_output}</p>
									</div>
									<div class="c"></div>
								</div>
							</sublist>
						</span>



						<div class="RLI bg01" style="display:none" id="wall_reply_{$wall.id}">
							<div class="user_img"><span class="pic38"><img src="{$mid|getUserFace}" /></span></div>
							<div class="RLC">
								<div class="input_box">
									<textarea name="textarea" cols="" style="height:50px; line-height:18px; width:99%" id="wall_reply_con_{$wall.id}"></textarea>
									<?php if($wall["privacy"] == 1){ ?>
									<input type="checkbox" name="privacy" id="wall_privacy_{$wall.id}" value="1" checked="true" disabled="true"/>悄悄话
									<?php } ?>
									<input type="button" id="reply_button" class="btn_b mt5" value="回 复" onclick="wall_reply({$wall.id})"/><input type="button" class="btn_w mt5" value="取 消" onclick="wall_reply_cancel({$wall.id})"/>
								</div>
							</div>
							<div class="c"></div>
						</div>

					</div>
				</div>
				<div class="c"></div>
			</div>
		</volist>
		<?php if($my_walls['count']>=10){ ?><div class="alR"><a href="__URL__/guestbook/uid/{$uid}">查看所有留言</a></div><?php } ?>
	</div>
	<!-- 留言板 end  -->
	<?php } ?>


	<?php } ?> <!--隐私控制end-->


	<!-- 留言板 end  -->
	<?php $this->widget('WPeopleBoardForm',
				array(
					'params' => array('object_id'=>$uid,'object_type'=>'space'),
					'htmlOptions'=>array('showSubmit'=>true,'id'=>'#message-form2')
				)
			);
			// view文件位于\protected\components\views\WPeopleBoard.php 页面端可传递参数为seClassName和head cferTitle 'htmlOptions'=>array('seClassName'=>'seBoard','head cferTitle'=>'留言板')
	?>

	<?php $this->widget('WPeopleBoard',
				array(
					'params' => array('object_id'=>$uid,'object_type'=>'space','limit'=>10,'more_link'=>$this->createUrl('lecturer/board',array('id'=>$uid))),
					'htmlOptions'=>array()
				)
			);
			// view文件位于\protected\components\views\WPeopleBoard.php 页面端可传递参数为seClassName和head cferTitle 'htmlOptions'=>array('seClassName'=>'seBoard','head cferTitle'=>'留言板')
	?>
</div>
<?php include('_right.php');?>
