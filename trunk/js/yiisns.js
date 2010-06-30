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
		//modal: true,
		resizable:false,
		autoOpen: false,
		overlay: {
			opacity: 0.8,
			background: "black"
		},
		buttons: {
			'确定': function() {
				callback.call();
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
				callback.call();
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