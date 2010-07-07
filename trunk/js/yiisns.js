$(function() {
	var notice = 'test';
	//确认删除
	$('.a_confirm_link').live('click',function(){
		self = $(this);
		message = self.attr('title');
		url = self.attr('href');
		Confirm({message:message,handler:function(button){
			$.get(url,'',function(result){Alert(result)});
		}});
		return false;
	});
	
	$('.a_alert_link').live('click',function(){
		self = $(this);
		message = self.attr('title');
		url = self.attr('href');
		$.get(url,'',function(result){
			if(result == 1)
			{
				Alert(message+'成功','标题',function(){reload();});
			}
			else
			{
				Alert(message+'失败');
			}
			
		});
		return false;
	});	
});

function reload() {
	window.location.reload();
}
//jQuery UI 弹出框

function Alert(message,title,callback){

	$("#dialog").dialog("destroy");
	if ($("#dialog-message").length == 0) {
		$("body").append('<div id="dialog-message"></div>');
	}
	
	$("#dialog-message").dialog({
		title: '消息框',
		modal: true,
		resizable:false,
		autoOpen: false,
		overlay: {
			opacity: 0.8,
			background: "black"
		},
		buttons: {
			'确定': function() {
				$(this).dialog('close');
			}
		}
	});

	$("#dialog-message").html(message);
	$("#dialog-message").dialog("open");
}

function Confirm(object,callback){
	var message = object.message;
	var callback = object.handler;

	$("#dialog").dialog("destroy");
	if ($("#dialog-confirm").length == 0) {
		$("body").append('<div id="dialog-confirm"></div>');
	}
	
	$("#dialog-confirm").dialog({
		autoOpen: false,
		title: '消息框',
		modal: true,
		resizable:false,
		overlay: {
			opacity: 0.8,
			background: "black"
		},
		buttons: {
			"确定": function(){
				if(typeof(callback)=="function")
				{
					callback.call();
				}
				$(this).dialog("close");
			},
			"取消": function(){
				$(this).dialog("close");
			}
		}
	});

	$("#dialog-confirm").html(message);
	$("#dialog-confirm").dialog("open");
}

function showloading(wating) {
	//$.pnotify_remove_all();
	var options = {
		pnotify_text: wating,
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'loadingbar',
		pnotify_hide: true,
		pnotify_closer: true,
		pnotify_remove: true,
		pnotify_opacity: 1,
		pnotify_delay: 100,
		pnotify_type: "notice",
		pnotify_width: "250px",
		pnotify_history: false,
	};
	var notice = $.pnotify(options);
}

function showComplete(wating) {
	$.pnotify_remove_all();
	var options = {
		pnotify_text: wating,
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'successbar',
		pnotify_hide: true,
		pnotify_closer: true,
		pnotify_remove: true,
		pnotify_opacity: 1,
		pnotify_delay: 100,
		pnotify_type: "notice",
		pnotify_width: "250px",
		pnotify_history: false,
	};
	
	var notice = $.pnotify(options);
	notice.pnotify_remove();
}

/*<![CDATA[*/
function myBeforeSend(){
	showloading('数据读取中 请稍候...');
}
function myComplete(){
	showComplete('操作完成...');
	return false;
}
/*]]>*/

function showloading2(wating) {
	
	if ($("#ajax-show").length == 0) {
		$("body").append('<div id="ajax-show" class="ui-widget-content ui-corner-all"><div id="ajax-show-content" class="ui-widget-header ui-corner-all">Show</div></div>');
	}

	$("#ajax-show-content").html(wating);
	//get effect type from 
	var selectedEffect = 'highlight';
	
	//most effect types need no options passed by default
	var options = {};
	//check if it's scale or size - they need options explicitly set
	if(selectedEffect == 'scale'){  options = {percent: 100}; }
	else if(selectedEffect == 'size'){ options = { to: {width: 280,height: 185} }; }
	
	//run the effect
	$("#ajax-show").show(selectedEffect,options,500,showloading_callback);
	//Alert(wating);
}

function showloading_callback(){
	setTimeout(function(){
		$("#ajax-show:visible").removeAttr('style').hide().fadeOut();
	}, 5000);
};