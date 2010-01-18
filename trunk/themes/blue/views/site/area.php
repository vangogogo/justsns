<?php var_dump($init);?>
<?PHP if(!empty($init)){ ?>
	<?php for($i=1;$i<=$arealevel;$i++){ ?>
		<div class="con">
		<ul class="ullist" id="list_{$i}">
			<?php foreach($list as $vo){ ?>
				<?php $selected = ($vo['id'] == $arrPid[$i-1])?"class='on'":""; ?>
				<li id='node_{$vo.id}' {$selected}><a href='javascript:void(0);' onclick=selectarea("{$vo.id}","{$vo.level}","{$vo.title}") >{$vo.title}</a></li>
			<?php } ?>
		</ul>
		</div>
		<?php $list = $list[$arrPid[$i-1]]['child'] ?>
	<?php } ?>
	
<?PHP }else{ ?>

	<volist id="vo" name="list">
		<li id='node_{$vo.id}'><a href='javascript:void(0);' onclick=selectarea("{$vo.id}","{$vo.level}","{$vo.title}") >{$vo.title}</a></li>
	</volist>
<?PHP } ?>
