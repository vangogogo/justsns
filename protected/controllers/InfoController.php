<?php

class InfoController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model=new User();
		$uid = Yii::app()->user->id;
		$form = $model->findByPk($uid);
		$form->scenario = 'base';
		$data = array(
			'form' => $form,
		);
		$this->render('index',$data);
	}
	
	public function actionIntro()
	{
		$form=new User();
		$data = array(
			'form' => $form,
		);
		$this->render('intro',$data);
	}
	
	public function actionContact()
	{
		$form=new User();
		$data = array(
			'form' => $form,
		);
		$this->render('contact',$data);
	}

	public function actionEducation()
	{
		$form=new User();
		$data = array(
			'form' => $form,
		);
		$this->render('education',$data);
	}
	
	public function actionCareer()
	{
		$form=new User();
		$data = array(
			'form' => $form,
		);
		$this->render('career',$data);
	}

	public function actionFace()
	{
	
		$form=new User();
		$data = array(
			'form' => $form,
		);
		$this->render('face',$data);
	}
	
	public function actionUploadedFiles()
	{
	    // flash does NOT pass the session
	    // thus we pass the id with a $_POST variable


		if (!empty($_FILES)) {

			$FILE = $_FILES['Filedata'];
			$tempFile = $FILE['tmp_name'];
						
			//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
			//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
			$fileext = Yii::app()->request->getParam('fileext');
			
			//上传类型
			$fileTypes  = str_replace('*.','',$fileext);
			$fileTypes  = str_replace(';','|',$fileTypes);
			$typesArray = explode('|',$fileTypes);
			
			$fileParts  = pathinfo($FILE['name']);
			
			$files = var_export($typesArray, true);


			if (in_array($fileParts['extension'],$typesArray)) {
				// Uncomment the following line if you want to make the directory if it doesn't exist
				// mkdir(str_replace('//','/',$targetPath), 0755, true);

			
				//判断后缀
				$fileParts  = pathinfo($FILE['name']);
				$fileext = $fileParts["extension"];
				if(!in_array($fileext, $typesArray)) {
					$msg = 'only_allows_upload_file_types';
				}
			
				//获取目录
				$filepath = Yii::app()->user->id.'_'.time().'.'.$fileext;
				if(!$filepath = $this->getfilepath($fileext, true)) {
					$msg = 'unable_to_create_upload_directory_server';
				}
						
				$targetPath = Yii::app()->params['uploadPath'];
				$targetFile = $targetPath.$filepath;
	
				$test = move_uploaded_file($tempFile,$targetFile);

			} else {
				//echo '('.CJSON::encode('Invalid file type.').')';
				//exit;
			}	
				    
		}
		
	    // Do whatever you need to do with the files you just received
		echo '('.CJSON::encode(Yii::app()->params['upload_dir'].$filepath).')';
	}
		
	public function actionUploadFaceImg()
	{
		//die(Yii::app()->params['uploadPath']);
		$this->renderPartial('uploadFaceImg','','',TURE);	
	}
	
	//保存用户头像
	public function actionSaveThumb() {
		//头像大方快的宽高
		$targ_w	=	120;
		$targ_h	=	120;

		//头像小方块的宽高
		$small_w	=	50;
		$small_h	=	50;

		//图像质量
		$jpeg_quality	=	80;

		$src_arr		=	explode("?",$_POST['bigImage']);
        $src			=	$src_arr[0];
		//$src			=	str_ireplace(SITE_URL,'.',$src);
		//$src = Yii::app()->params['uploadPath'].'../'.$src;
		$src = Yii::getPathOfAlias('webroot').'/..'. $src;

		

		//获取图片的扩展名。来选择使用什么函数
		if(	$arr = @getimagesize($src)	){
			$ext = image_type_to_extension($arr[2],false);
		} else {
			$this->error('对不起,GD库不存在或远程图片不存在');
		}
		$func = ($ext != 'jpg')?'imagecreatefrom'.$ext:'imagecreatefromjpeg';
		$img_r = call_user_func($func,$src);

		//开始切割大方块头像

		$dst_r	=	ImageCreateTrueColor( $targ_w, $targ_h );
		$x		=	$targ_h/$_POST['txt_Zoom'];
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['txt_left']/$_POST['txt_Zoom'],$_POST['txt_top']/$_POST['txt_Zoom'],$targ_w,$targ_h,$x,$x);


        $face_path  =	Yii::app()->params['uploadPath'].'userface/';
		
        if(file_exists($$face_path))
			mkdir($face_path,0777,true);
        $middle_name =	$face_path.Yii::app()->user->id."_middle_face.jpg";     //中图
		imagejpeg($dst_r,$middle_name);  //生成中图


		$img_r = call_user_func($func,$middle_name);
		$small_name  = $face_path.Yii::app()->user->id."_small_face.jpg";     //小图
		$dst_r	=	ImageCreateTrueColor( $small_w, $small_h );
		imagecopyresampled($dst_r, $img_r, 0, 0, 0, 0, $small_w, $small_h, $targ_w, $targ_h );
		imagejpeg($dst_r,$small_name);  //生成小图
		

		imagedestroy($dst_r);
		imagedestroy($img_r);
				
		//CThumb::resizeImage($middle_name, $small_w, $small_h, $small_name,$filetype = 'jpg');

		$this->redirect(array('account'));
	}
	

	//获取上传路径
	function getfilepath($fileext, $mkdir=false, $upload_dir = '') {
		$filepath = Yii::app()->user->id.'_'.time().'.'.$fileext;
		//Yii::log($filepath,'error');
		$name1 = gmdate('Ym');
		$name2 = gmdate('j');

		if($mkdir) {
			/*添加参数$upload_dir
			*默认为空,则上传到原uchome的相册上传目录
			*edit: biner
			*data: 2009-8-17
			*/
			if(!empty($upload_dir)){
				$newfilename = $upload_dir.'./'.$name1;
			}else{
				$newfilename = Yii::app()->params['uploadPath'].$name1;
			}
			//$newfilename = $_SC['attachdir'].'./'.$name1;
			if(!is_dir($newfilename)) {
				if(!@mkdir($newfilename)) {
					Yii::log("DIR: $newfilename can not make",'error');
					return $filepath;
				}
			}
			$newfilename .= '/'.$name2;
			if(!is_dir($newfilename)) {
				if(!@mkdir($newfilename)) {
					Yii::log("DIR: $newfilename can not make",'error');
					return $name1.'/'.$filepath;
				}
			}
		}
		return $name1.'/'.$name2.'/'.$filepath;
	}	
}
