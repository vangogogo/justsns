<?php
/**
* 统一全站的投票，留言
* 解决跨域ajax的问题，作为hack 在每个module下都有一个 AjaxController 来继承 BaseAjaxController
*/
class BaseAjaxController extends Controller
{
	/*
	* 评分
	*/
	public function actionStarRating()
	{
		$user_id = Yii::app()->user->id;
		$object_id = Yii::app()->request->getParam('object_id');
		$object_type = Yii::app()->request->getParam('object_type');
		$star_num = Yii::app()->request->getParam('rate');

		if($user_id==NULL or $object_type==NULL or $object_id==NULL or $star_num==NULL)
		{
			echo -1;exit;
		}
		else
		{
			$model = new StarRateLog();
			$params = array(
				'user_id'=>$user_id,
				'object_type'=>$object_type,
				'object_id'=>$object_id,
				'star_num'=>$star_num,
			);
			$rate = $model->setRateInfo($params);
		}
	}
	
	/*
	* 回复评论
	*/
	public function actionBoardReply()
	{
		$params = array(
			'board_reply' => $_POST['board_reply'],
			'object_type' => $_POST['object_type'],
			'object_id' => $_POST['object_id'],
		);

		$pk = $_POST['people_pk'];
		$PeopleBoard= new PeopleBoard();
		$model = $PeopleBoard -> findByPk($pk);
		if(!empty($model))
		{
			
			if($model->isManager())
			{
				$model-> board_reply = $params['board_reply'];
				$model->save();
			
				YiicmsHelper::ok('回复成功。');
			}
		}

		YiicmsHelper::error('回复失败，可能留言不存在。');
	}	

	/*
	* 删除评论
	*/
	public function actionBoardDelete()
	{
		$params = array(
			'board_reply' => $_POST['board_reply'],
			'object_type' => $_POST['object_type'],
			'object_id' => $_POST['object_id'],
		);

		$pk = $_POST['people_pk'];
		$PeopleBoard= new PeopleBoard();
		$model = $PeopleBoard -> findByPk($pk);
		if(!empty($model))
		{
			//当导师未回复前，发表者允许删除. 导师可以自己删除回复	
			if($model->isDeleteAccess())
			{
				$model->deleteMark();
				YiicmsHelper::ok('删除成功。');
			}	
		}

		YiicmsHelper::error('回复失败，可能留言不存在。');
	}

	public function actionUserCollect()
	{
		$model = new PeopleContact();
		$object_type = $_POST['object_type'];
		$object_id = $_POST['object_id'];
        
		$uid = Yii::app()->user->id;

        $op = $_POST['op'];
		$params = array(
			'uid'=>$uid,
			'object_type' => $_POST['object_type'],
			'object_id' => $_POST['object_id'],
		); 
        if($op == 'add')
        {
            $model->attributes = $params;
            $model->save();
        } 
        elseif($op == 'delete')
        {
            $model = $model->findByAttributes($params);
            $model->delete();
        }
	}

	public function actionLoginForm()
	{
		$this->widget('WLoginForm');
	}
}
