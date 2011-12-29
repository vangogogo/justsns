<h1><?php echo $group['name'];?> 成员管理</h1>
<div class="content">
	<?php include '_top.php';?>	

    <?php if(!empty($boss)): $member = $boss?>
		<h3>组长</h3>
	    <div class="row obss">
	        <dl class="obu">
	            <dt>
		            <?php $this->widget('WUserFace',array('uid'=>$member['uid'],'user'=>$member->user)); ?>
	           </dt>
	            <dd>
	                <?php echo $member->user->getSpaceUrlWithName();?>
	            </dd>
	        </dl>
	    </div>
    <?php endif;?>
    
    <?php if(!empty($admins)):?>
		<h3>管理员</h3>
	    <div class="row obss">
	        <?php foreach($admins as $member):?>
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

    <?php if(!empty($members)):?>
		<h3>组员</h3>
	    <div class="row obss">
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
<div class="sidebar">
	<?php $this->widget('WGroupShowSidebar',array('gid'=>$group['id'])); ?>
</div>
