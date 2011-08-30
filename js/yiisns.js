$(function(){
	//AJAX全局事件
	/*
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
	*/
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
                window.location.href=url;
                /*
				$.get(url, '', function(result){
					if(result == 1)
					{
						//Alert('操作成功...');
					}
					else if($result == -1)
					{
						//Alert('操作失败...');
					}
					else
					{
						Alert(result)
					}
				});
                */
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
function test()
{
					selector	= href.split('#', 2);
					data		= selectedOpts.ajax.data || {};

					if (selector.length > 1) {
						href = selector[0];

						if (typeof data == "string") {
							data += '&selector=' + selector[1];
						} else {
							data.selector = selector[1];
						}
					}

					busy = false;
					$.fancybox.showActivity();

					ajaxLoader = $.ajax($.extend(selectedOpts.ajax, {
						url		: href,
						data	: data,
						error	: fancybox_error,
						success : function(data, textStatus, XMLHttpRequest) {
							if (ajaxLoader.status == 200) {
								tmp.html( data );
								fancybox_process_inline();
							}
						}
					}));
}

function checkJsToken(txt) {
		if(txt == 'error'){
				Alert('请不要频繁提交');
				$( '.btn_big').removeAttr('disabled');
				return false;
		}
		if(txt == 'fail'){
				Alert('说得太快了。休息会吧');
				$( '.btn_big').removeAttr('disabled');
				return false;
		}
		return true
}
