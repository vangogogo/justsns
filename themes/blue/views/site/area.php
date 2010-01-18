

<div id="pop_network" class="pop">
	<div class="pop_ullist" id="pop_ullist">

<?PHP if(!empty($arealevel)){ echo $arealevel."<hr/>";?>
	<?php for($i=1;$i<=$arealevel;$i++){ ?>
		<div class="con">
		<ul class="ullist" id="list_<?php echo $i;?>">
			<?php if(!empty($list)){ foreach($list as $value){ ?>
				<?php $selected = ($value['id'] == $arrPid[$i-1])?"class='on'":""; ?>
				<li id='node_<?php echo $value['id'];?>' <?php echo $selected;?>>
					<?php echo CHtml::link($value['title'],array('/site/getArea','pid'=>$value['id'],'level'=>$value['level']),array('class'=>'thickbox','title'=>'选择地区'))?>
				</li>
			<?php }} ?>
		</ul>
		</div>
		<?php $list = $list[$arrPid[$i-1]]['child'] ?>
	<?php } ?>
	
<?PHP }else{ ?>

<div class="con">	
	<ul id="list_1" class="ullist">	
		<?php foreach($list as $value){?>
			<li id='node_<?php echo $value['id'];?>'>
				<?php echo CHtml::link($value['title'],array('/site/getArea','pid'=>$value['id'],'level'=>$value['level']),array('class'=>'thickbox','title'=>'选择地区'))?>
			</li>
		<?php }?>
	</ul>
</div>
<?PHP } ?>
		
	</div>
	<div id="selectmessage" style="margin: 3px; color: red; clear: both; text-align: left;"> 
		<span style="margin-left: 5px;" id="select_1">北京</span>
		<span style="margin-left: 5px;" id="select_2"/>
	</div>
	<div id="f_button" class="btm"><input type="button" onclick="save()" value="确 定" class="btn_b" name="input"/><input type="button" onclick="ymPrompt.close();" value="取 消" class="btn_w" name="input2"/></div>	
</div>
<style>
.btm {
background-color:#EEEEEE;
clear:both;
padding:5px;
text-align:right;
}
.pop .pop_ullist {
height:auto;
}
.pop .con {
border-top:1px solid #D1D1D1;
clear:both;
height:85px;
margin:0;
padding:0;
}
.pop .ullist li {
float:left;
list-style-type:none;
margin:4px;
white-space:nowrap;
}
.pop .ullist a {
border:1px solid #FFFFFF;
display:block;
}
.pop .ullist .on a {
border:1px solid #3385CA;
display:block;
}

</style>