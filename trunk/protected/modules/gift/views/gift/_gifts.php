<div class="giftblock row" id='gifts<?php echo $category['id'];?>'>
	<ul>
		<?php foreach ($category['gifts'] as $key => $gift):?>
			<li class='gifts hand' title="点击选择" id="gift<?php echo $gift['id'];?>" onclick="sendGift(<?php echo $gift['id'];?>)">
				<?php echo CHtml::image($this->image_dir.$gift->img,$gift->name,array('desc'=>$gift->desc));?>
				<br/>
				<?php echo $gift['name'];?>
				<br/>
				限量：<?php echo $gift['num'];?>个
			</li>
		<?php endforeach;?>
		<div class="clear"></div>
	</ul>
</div>
<div class="clear"></div>
