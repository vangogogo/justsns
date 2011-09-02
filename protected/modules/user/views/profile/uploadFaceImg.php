	<script type="text/javascript">
		
	function submitImg(){		
		 var imageInput = document.getElementById('img');
		 var imgPattern = new RegExp('^.*\.(bmp|gif|jpg|png){1}$','gi');
		 if( !imageInput.value ){
			 return;
		 }
		 if(!imgPattern.test(imageInput.value)){
			 Alert('该文件不是图片！');
			 return;
		 }
		 document.getElementById('uploadFrom').submit();
		 document.getElementById('uploadFrom').style.display='none';
		 document.getElementById('uploadingDiv').style.display='block';
	}
	
	</script>
	
	<div id="uploadingDiv" style="display: none; text-align: center;">
		正在上传，请稍等...
	</div>
	<form id="uploadFrom" enctype="multipart/form-data" action="<?php echo $this->createUrl('UploadedFiles')?>" method="post">
		 <h4>上传头像</h4>
		 <p>支持JPG、GIF和PNG格式的图片文件，大小2M以内.<br>
	 	建议使用大头照，不然缩小后可能看不清楚。</p>
		 <div style="margin:20px 0 30px 0; line-height:18px;">请浏览大图，然后拖动选择头像区域。<br />
		 	<?php // echo CHtml::fileField('file','',array('id'=>'img'));?>
		 	<?php //echo CHtml::submitButton('submit');?>

<?php 
$this->widget('application.extensions.uploadify.EuploadifyWidget', 
    array(
        'name'=>'file',
        'id' => 'img',
        'value' => 'xx',
        'options'=> array(
            //'uploader' => '/js/uploadify.swf',
            'script' => $this->createUrl('UploadedFiles'), 

            'auto' => true,
            'multi' => false,
            'folder' => '/',
            'scriptData' => array('extraVar' => 1234, 'PHPSESSID' => session_id()),
            //'fileDesc' => 'Declaratiebestanden',
            'fileExt' => '*.jpg;*.gif;*.png',
            //'buttonText' => 'Upload bestanden',
           // 'buttonImg' => 'images/system/upload.gif',
            'width' => 150,
            ),
        'callbacks' => array( 
           'onError' => 'function(evt,queueId,fileObj,errorObj){Alert("Error: " + errorObj.type + "\nInfo: " + errorObj.info);}',
           'onComplete' => 'function(event, ID, fileObj, response, data){
           	var fileurl = eval("(" + response + ")");
			insertImg1(fileurl);
           	$("#bigImage").val(fileurl);}',
           'onCancel' => 'function(evt,queueId,fileObj,data){Alert("Cancelled");}',
        )
    )); 

?>

	 	</div>
		 <p>请确认上传的是你自己的照片。<br>
		 上传色情、反动等照片将导致你的账号被删除。</p>
	</form>	
