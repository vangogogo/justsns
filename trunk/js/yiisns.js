$(function(){
    $( "input:submit, button, input.btn, input.btn_w").button();
    $(".radioset").buttonset();

	(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var self = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "";
				var input = this.input = $( "<input>" )
					.insertAfter( select )
					.val( value )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							self._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item ) {
								var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" ),
									valid = false;
								select.children( "option" ).each(function() {
									if ( $( this ).text().match( matcher ) ) {
										this.selected = valid = true;
										return false;
									}
								});
								if ( !valid ) {
									// remove invalid value, as it didn't match anything
									$( this ).val( "" );
									select.val( "" );
									input.data( "autocomplete" ).term = "";
									return false;
								}
							}
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li></li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				this.button = $( "<button type='button'>&nbsp;</button>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.insertAfter( input )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-button-icon" )
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							return;
						}

						// work around a bug (likely same cause as #5265)
						$( this ).blur();

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});
			},

			destroy: function() {
				this.input.remove();
				this.button.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );

    $( ".combobox" ).combobox();

//	$( "input:submit, a, button, input.btn", ".demo" ).button();
//	$( "a", ".demo" ).click(function() { return false; });
	$("a.thickbox").fancybox({
        
		'scrolling'	      : 'no',
		'speedIn'				: 1,
		'speedOut'				: 1,			
		'changeSpeed'			: 10,
		'changeFade'			: 10,
		'href'            : $(this).href,
		 ajax             : {
			type : "GET"
		}
		
	});	

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

    $('.user-group-arrow-btn')
		.button( {
			text: false,
			icons: {
				primary: "ui-icon-triangle-1-s"
			}
		})


	$('.set-group-list input:checkbox').live('click',function() {
        var gid = $(this).data("gid");
        var fuid = $(this).data("fuid");
        var status = $(this).data("status");
        var self = $(this);
        if(status != '1')
        {
            var url = 'addtogroup';
        }
        else
        {
            var url = 'delfromgroup';
        }
        var new_status  = 1 - status;
        self.data("status",new_status);
		$.post(url, {
			gid : gid,
			fuid : fuid,
		}, function(text) {
			if (text != -1) {
				//Alert("操作成功");
                var selectedEffect = 'highlight';
			    var options = {};

                self.parent('li').effect( selectedEffect, options, 800 )
			} else {
				//Alert("无法加载全部回复");
			}
		})
	});
    $('.user-opt').click(function() {
	   //$('.set-group-list').hide();
    })
    $('.user-group-arrow-btn').click(function() {
	   $(this).next('.set-group-list').toggle();
    })

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
		modal: false,
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
		modal: false,
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


function _cklogin(){
    $.fancybox({
        'scrolling'       : 'no',
        'href'            : '/user/login',
         ajax             : {
            type : "GET"
        }
        
    }); 
}
