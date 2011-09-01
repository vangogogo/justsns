<?php
	include('_top.php');
?>
<?php
	$cs = Yii::app()->clientScript;

	$cs->registerCssFile('/js/kxthumb/main.css');
	$cs->registerScriptFile('/js/kxthumb/thumb.js');
?>


<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:20px;" >
	<tr>
		<td width="190" align="center" valign="top">
			<div class="len_bbs_userpic" id="userfacediv">
			 <div class="headpic100">
<img name="userface" id="userface" src="<?php echo Yii::app()->params['upload_dir'].'userface/'.Yii::app()->user->id.'_middle_face.jpg'?>?<?php echo time();?>"/>
			 </div>
			</div>


			<table id="tbface" width="98%" border="0" cellpadding="3" cellspacing="1" style="display:none;">
				<tr>
					<td  bgcolor="#FFFFFF">
						<div id="">
							<div class="title"><b> 裁切头像照片</b></div>
							<div class="uploadtooltip">您可以拖动照片以裁剪满意的头像</div>
							<div id="Canvas" class="uploaddiv">

								<div id="ImageDragContainer">
									<img src='<?php echo Yii::app()->request->baseUrl;?>/js/kxthumb/image/dd.JPG' id='ImageDrag' class='imagePhoto'>
								</div>
								<div id="IconContainer">
									<img src='<?php echo Yii::app()->request->baseUrl;?>/js/kxthumb/image/dd.JPG' id='ImageIcon' class='imagePhoto'>
								</div>
							</div>
							<div class="uploaddiv">
								<table>
									<tr>
										<td id="Min">
										<img alt="缩小" src="<?php echo Yii::app()->request->baseUrl;?>/js/kxthumb/image/_c.gif" onMouseOver="this.src='js/kxthumb/image/_c.gif';" onMouseOut="this.src='js/kxthumb/image/_h.gif';" id="moresmall" class="smallbig" />								</td>
										<td>
											<div id="bar">
												<div class="child"></div>
											</div>
										</td>
										<td id="Max">
											<img alt="放大" src="<?php echo Yii::app()->request->baseUrl;?>/js/kxthumb/image/c.gif" onMouseOver="this.src='js/kxthumb/image/c.gif';" onMouseOut="this.src='js/kxthumb/image/h.gif';" id="morebig" class="smallbig" />
										</td>
									</tr>
								</table>
							</div>
							<form action="<?php echo $this->createUrl('info/saveThumb')?>" method="post">
								<input type="hidden" name="person" value="person">
								<div class="uploaddiv">
									<input type="submit" value="保存头像" class="btn_b" name="btn_Image">
								   
									<input name="bigImage" type="hidden" id="bigImage" value="js/kxthumb/image/dd.JPG" />
								</div>
                                        								
								<div style="display:none;">
									图片实际宽度： <input name="txt_width" type="text" ID="txt_width" value="1"> <br />
									图片实际高度：<input name="txt_height" type="text" ID="txt_height" value="1"> <br />
									距离顶部：<input name="txt_top" type="text" ID="txt_top" value="82"><br />
									距离左边：<input name="txt_left" type="text" ID="txt_left" value="73"><br />
									截取框的宽：<input name="txt_DropWidth" type="text" ID="txt_DropWidth" value="120"><br />
									截取框的高：<input name="txt_DropHeight" type="text" ID="txt_DropHeight" value="120"><br />
									放大倍数： <input name="txt_Zoom" type="text" ID="txt_Zoom" value="">
								</div>

							</form>
					</div>	</td>
					<td align="center" valign="top" bgcolor="#FFFFFF"></td>
				</tr>
			</table>
				
		</td>
		<td width="607" valign="top">
			<?php $this->renderPartial('uploadFaceImg');?>
		</td>
	</tr>
</table>
