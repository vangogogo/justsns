  <div class="grid_16" style="position:relative; z-index:1;">
	<div class="perDocTop"><img src="images/system/taguser.gif"/></div>
	<!--用户 begin-->
	<div class="grid_16 omega alpha" >
	  <ul class="midContentMid bottomHeight">
		<li><a href="#"><img src="images/system/user.gif" /></a></li>
	  </ul>
		<div class="yhUser">
				<?php echo  CHtml::link('全体用户>>',array('/friend/friend/find'));?>
				<?php echo  CHtml::link('在线用户>>',array('/friend/friend/find','online'=>1));?>
		</div>
	  <div class="yhUser1"> 按病种选择<br />
		<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp;<a href="#">内科(2154)</a>&nbsp;&nbsp; </div>
	  <div class="yhUser1"> 更多筛选条件
		<div class="yhUser2">年龄：
		  <input name="" type="text" class="yhUser2In1" />
		  -
		  <input name="" type="text"  class="yhUser2In1"/>
		  地区：
		  <select name="" class="yhUser2In2">
		  </select>
		  &nbsp;
		  <select name="" class="yhUser2In2">
		  </select>
		  &nbsp;
		  <select name="" class="yhUser2In2">
		  </select>
		  &nbsp;
		  <select name="" class="yhUser2In2">
		  </select>
		</div>
		<div class="yhUser2">用药：
		  <select name="" class="yhUser2In3">	
		  </select>
		  症状：
		  <select name="" class="yhUser2In3">
		  </select>
		  &nbsp;&nbsp;&nbsp;&nbsp;
		  <input name="" type="image" src="images/system/searchConcern.gif" style="vertical-align:middle" />
		</div>
	  </div>
	  <!--用户列表 begin-->
	  <div class="yhUser3">
		<table width="590" border="0" cellspacing="0" cellpadding="0" class="yhUser4">
		  <tr>
			<td width="80" align="center">匹配度</td>
			<td width="70" align="center">头像</td>
			<td width="130"align="center">记记卡</td>
			<td width="70" align="center">用户名</td>
			<td width="80" align="center">疾病</td>
			<td width="50" align="center">病史</td>
			<td  align="center">更新</td>
		  </tr>
<?php if(!empty($users)) { ?>
	<?php if(is_array($users)) { foreach($users as $key => $value) { ?>		
		  <tr>
			<td width="80" align="center">&nbsp;</td>
			<td width="70" align="center"><a href="#"><img src="images/user/pic3.jpg" /></a></td>
			<td width="130"align="center" valign="middle"><img src="images/user/jjk.gif" /></td>
			<td width="70" align="center" valign="middle"><?php echo $value->username;?><br/>
				<?php echo  CHtml::link('加为好友',array('/friend/Friend/add','id'=>$value->id),array('class'=>'thickbox'));?>
			</td>
			<td width="80" align="center" valign="middle">糖尿病2型</td>
			<td width="50" align="center" valign="middle">5年</td>
			<td  align="center" valign="middle">治疗手段更新<br />
			  3天前</td>
		  </tr>
	<?php } } ?>  
<?php } ?>
		</table>
	  </div>
	  <!--用户列表 end-->
	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>	  
	</div>
	<!--用户 end-->
  </div>