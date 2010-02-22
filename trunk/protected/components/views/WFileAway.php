<div class="FSort">
	<div class="tit">
		<?php echo Yii::t('sns','fileaway');?>
	</div>
	<?php if(!empty($values)){?>
	<ul id="f_fileaway">
		<li<?php if(empty($_GET['date'])) echo ' class="on"';?>>
			<?php echo Yii::t('c','alldate');?>
		</li>
		<?php if(!empty($dates)) foreach($dates as $value){?>
		<li<?php if($value['id']==$_GET['gid']) echo ' class="on"';?>>
			<?php 
			$text = $value['content'].'('.$value['count'].')';
			echo CHtml::link($text,array("/$this->url/index",'gid'=>$value['id']));?>
		</li>
		<?php }?>
	</ul>
	<?php }?>
	<div class="btm"></div>
</div>