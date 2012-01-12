<div class="FSort">
	<div class="tit">
		<?php echo Yii::t('sns','fileaway');?>
	</div>
	<?php if(!empty($date_list)){?>
	<ul id="f_fileaway">
		<li<?php if(empty($_GET['date'])) echo ' class="on"';?>>
			<?php 
			$text = Yii::t('sns','alldate');
			echo CHtml::link($text,array("/$this->url",'uid'=>$_GET['uid'],'gid'=>@$value['id']));?>
		</li>
		<?php foreach($date_list as $date => $value){?>
		<li<?php if($date==@$_GET['date']) echo ' class="on"';?>>
			<?php 
			$text = $value['content'].'('.$value['count'].')';
			echo CHtml::link($text,array("/$this->url",'uid'=>$_GET['uid'],'date'=>$date));?>
		</li>
		<?php }?>
	</ul>
	<?php }?>
	<div class="btm"></div>
</div>