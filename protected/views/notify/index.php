<?php include('_top.php');?>
<?php if(!empty($notifys)){?>
	<ul>

	</ul>
	<div class="baikeUserPage">
		<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
	</div>
<?php }?>
<!-- 通知列表 end  -->
<script>
	function agreeFri(fuid,nid){
		Win({message:'__APP__/Friend/isAdd/uid/'+fuid+'/nid/'+nid+'/t/agree',width:392,height:220,title:'加为好友',handler:function(){ymPrompt.close();},autoClose:false,iframe:true,allowRightMenu:true});
	}

	function ignoreFri(uid,nid){
		Confirm({message:'确认忽略这条好友请求?',handler:function(tp){
				if(tp=='ok'){
					$.post(APP+"/Friend/ignoreFriend",{nid:nid,uid:uid},function(txt){
						if(txt == 1){
							Alert("忽略成功!");
							setTimeout(function(){ parent.ymPrompt.close(); },1500);
							location.reload();
						}else{
							Alert("忽略失败!");
						}
					});
				}
				if(tp=='cancel'){
					ymPrompt.close();
				}
				if(tp=='close'){
					ymPrompt.close();
				}
			}});
	}

	function set_group(fuid,nid){
		Win({message:'__APP__/Friend/setGroup/fuid/'+fuid+'/nid/'+nid,width:392,height:220,title:'加为好友',handler:function(){ymPrompt.close();},autoClose:false,iframe:true,allowRightMenu:true});
	}

	//删除某条动态
	function del_notify(id) {
		$.post(URL+"/del_notify",{id:id},function(txt){
			if(txt == 1){
				$("#notify_"+id).hide("slow");
			 }else{
				Error("删除失败!");
			 }
		});
	}


</script>






