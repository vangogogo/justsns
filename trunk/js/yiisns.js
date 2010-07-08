$(function(){
	//AJAX全局事件
	
	$("body").bind("ajaxStart", function(){
		AjaxSend();
	}).bind("ajaxSuccess", function(e, xhr, o){
		if (xhr.responseText != -1) {
			AjaxSuccess();
		}
		else {
			AjaxError();
		}
	}).bind("ajaxError", function(){
		AjaxError();
	});
	
	/*
	 事件的顺序如下：
	 ajaxStart 全局事件
	 开始新的Ajax请求，并且此时没有其他ajax请求正在进行。
	 beforeSend 局部事件
	 当一个Ajax请求开始时触发。如果需要，你可以在这里设置XHR对象。
	 ajaxSend 全局事件
	 请求开始前触发的全局事件
	 success 局部事件
	 请求成功时触发。即服务器没有返回错误，返回的数据也没有错误。
	 ajaxSuccess 全局事件
	 全局的请求成功
	 error 局部事件
	 仅当发生错误时触发。你无法同时执行success和error两个回调函数。
	 ajaxError 全局事件
	 全局的发生错误时触发
	 complete 局部事件
	 不管你请求成功还是失败，即便是同步请求，你都能在请求完成时触发这个事件。
	 ajaxComplete 全局事件
	 全局的请求完成时触发
	 ajaxStop 全局事件
	 当没有Ajax正在进行中的时候，触发。
	 */
	/*
	 $("#ajaxStateID").ajaxStart(function(){
	 $(this).text("ajaxStart");
	 alert("ajaxStart");
	 }).ajaxSend(function(){
	 $(this).text("ajaxSend");
	 alert("ajaxSend");
	 }).ajaxSuccess(function(){
	 $(this).text("ajaxSuccess");
	 alert("ajaxSuccess");
	 }).ajaxError(function(){
	 $(this).text("ajaxError");
	 alert("ajaxError");
	 }).ajaxComplete(function(){
	 $(this).text("ajaxComplete");
	 alert("ajaxComplete");
	 }).ajaxStop(function(){
	 $(this).text("ajaxStop");
	 alert("ajaxStop");
	 });
	 */
	//确认删除
	$('.a_confirm_link').live('click', function(){
		self = $(this);
		message = self.attr('title');
		url = self.attr('href');
		Confirm({
			message: message,
			handler: function(button){
				$.get(url, '', function(result){
					Alert(result)
				});
			}
		});
		return false;
	});
	
	$('.a_alert_link').live('click', function(){
		self = $(this);
		message = self.attr('title');
		url = self.attr('href');
		$.get(url, '', function(result){
			if (result == 1) {
				Alert(message + '成功', '标题', function(){
					reload();
				});
			}
			else {
				Alert(message + '失败');
			}
			
		});
		return false;
	});
});

function reload(){
	window.location.reload();
}

//jQuery UI 弹出框

function Alert(message, title, callback){

	$("#dialog").dialog("destroy");
	if ($("#dialog-message").length == 0) {
		$("body").append('<div id="dialog-message"></div>');
	}
	
	$("#dialog-message").dialog({
		title: '消息框',
		modal: true,
		resizable: false,
		autoOpen: false,
		overlay: {
			opacity: 0.8,
			background: "black"
		},
		buttons: {
			'确定': function(){
				$(this).dialog('close');
			}
		}
	});
	
	$("#dialog-message").html(message);
	$("#dialog-message").dialog("open");
}

function Confirm(object, callback){
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
		resizable: false,
		overlay: {
			opacity: 0.8,
			background: "black"
		},
		buttons: {
			"确定": function(){
				if (typeof(callback) == "function") {
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

function AjaxPnotify(options, test){
	//	$('.ajax-show').show();
	if (test) 
		var body_data = $("body").data("AjaxPnotify");
	if (body_data && body_data.length) {
		var AjaxPnotify = body_data.pnotify(options);
	}
	else {
		var AjaxPnotify = $.pnotify(options);
	}
	$("body").data("AjaxPnotify", AjaxPnotify);
}

/*<![CDATA[*/
function AjaxSend(){
	var options = {
		pnotify_text: '数据读取中 请稍候...',
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'loadingbar',
		pnotify_opacity: 1,
		pnotify_delay: 500,
		pnotify_type: "notice",
		pnotify_width: "200px",
	};
	AjaxPnotify(options, false);
}

function AjaxError(){
	var options = {
		pnotify_text: '操作失败...',
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'errorbar',
		pnotify_opacity: 1,
		pnotify_delay: 500,
		pnotify_type: "notice",
		pnotify_width: "150px",
	};
	AjaxPnotify(options, true);
	return false;
}

function AjaxSuccess(){
	var options = {
		pnotify_text: '操作完成...',
		pnotify_addclass: "ajax-show",
		pnotify_notice_icon: 'successbar',
		pnotify_opacity: 1,
		pnotify_delay: 500,
		pnotify_type: "notice",
		pnotify_width: "200px",
	};
	AjaxPnotify(options, true);
	return false;
}

/*]]>*/

function showloading2(wating){

	if ($("#ajax-show").length == 0) {
		$("body").append('<div id="ajax-show" class="ui-widget-content ui-corner-all"><div id="ajax-show-content" class="ui-widget-header ui-corner-all">Show</div></div>');
	}
	
	
	
	$("#ajax-show-content").html(wating);
	//get effect type from 
	var selectedEffect = 'highlight';
	
	//most effect types need no options passed by default
	var options = {};
	//check if it's scale or size - they need options explicitly set
	if (selectedEffect == 'scale') {
		options = {
			percent: 100
		};
	}
	else 
		if (selectedEffect == 'size') {
			options = {
				to: {
					width: 280,
					height: 185
				}
			};
		}
	
	//run the effect
	$("#ajax-show").show(selectedEffect, options, 500, showloading_callback);
	//Alert(wating);
}

function showloading_callback(){
	setTimeout(function(){
		$("#ajax-show:visible").removeAttr('style').hide().fadeOut();
	}, 5000);
};
