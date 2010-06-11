  <div class="grid_16" style="position:relative; z-index:1;">
	<?php $this->renderPartial('_top'); ?>
    <!--收到问候 begin-->
    <div class="wenhou">
      <table cellpadding="0" cellspacing="0" border="0" width="630">
        <tr>
          <td width="120" valign="top" align="right">我收到的问候：</td>
          <td><div class="wenhouDIV1">
<?php if(!empty($greetings)) { ?>
	<?php if(is_array($greetings)) { foreach($greetings as $key => $value) { ?>
			<dl>
				<dt><?php echo CHtml::image($this->image_dir.$value->greeting->imgPath,$value->greeting->name)?></dt>
				<dd>
					<?php
						if($value->greatingAccess == 2)
						{
							echo CHtml::link('匿名用户');
						}	
						else 
							echo CHtml::link($value->revicer->username,array('/user/user/show','id'=>$value->toUserid));

					?>
					<br/>
					<?php echo CHtml::link($this->accessOptions[$value->greatingAccess])?><br />
					<a href="#">回赠</a><br />
					<?php echo CHtml::encode(date('Y-m-d',$value->cTime))?>
				</dd>
			</dl>
	<?php } } ?>  
<?php } ?> 
              <div class="clear"></div>
            </div></td>
        </tr>
      </table>
    </div>
<div class="baikeUserPage">
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>    
    <!--收到问候 end-->
  </div>