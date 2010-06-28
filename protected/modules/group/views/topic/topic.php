<div class="groupBox">
	<div class="box1">
		<h3><span class="right mr5"><input type="button" id="BtnShare_1" onclick="sharePop('1','/thinksns/apps/group/index.php?s=/Topic','1')" class="BtnShare" value="分享"></span><span style="line-height: 30px;">主题：fdas </span></h3>
		<div class="li pt10">
			<div style="width: 8%;" class="left">
				<span class="headpic50">
					<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
						<img title="<?php echo User::model()->getUserName($topic['uid']);?>" src="<?php echo User::model()->getUserFace($topic['uid'],'middle');?>" />
					</a>
				</span>
				<br>
			</div>
			<div style="width: 12%; overflow: hidden;" class="left lh30">
				<a href="<?php echo $this->createUrl('/space/',array('uid'=>$topic['uid']));?>"  class="tips">
					<?php echo User::model()->getUserName($topic['uid']);?>
				</a>
				<br>
				<img alt="管理员" src="http://localhost/thinksns/public/themes/blue/images/icon/groupicon/admin.png">
			</div>
			<div style="width: 80%;" class="left">
				<div class="cGray2 lh30">
					<div class="right">
						楼主
					</div><?php echo friendlyDate('Y-m-d H:i:s',$topic['ctime']);?>
				</div>
				<div style="line-height: 180%;" class="pb10 pt10 f14px">
					<div id="topic_content" style="padding: 0pt 50px 0pt 0pt;">
						<?php echo $topic->getTopicContent();?>
					</div>
				</div>
				<div class="lh35 alR toplineD">
				
					<?php if($isadmin) { ?>
						<a href="__URL__/edit/gid/<?php echo ($gid); ?>/tid/<?php echo ($topic['id']); ?>" title="编辑">编辑</a> ┊ 
						<?php if($topic['dist'] == 1) { ?><a id="dist" href="javascript:admin_set('undist');" title="取消精华">取消精华</a> <?php } else { ?> <a id="dist" href="javascript:admin_set('dist');" title="精华">设置精华</a> <?php } ?>┊ 
						<?php if($topic['top'] == 1) { ?><a id="top" href="javascript:admin_set('untop');" title="取消置顶">取消置顶</a> <?php } else { ?> <a id="top" href="javascript:admin_set('top');" title="置顶">置顶</a> <?php } ?>┊ 
						<?php if($topic['lock'] == 1) { ?><a id="top" href="javascript:admin_set('unlock');" title="取消锁定">取消锁定</a> <?php } else { ?> <a id="top" href="javascript:admin_set('lock');" title="锁定">锁定</a> <?php } ?>┊ 
						<a href="javascript:delThread(<?php echo ($gid); ?>,<?php echo ($tid); ?>);" title="删除">删除</a> ┊
					<?php } elseif($this->mid == $topic['uid']) { ?>
						<a href="__URL__/edit/gid/<?php echo ($gid); ?>/tid/<?php echo ($topic['id']); ?>" title="编辑">编辑</a> ┊
						<a href="javascript:delThread(<?php echo ($gid); ?>,<?php echo ($tid); ?>);" title="删除">删除</a> ┊
					<?php } ?>

					<?php if($topic['lock'] == 1 || !$actor_level){ ?>   <?php } else{ ?>
						<a href="javascript:quote(<?php echo ($topic['pid']); ?>)">引用</a> ┊
					<?php } ?>
				
					<?php if($isCollect && $this->mid) { ?>
						<a href="javascript:cancel_collect(<?php echo ($gid); ?>,<?php echo ($topic['id']); ?>)">取消收藏</a>

					<?php } elseif($this->mid) { ?>
						<a href="javascript:collect(<?php echo ($gid); ?>,<?php echo ($topic['id']); ?>)">收藏</a>
					<?php } ?>
				</div>
			</div>
			<div class="c">
			</div>
		</div>
		<div class="page">
		</div>
		<div class="lh30 alR topline">
			<?php echo CHtml::link('返回话题列表>>',array('group/discussion','gid'=>$topic['gid']));?>
		</div>
		<form onsubmit="return replySubmit();" id="replyForm" action="/thinksns/apps/group/index.php?s=/Topic/post" method="post">
			<div class="li">
				<div style="width: 20%;" class="left alR lh25">
					<strong>回复话题：</strong>
				</div>
				<div style="width: 80%;" class="left">
					<script src="http://localhost/thinksns/public/js/kindeditor/kindeditor.js" type="text/javascript">
					</script>
					<script charset="utf-8" type="text/javascript">
						KE.show({
						    id: 'i_content',
						    resizeMode: 1,
						    cssPath: './index.css',
						    smileList: [['hug.gif', 'kiss.gif', 'lol.gif', 'loveliness.gif', 'mad.gif'], ['sad.gif', 'sweat.gif', 'biggrin.gif', 'cry.gif', 'funk.gif'], ['handshake.gif', 'huffy.gif', 'shocked.gif', 'shy.gif', 'smile.gif'], ['titter.gif', 'tongue.gif', 'victory.gif']],
						    smilePath: 'http://localhost/thinksns/public/images/biaoqing/mini/',
						    items: ['cut', 'copy', 'emoticons', 'source', 'justifyleft', 'justifycenter', 'justifyright', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'removeformat', 'image', 'link', 'unlink']
						});
					</script>
					<table cellspacing="0" cellpadding="0" border="0" class="ke-container" style="width: 100%; height: 313px;">
						<tbody>
							<tr>
								<td class="ke-toolbar-outer">
									<table cellspacing="0" cellpadding="0" border="0" class="ke-toolbar">
										<tbody>
											<tr>
												<td>
													<table cellspacing="0" cellpadding="0" border="0" class="ke-toolbar-table">
														<tbody>
															<tr>
																<td>
																	<a class="ke-icon" href="javascript:;" title="剪切(Ctrl+X)"><span class="ke-common-icon ke-icon-cut" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="复制(Ctrl+C)"><span class="ke-common-icon ke-icon-copy" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="插入笑脸"><span class="ke-common-icon ke-icon-emoticons" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="切换模式"><span class="ke-common-icon ke-icon-source" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="左对齐"><span class="ke-common-icon ke-icon-justifyleft" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="居中"><span class="ke-common-icon ke-icon-justifycenter" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="右对齐"><span class="ke-common-icon ke-icon-justifyright" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="字体"><span class="ke-common-icon ke-icon-fontname" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="文字大小"><span class="ke-common-icon ke-icon-fontsize" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="文字颜色"><span class="ke-common-icon ke-icon-textcolor" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="文字背景"><span class="ke-common-icon ke-icon-bgcolor" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="粗体"><span class="ke-common-icon ke-icon-bold" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="斜体"><span class="ke-common-icon ke-icon-italic" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="下划线"><span class="ke-common-icon ke-icon-underline" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="删除格式"><span class="ke-common-icon ke-icon-removeformat" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="插入图片"><span class="ke-common-icon ke-icon-image" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="超级连接"><span class="ke-common-icon ke-icon-link" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
																<td>
																	<a class="ke-icon" href="javascript:;" title="取消超级连接"><span class="ke-common-icon ke-icon-unlink" style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);"></span></a>
																</td>
															</tr>
															<tr>
																<td>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td class="ke-textarea-outer">
									<table cellspacing="0" cellpadding="0" border="0" class="ke-textarea-table" style="height: 275px;">
										<tbody>
											<tr>
												<td>
													<iframe frameborder="0" class="ke-iframe" style="height: 275px;">
													</iframe>
													<textarea class="ke-textarea" style="display: none; height: 275px;">
													</textarea>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td class="ke-bottom-outer">
									<table cellspacing="0" cellpadding="0" border="0" class="ke-bottom">
										<tbody>
											<tr>
												<td class="ke-bottom-left">
												</td>
												<td class="ke-bottom-right">
													<span style="background-image: url(&quot;http://localhost/thinksns/public/js/kindeditor/skins/default.gif&quot;);" class="ke-bottom-right-img"></span>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
					<textarea onfocus="this.className='Text1'" onblur="this.className='Text'" class="Text" style="width: 100%; padding: 8px; display: none;" rows="20" cols="20" name="content" id="i_content">
					</textarea>
				</div>
				<div style="width: 20%;" class="left alR lh25">
					<strong>附件：</strong>
				</div>
				<div style="width: 80%;" class="left">
					<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js">
					</script>
					<script src="http://localhost/thinksns/public/js/ajaxupload.3.6.js" type="text/javascript">
					</script>
					<script type="text/javascript">
						/*&lt;![CDATA[*/
						$(document).ready(function(){
						    var button = $('#ajax_upload_attach_button');
						    var process = $('#ajax_upload_attach_process');
						    $('#ajax_upload_attach_button').attr('disabled', false).html('上传附件').addClass('btn_b');
						    new AjaxUpload(button, {
						        action: 'http://localhost/thinksns/index.php?s=/Attach/ajax_upload/type//uid/',
						        name: 'myfile',
						        onSubmit: function(file, ext){
						        
						            this.disable();
						            process.val('正在上传...');
						        },
						        onComplete: function(file, response){
						            //alert(response);
						            process.val('上传成功.');
						            this.enable();
						            
						            //处理上传后的过程
						            var responseData = eval('(' + response + ')');
						            //alert(response);
						            //alert(responseData.status);
						            //上传失败
						            if (responseData.status == false) {
						                //弹出错误信息
						                alert(responseData.info);
						                
						                //上传成功
						            }
						            else {
						                //执行callback
						                attach_upload_success(responseData.info[0]);
						            }
						        }
						    });
						    
						});
						/*]]&gt;*/
					</script>
					<script>
						//插入信息到编辑器
						function insertImageIntoEditor(imgPath, attachId){
						    var frm = window.frames["Editor"];
						    var frm2 = frm.window.frames["HtmlEditor"].document;
						    var img = "&lt;p&gt;&lt;img src='" + imgPath + "' onload='if(this.width&gt;600){this.width=600}' id='attach_" + attachId + "' /&gt;&lt;/p&gt;";
						    frm2.body.innerHTML += img;
						    alert('图片插入成功！');
						}
						
						function deleteAttach(attach){
						    $('.attach' + attach).remove();
						}
						
						//执行默认的callback方法
						function attach_upload_success(info){
						    //判断附件类型
						    //判断附件类型
						    var upload_url = 'http://localhost/thinksns/data/uploads/'; //长传目录
						    var insertImage = '';
						    var imgPattern = new RegExp('^.*.(bmp|gif|jpg|png){1}$', 'gi'); //图片类型匹配
						    var imgPattern = new RegExp('^.*.(bmp|gif|jpg|png){1}$', 'gi'); //图片类型匹配
						    if (imgPattern.test(info.name)) {
						        attachInfo = '&lt;input class="attach' + info.id + '" type="hidden" name="attach[]" value="' + info.id + '|' + info.name + '"/&gt;' + '&lt;p&gt;&lt;a class="attach' + info.id + '" href="javascript:void(0)" onclick="deleteAttach(' + info.id + ')"&gt;[删除]&lt;/a&gt;&amp;nbsp;&lt;span class="attach' + info.id + '"&gt;' + info.name + '&lt;/span&gt;&lt;/p&gt;';
						    }
						    else {
						        attachInfo = '&lt;input class="attach' + info.id + '" type="hidden" name="attach[]" value="' + info.id + '|' + info.name + '"/&gt;' + '&lt;p&gt;&lt;a class="attach' + info.id + '" href= javascript:void(0) onclick="deleteAttach(' + info.id + ')"&gt;[删除]&lt;/a&gt;&amp;nbsp;&lt;span class="attach' + info.id + '"&gt; ' + info.name + '&lt;/span&gt;&lt;/p&gt;';
						    }
						    $('#attach_upload_data').append(attachInfo);
						}
					</script>
					<div id="attach_upload_widget">
						<div id="attach_upload_data">
						</div>
						<div id="attach_upload_tool">
							<input disabled="disabled" id="ajax_upload_attach_process">
							<button id="ajax_upload_attach_button" class="btn_b">
								上传附件
							</button>
							(支持以下格式：jpg,gif,png,bmp,zip,rar)
						</div>
					</div>
					<input type="hidden" value="1" name="gid"><input type="hidden" value="1" name="tid"><input type="submit" id="send_reply" value="发送" class="btn_b mt5">
				</div>
			</div>
		</form>
	</div>
</div>