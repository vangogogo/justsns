<?php echo CHtml::beginForm(); ?>
<ul class="set-group-list2" style="display: block; ">
<?php if(!empty($friendGroup)) { ?>
	<?php if(is_array($friendGroup)) { foreach($friendGroup as $key => $value) { ?>   
     <li>
<?php
$this->widget('zii.widgets.jui.CJuiButton',
	array(
        'buttonType'=>'checkbox',
		'name'=>"FriendBelongGroup[{$value->id}]",
		'caption'=>$value->name,
		'value'=>in_array($value->id,$frienBelongdGroup),
        'htmlOptions'=>array(
            'data-gid'=>$value->id,
            'data-fuid'=>$_GET['fuid'],        
        ),
		#'onclick'=>'js:function(){alert("Save button clicked"); this.blur(); return false;}',
		)
);
?>

     </li>
	<?php } } ?>  
<?php } ?>
</ul>
<div id="f_button" class="row">
		<input type="submit" value="提 交" class="btn" name="input" />
</div>
<?php echo CHtml::endForm(); ?> 


