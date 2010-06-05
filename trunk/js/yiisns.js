$(function() {

});

//jQuery UI 弹出框

function Alert(message,title){

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