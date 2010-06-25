<?PHP if(!empty($init)){ ?>
	<?php for($i=1;$i<=$arealevel;$i++){ ?>
		<div class="con">
		<ul class="ullist" id="list_<?php echo $i;?>">
			<?php foreach($list as $vo){ ?>
				<?php $selected = ($vo['id'] == $arrPid[$i-1])?"class='on'":""; ?>
				<li id='node_<?php echo $vo['id'];?>' <?php echo $selected;?>><a href='javascript:void(0);' onclick=selectarea("<?php echo $vo['id'];?>","<?php echo $vo['level'];?>","<?php echo $vo['title'];?>") ><?php echo $vo['title'];?></a></li>
			<?php } ?>
		</ul>
		</div>
		<?php $list = $list[$arrPid[$i-1]]['child'] ?>
	<?php } ?>
	
<?PHP }else{ ?>
	<?php foreach($list as $vo):?>
		<li id='node_<?php echo $vo['id'];?>'><a href='javascript:void(0);' onclick=selectarea("<?php echo $vo['id'];?>","<?php echo $vo['level'];?>","<?php echo $vo['title'];?>") ><?php echo $vo['title'];?></a></li>
	<?php endforeach;?>
<?PHP } ?>
