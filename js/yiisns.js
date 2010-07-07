var AjaxPnotify;

$(function() {
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

function AjaxPnotify(options,test) {
//	$('.ajax-show').show();
	if(test)
	var body_data = $("body").data("AjaxPnotify");
	if (body_data && body_data.length) {
		var AjaxPnotify = body_data.pnotify(options);
	}
	else
	{
		var AjaxPnotify = $.pnotify(options);
	}

	$("body").data("AjaxPnotify", AjaxPnotify);
}

/*<![CDATA[*/
function AjaxBeforeSend(){
	
	var options = {
		pnotify_text: '数据读取中 请稍候...',
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'loadingbar',
		pnotify_opacity: 1,
		pnotify_delay: 500,
		pnotify_type: "notice",
		pnotify_width: "250px",
//			pnotify_history: false,
	};
	
	AjaxPnotify(options,false);
}
function AjaxComplete(){
	showComplete('操作完成...');
	return false;
}
function AjaxError(){
	showComplete('操作完成...');
	return false;
}
function AjaxSuccess(){
	var options = {
		pnotify_text: '操作完成22...',
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'successbar',
		pnotify_opacity: 1,
		pnotify_delay: 500,
		pnotify_type: "notice",
		pnotify_width: "250px",
//		pnotify_history: false,
	};
	
	AjaxPnotify(options,true);
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