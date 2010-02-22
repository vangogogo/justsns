<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/mood.css');?>
<div class=page_title> <!-- page_title begin -->
	<div class="tit"><img src="/yiisns/themes/blue/images/apps/ico_app04.gif" class="img" /><?php echo Yii::t('sns', 'mini');?></div>
	<?php if($this->action->id == 'my'){?>
	<div class="status_editor">
	<div style="float:left; width:100%" class="lh25"><span class="f14px fn cGray" id="mini-content">{$content}</span><span class="cGray2 fn f12px ml10" id="mini-time">{$cTime|friendlyDate}</span><span class="f12px fn ml5"><a href="__URL__/my">{%more}</a></span></div>
		<!-- <div class="jishuan"><span id='mini-count'></span></div> -->
		<div class="status_edit"><!-- 心情状态页显示编辑框 -->
		  <div>
		  <textarea id ="mini-coment" name="content" rows="" wrap="virtual" class="WB" onkeyup="fot(this)" onkeydown="fot(this)"></textarea>
		  </div>
		  <div class="phiz_box">
		  <div class="phiz" style="display:none;top: 0px;left: 0px;">
			<php>foreach ( $ico_list as $value){
			  $i++;</php>
			<div class="ico_link">
			  <img onclick="insert(this,{$i});" title="{$value.title}" emotion="{$value.emotion}" src="__PUBLIC__/images/biaoqing/{$site_opts.ico_type}/{$value.filename}"/>
			</div>
			<php>}</php>
		</div>
		</div>
		</div>
		<div class="left pt5 pl5"><input type="submit" class="btn_big" onclick="doAdd()" value="{%add}" /></div>
		<div class="c" ></div>
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
				array('label'=>'<span>好友的心情</span>', 'url'=>array('/mini/index')),
				array('label'=>'<span>我的心情</span>', 'url'=>array('/mini/my')),
				array('label'=>'<span>大家的心情</span>', 'url'=>array('/mini/all')),
			);
		}
		else
		{
			$items =array(
				array('label'=>'<span>TA的心情</span>', 'url'=>array('/friend/index','uid'=>$uid)),
			);
		}
		
		$this->widget('zii.widgets.CMenu',array(
		'items'=>$items,
		'activeCssClass'=>'on',
		'encodeLabel'=>false,
		));


	?>
</div>