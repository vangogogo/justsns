<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl.'/js/friend_suggest/ui.friendsuggest.js');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl.'/js/friend_suggest/ui.friendsuggest.css');?>
<script>var no_edit = 0;</script>

<script>
	$(document).ready( function(){
		var id ="";

		var test = new giant.ui.friendsuggest({

			btnAll:"#ui-fs<?php echo $id;?> .ui-fs-icon",
			btnCloseAllFriend:"#ui-fs<?php echo $id;?> .ui-fs-all .close",
			btnNextPage:"#ui-fs<?php echo $id;?> .ui-fs-all .next",
			btnPrevPage:"#ui-fs<?php echo $id;?> .ui-fs-all .prev",
			selectFriendType:"#ui-fs-friendtype<?php echo $id;?>",
			allFriendContainer:"#ui-fs<?php echo $id;?> .ui-fs-all" ,
			allFriendListContainer:"#ui-fs<?php echo $id;?> .ui-fs-all .ui-fs-allinner div.list",
			frinedNumberContainer:"#ui-fs<?php echo $id;?> .ui-fs-allinner .page b",
			resultContainer:"#ui-fs<?php echo $id;?> .ui-fs-result",
			input:"#ui-fs<?php echo $id;?> .ui-fs-input input",
			inputContainer:"#ui-fs<?php echo $id;?> .ui-fs-input",
			dropDownListContainer:"#ui-fs<?php echo $id;?> .ui-fs-list",
			inputDefaultTip:"输入好友姓名",
			noDataTip:"您的好友列表中不存在该好友",

			totalSelectNum:5,
			ajaxBefore:null,
			ajaxError:null,
			selectType:"multiple",


			ajaxUrl: "<?php echo Yii::app()->createUrl('/friend/ajax')?>",
			ajaxLoadAllUrl: "<?php echo Yii::app()->createUrl('/friend/getAllFriends')?>",
			ajaxGetCountUrl: "<?php echo Yii::app()->createUrl('/friend/getCountUrl')?>",
			ajaxGetFriendTypeUrl: "<?php echo Yii::app()->createUrl('/friend/getFriendType')?>",
			selectCallBack:function(fid, name, image) {
				Alert("您选择的好友ID为"+fid);
				this.setDropDownListHide();
				this.setAllFriendHide();
			}
		});

		if( $( '#ui_fri_ids<?php echo $id;?>' ).val() ){
		  $( '.ui-fs-result' ).css( 'display','block' );
		}
	});

/*function chooseAll(){Alert('123');
}
function cancelAll(){Alert('456');
}*/
</script>


<!-- 选择好友组件-->
<!--<div class="ui-fs-result clearfix" style="display:none;" id="show_choose"></div>-->
<div id="ui-fs<?php echo $id;?>" class="ui-fs">
	<div class="ui-fs-result clearfix" style="display:none;"></div>
	<div class="ui-fs-input">
		<input type="text" value="输入好友姓名" maxlength="30" />
		<a class="ui-fs-icon" href="javascript:void(0)" title="查看所有好友">查看所有好友</a>
	</div>
	<div class="ui-fs-list">
		数据加载中....
	</div>
	<div class="ui-fs-all">
		<div class="top">
			<select id="ui-fs-friendtype<?php echo $id;?>"><option value="-1">所有好友</option></select>
<!--			<input id="chooseAll" type="checkbox" onclick="parent.chooseAll();" />全选-->
<!--			<input id="cancelAll" type="checkbox" onclick="parent.cancelAll();" />全不选-->
			<div class="close" title="关闭">关闭</div>
		</div>
		<div class="ui-fs-allinner">
			<div class="page clearfix">
				<div class="llight1">还有<b id="ui_fri_num">5</b>人可选</div>
				<div class="button"><span class="prev">上一页</span><span class="next">下一页</span></div>
			</div>
			<div class="list clearfix">
				数据加载中...
			</div>
		</div>
	</div>
</div>
<!--选择好友组件 end-->

<input type="hidden" id="ui_fri_ids<?php echo $id;?>" name="fri_ids<?php echo $id;?>"  dataType="LimitB" min="1"  msg="必须选择用户!"> 

<!-- <input type="hidden" id="<?php echo $id;?>" name="fri_ids<?php echo $id;?>"  dataType="LimitB" min="1"  msg="必须选择用户!"> -->