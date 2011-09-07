<?php echo CHtml::beginForm(); ?>
<ul class="set-group-list" style="display: block; ">
<?php if(!empty($friendGroup)) { ?>
	<?php if(is_array($friendGroup)) { foreach($friendGroup as $key => $value) { ?>   
     <li>
<input id="FriendBelongGroup_<?php echo $value->id?>" name="FriendBelongGroup[<?php echo $value->id?>]" type="checkbox" value="<?php echo $value->id?>" <?php if(in_array($value->id,$frienBelongdGroup)) echo 'checked="true"'?>/><label for="FriendBelongGroup_<?php echo $value->id?>" style="width:160px"><?php echo $value->name?></label>
     </li>
	<?php } } ?>  
<?php } ?>
</ul>
<div id="f_button" class="btm">
		<input type="submit" value="提 交" class="btn_b" name="input" />
</div>
<?php echo CHtml::endForm(); ?> 

