<?php
	include('_top.php');
?>
  <div class="groupBox">
  	<div class="sidebar">
        <div class="FSort">
    	<div class="tit">创始人与管理员</div>
		<ul class="pic_list">
			<?php if(is_array($adminList)): ?><?php $i = 0;?><?php $__LIST__ = $adminList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$member): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li><span class="headpic50"><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><img src="<?php echo (getUserFace($member["uid"])); ?>" /></a></span><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><?php echo (getUserName($member["uid"])); ?></a></li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
       	  </ul>
          <div class="more"><a href="__APP__/Member/index/gid/<?php echo ($gid); ?>">所有成员>></a></div>
		  <div class="btm"></div>
        </div>
        <div class="FSort">
    	<div class="tit">新加入成员</div>
		<ul class="pic_list">
			<?php if(is_array($newJoinList)): ?><?php $i = 0;?><?php $__LIST__ = $newJoinList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$member): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li><span class="headpic50"><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><img src="<?php echo (getUserFace($member["uid"])); ?>" /></a></span><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><?php echo (getUserName($member["uid"])); ?></a></li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
       	  </ul>
          <div class="more"><a href="__APP__/Member/index/gid/<?php echo ($gid); ?>">所有新成员>></a></div>
		  <div class="btm"></div>
        </div>
        <div class="FSort">
    	<div class="tit">最近访问成员</div>
		<ul class="pic_list">
			<?php if(is_array($recentVList)): ?><?php $i = 0;?><?php $__LIST__ = $recentVList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$member): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li><span class="headpic50"><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><img src="<?php echo (getUserFace($member["uid"])); ?>" /></a></span><a href="__TS__/space/<?php echo ($member["uid"]); ?>"><?php echo (getUserName($member["uid"])); ?></a><em><?php echo date('H:i:s',$member['mtime']);?></php></em></li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
  

       	  </ul>
		  <div class="btm"></div>
        </div>
        
    </div>
  <div class="boxL" style="width:640px;">
	<?php if(t($groupinfo['announce'])!=''){ ?>
	<div class="box1">
		<h3>群公告</h3>
		<div class="pl10"><?php echo (stripslashes($groupinfo['announce'])); ?></div>
	</div>
	<?php } ?>
  	
	<div class="box1">
  	<h3>成员动态</h3>
  		<ul class="list pl10">
  		  <?php if(is_array($groupFeed)): ?><?php $i = 0;?><?php $__LIST__ = $groupFeed?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$feed): ?><?php ++$i;?><?php $mod = ($i % 2 )?><?php if($feed['type'] == 'group_join' ): ?><li class="btmlineD">
                                 <div class="right alR" style="width:14%;"><em><?php echo date('m-d H:i',$feed['cTime']);?></em></div>
       	     	<div class="cGray2" style="width:85%;"><?php echo (stripGroupName($feed["title"])); ?></div>
       	     	
       	     </li>
                	  		<?php else: ?>                     
                       			 <li class="btmlineD">
                                 <div class="right alR" style="width:14%;"><em><?php echo date('m-d H:i',$feed['cTime']);?></em></div>
       	     	<div class="cGray2" style="width:85%;"><?php echo (stripGroupName($feed["title"])); ?>:  <?php echo ($feed["body"]); ?></div>
       	     	
       	     </li><?php endif; ?><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
        </ul>
    </div>
    <div class="box1">
  	<h3>群话题区(共<?php echo ($threadCount); ?>条)</h3>
  		<ul class="ul">
       	<?php if(!$threadList) { ?>
  		
       	  <li>  还没有话题，你可以发表话题</li>
       	<?php } else{ ?>
       	 <li>
   	    	<div class="c1">话题</div>
            <div class="c2">浏览</div>
            <div class="c3">回复</div>
            <div class="c4">作者</div>
            <div class="c5">回复时间</div>
       	  </li>
        <?php if(is_array($threadList)): ?><?php $i = 0;?><?php $__LIST__ = $threadList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$thread): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li>
   	    	<div class="c1 OverH"><?php if($thread['top']){ ?>  <span class="zd">顶</span>  <?php } ?>
   	    		<?php if($thread['dist']){ ?>  <span class="jh">精</span> <?php } ?><a href="__APP__/Topic/topic/gid/<?php echo ($gid); ?>/tid/<?php echo ($thread["id"]); ?>"><?php echo (msubstr($thread["title"],0,20)); ?></a></div>
            <div class="c2"><?php echo ($thread['viewcount']); ?></div>
            <div class="c3"><?php echo ($thread['replycount']); ?></div>
            <div class="c4"><a href="__TS__/space/<?php echo ($thread["uid"]); ?>"><img src="<?php echo (getUserFace($thread["uid"])); ?>" width="20px" height="20px"/></a> <a href="__TS__/space/<?php echo ($thread["uid"]); ?>"><?php echo (getUserName($thread["uid"])); ?></a></div>
            <div class="c5"><?php echo (friendlyDate($thread["replytime"])); ?></div>
       	  </li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
       	<?php } ?>
        </ul>
        <div class="alR lh30"><a href="__APP__/Topic/add/gid/<?php echo ($gid); ?>">发表话题</a> ┊<a href="__APP__/Topic/index/gid/<?php echo ($gid); ?>"> 进入话题区>></a></div>
    </div>
    
    <?php if( $groupinfo['openAlbum'] ): ?><div class="box1">
  	<h3>群相册(共<?php echo ($photoCount); ?>张)</h3>
  		<ul class="piclist">
  		<?php if(is_array($photoList)): ?><?php $i = 0;?><?php $__LIST__ = $photoList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$photo): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li>
   	    	 <a href="__APP__/Photo/getPhoto/gid/<?php echo ($gid); ?>/albumId/<?php echo ($photo["albumId"]); ?>/photoId/<?php echo ($photo["id"]); ?>" class="preview" rel="<?php echo (get_photo_url($photo["savepath"])); ?>" title="<?php echo ($photo["name"]); ?>"><img src="__ROOT__/thumb.php?w=134&h=91&t=f&url=<?php echo (get_photo_url($photo["savepath"])); ?>"/></a><br /><a href="__APP__/Photo/getPhoto/gid/<?php echo ($gid); ?>/albumId/<?php echo ($photo["albumId"]); ?>/photoId/<?php echo ($photo["id"]); ?>"><?php echo (msubstr($photo["name"],0,13)); ?></a>
   	    </li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
        </ul>
        <div class="alR lh30"><a href="__APP__/Photo/upload/gid/<?php echo ($gid); ?>">上传照片</a> ┊<a href="__APP__/Album/index/gid/<?php echo ($gid); ?>">进入群相册>></a></div>
    </div><?php endif; ?>
    
    
    <?php if( $groupinfo['openUploadFile'] ): ?><div class="box1">
  	<h3>群文件(共<?php echo ($fileCount); ?>个)</h3>
    	<p class="cGray2"> 该群还没有人上传文件 <a href="__APP__/Dir/upload/gid/<?php echo ($gid); ?>">上传文件</a></p>
  		<ul class="file">
  		  	<?php if(!$fileList) { ?>
  		
       	   <li>  还没有文件</li>
       	 <?php } else{ ?>
  		
       	  <li>
   	    	<div class="c1">文件名称</div>
            <div class="c2">大小</div>
            <div class="c3"></div>
       	  </li>
       	  <?php if(is_array($fileList)): ?><?php $i = 0;?><?php $__LIST__ = $fileList?><?php if( count($__LIST__)==0 ) : echo "" ; ?><?php else: ?><?php foreach($__LIST__ as $key=>$file): ?><?php ++$i;?><?php $mod = ($i % 2 )?><li>
   	    	<div class="c1"><img src="../Public/images/icon/<?php echo ($file["filetype"]); ?>.gif" /> <a href="__APP__/Dir/file/gid/<?php echo ($gid); ?>/fid/<?php echo ($file["id"]); ?>"><?php echo ($file["name"]); ?></a></div>
            <div class="c2"><?php echo (formatsize($file["filesize"])); ?></div>
            <div class="c3"><a href="javascript: download(<?php echo ($file['id']); ?>);">下载</a></div>
       	  </li><?php endforeach; ?><?php endif; ?><?php else: echo "" ;?><?php endif; ?>
       	  <?php } ?>
        </ul>
        <div class="alR lh30"><a href="__APP__/Dir/index/gid/<?php echo ($gid); ?>">进入文件共享区>></a></div>
    </div><?php endif; ?>
    
    </div>
  <!-- end  -->
  </div>  </div><!-- 右侧内容 end  -->