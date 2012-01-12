var oddReply = "";
var lastinput = "";
var touid = 0;

var doAddReply_url = TS+"/mini/doAddReply";
var getReply_url = TS+"/mini/GetReply";
var doDeleteReply_url = TS+"/mini/DoDeleteReply";
var doDeleteMini_url = TS+"/mini/DoDeleteMini";
var getReplyCount_url = TS+"/mini/getReplyCount";
$(document).ready(function() {
	$(".input_box > textarea").val("添加回复");
	$('#mini-coment').click(function() {
		//$('.jishuan').show();
		bq_show();
	});

	$("#mini-coment").blur(function() {
		if (!$("#mini-coment").val()) {
			$(".phiz").hide();
			//$('.jishuan').hide();
		}
		
	})

	$(".MC").mouseover(function() {
		var id = $(this).attr('id').substring(3);
		$('#d-' + id).show();
	});

	$(".MC").mouseout(function() {
		var id = $(this).attr('id').substring(3);
		$('#d-' + id).hide();
	});
	$('.inputReply').click(function() {
		replyShow($(this));
	});
	$('.inputReply').blur(function() {
		replyHide($(this));
	})
	$('.RLI').mouseover(function() {
		var id = $(this).attr('id');
		$('#d-' + id).show();
	});
	$('.RLI').mouseout(function() {
		var id = $(this).attr('id');
		$('#d-' + id).hide();
	});

});

/**
 * delete 删除自己的心情
 * 
 * @param id
 *            $id
 * @access public
 * @return void
 */
function deleteMini(id) {
	Confirm( {
		message : '是否删除此心情',
		handler : function(button) {
			$.post(doDeleteMini_url, {
				id : id
			}, function(text) {
				if (text == 1) {
					$('#Fli' + id).hide("slow");
				} else {
					Alert("删除失败");
				}
			});
		}
	});
}

/**
 * bq_show 表情框显示
 * 
 * @access public
 * @return void
 */
function bq_show() {
	$(".phiz").show().mouseover(function() {
		$("#mini-coment").unbind("blur");
	}).mouseout(function() {
		$("#mini-coment").blur(function() {
			if (!$("#mini-coment").val()) {
				$(".phiz").hide();
				//$(".jishuan").hide();
			}
		});
	});
}

/**
 * 计算字符串长度的函数
 * 
 */
function JHshStrLen(sString) {
	var sStr, iCount, i, strTemp;

	iCount = 0;
	sStr = sString.split("");
	for (i = 0; i < sStr.length; i++) {
		strTemp = escape(sStr[i]);
		if (strTemp.indexOf("%u", 0) == -1) {
			iCount = iCount + 1;
		} else

		{
			iCount = iCount + 2;
		}
	}
	return iCount;
}

/**
 * 表情的插入
 * 
 */
function insert(_this) {
	var emotion = $(_this).attr("emotion");
	var old_con = $("#mini-coment").val();
	var new_con = old_con + emotion;
	$("#mini-coment").val(new_con);
}

function doAdd() {
	var content = $('#mini-coment').val();
	// 检测合法性

	if (!content) {
		Alert("不能为空哦~~~");
		return;
	}
	if (content.length > mini_zishu) {
		Alert("不能多于"+mini_zishu+"个字哦~~~");
		return;
	}

	$('.btn_big').attr('disabled', true);
	$(".phiz").hide();
	//$(".jishuan").hide();

	// POST提交
	$.post(doAddMini_url, {
		content : content
	}, function(txt) {
		if (false == checkJsToken(txt)) {
			$('.btn_big').removeAttr('disabled');
			return true;
		}
		if (txt) {
			$('#mini-content').html(txt);
			$('#mini-time').html('刚刚');
			$('#mini-coment').val('');
			$('#zishu').html(mini_zishu);
			$('.btn_big').removeAttr('disabled');
		} else {
			Alert("提交失败");
			$(this).removeAttr('disabled');
		}
	});

}
function replyShow(_this) {
	_this.attr('style', "height:50px; line-height:25px; width:325px;");
	// _this.removeClass();
	id = _this.attr('id').substring(5);

	if (_this.val() == "添加回复")
		_this.val("");
	_this.css('color', '#000');
	// _this.focus();
	$('#image' + id).show();
	$('#button' + id).show();

}
function replyHide(_this) {
	if (!_this.val()) {
		// _this.addClass( 'cGray2' );
		_this.attr('style', "height:25px; line-height:25px; width:368px;").val(
				"添加回复");
		id = _this.attr('id').substring(5);

		$('#image' + id).css('display', "none");
		$('#button' + id).css('display', "none");
	}
}

function reply(uid, mini_id) {
	$('.inputReply').blur();
	touid = uid;
	var obj = $('#input' + mini_id);
	// Alert(obj.html());
	replyShow(obj);
	if (uid != "false") {
		old_con = obj.val();
		// 通过:号分割，不能同时回复几个人
		array = old_con.split(":");
		new_con = "@" + $('.name' + uid).html();
		if (array[0] != new_con) {
			if (array[1]) {
				obj.val(new_con + ":" + array[1]);
			} else {
				obj.val(new_con + ":");
			}
		}
	} else {
		obj.focus();
	}

}
function getFilePath(num) {
	var dis = num.replace(/\[f\](\d*)\[\/f\]/g, '$1');
	return "<img wigth ='20' height='20' src='" + $('#' + dis).attr('src')
			+ "'/>";
}

function showMore(id, uid) {
	var str = 'loading........';
	if($('#showMore' + id).html() != str)
	{
		$('#showMore' + id).html(str);
		$.post(getReply_url, {
			object_id : id,
			uid : uid
		}, function(text) {
			if (text != -1) {
				$('#showMore' + id).hide();
				$('#first' + id).after(text);
				deleteMouse();
				$('#last' + id).hide();
				$('#button' + id).attr('showmore', false);
			} else {
				Alert("无法加载全部回复");
			}
		})
	}
}

function replyComment(object_id, more, mid) {
	// 获得数据
	// 评论内容
	var content = $('#input' + object_id).val();
	var name = $('#name').val();
	var page = $('#page').val();
    var js_token = 0;
	showmore = $('#button' + id).attr('showmore');
	$("#button" + object_id).attr('readonly', true).val("loading...");
	// 只需要直接返回新的回复html格式就可以
	$.post(doAddReply_url, {
		toUid : touid,
		content : content,
		object_id : object_id,
		more : showmore,
		mid : mid,
		page : page,
		js_token : js_token
	}, function(txt) {
		if (txt != -1) {
			// Alert("这里有个2");
			$("#button" + object_id).attr('readonly', false).val("回复");
//			$('#showMore' + object_id).hide();
			$('#input' + object_id).val("");
			$("#button" + id).attr('showmore', false);
//			replyHide($('#input' + object_id));
			$("#RC" + object_id).append(txt);
			$('#RC' + object_id).slideDown("normal");
			deleteMouse();
		} else {
			Alert("心情添加失败");
		}
	});

	touid = 0;
}
function deleteMouse() {
	$('.RLI').bind("mouseover", function() {
		var id = $(this).attr('id');
		$('#d-' + id).show();
	});

	$('.RLI').bind("mouseout", function() {
		var id = $(this).attr('id');
		$('#d-' + id).hide();
	});
}
function deleteComment(id, object_id, where, uid) {
	Confirm( {
		message : '是否删除此评论?',
		handler : function(button) {
			$.post(doDeleteReply_url, {
				id : id,
				object_id : object_id
			}, function(txt) {
				if (txt != -1) {
					if (where == 'last') {
						$('#last' + object_id).hide("slow");
					}else if (where == 'first') {
						$('#first' + object_id).hide("slow");
					} else {
						$('#RLI' + id).hide("slow");
					}
				} else {
					Alert("删除失败");
				}
			});
		}
	})
}

// 字数递减和限制字数
function fot(e) {
	// 递减字数
	// var d = document.getElementById("mini-count");
	var c = e.value.length;
	var xxx = mini_zishu - c;
	if (c <= mini_zishu) {
//		str =xxx+"/"+mini_zishu;
		$('#zishu').html(xxx);
	} else {
		e.value = lastinput;
		$('#mini-coment').focus();
		return false;
	}
	lastinput = e.value;
}

var openReply = true;
function closeReply(object_id, uid) {
	// 获取回复数
	if (openReply) {
		$.post(getReplyCount_url, {
			object_id : object_id
		}, function(count) {
			if (count != -1) {
				var text = count + '回复';
				$('#closeReply' + object_id).text(text);
			} else {
				Alert('意外的网路异常');
			}
		});
	} else {
		$('#closeReply' + object_id).text('收起回复');
	}

	$('#RC' + object_id).slideToggle(
			'normal',
			function() {
				$('#showMore' + object_id).hide();
				if ("none" == $(this).css('display')) {
					openReply = false;
				} else {
					// 加载全部
					showMore(object_id,uid);
					openReply = true;
				}
			});
	$('#RLI' + object_id).slideToggle('normal');
}
