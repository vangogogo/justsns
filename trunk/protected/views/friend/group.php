<?php echo CHtml::beginForm(); ?>
<div style="overflow-x: hidden; overflow-y: scroll;" id="gid" class="gd">
<?php if(!empty($friendGroup)) { ?>
	<?php if(is_array($friendGroup)) { foreach($friendGroup as $key => $value) { ?>
		<div style="width: 50%; float: left; height: 25px;">
      		<input name="FriendBelongGroup[<?php echo $value->id?>]" type="checkbox" value="<?php echo $value->id?>" <?php if(in_array($value->id,$frienBelongdGroup)) echo 'checked="true"'?>/><label style="width:160px"><?php echo $value->name?></label>
		</div>
	<?php } } ?>  
<?php } ?>
</div>
<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
</div>
<?php echo CHtml::endForm(); ?> 
