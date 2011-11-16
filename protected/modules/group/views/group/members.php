<h1><?php echo $group['name'];?></h1>
<div class="grid_15 suffix_1">
    <?php if(!empty($members)):?>
    <div class="obss">
        <?php foreach($members as $member):?>
        <dl class="obu">

            <dt>
	            <?php $this->widget('WUserFace',array('uid'=>$member['uid'],'user'=>$member->user)); ?>
           </dt>
            <dd>
                <?php echo $member->user->getSpaceUrlWithName();?>
            </dd>
        </dl>
        <?php endforeach;?>
    </div>
    <?php endif;?>
</div>
<div class="grid_8">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
