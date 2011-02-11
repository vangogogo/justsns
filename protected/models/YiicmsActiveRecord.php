<?php
/**
 * YiicmsActiveRecord class file.
 *
 * @reference YiicmsActiveRecord <http://http://www.lockphp.com/yii-work/yii-ar-cache-auto.html> <created by Biner>
 *
 * @version alpha1 (2010-10-27 16:16)
 * @author Biner <huanghuibin@gmail.com>
 *
 * A typical usage of YiicmsActiveRecord is as follows:
 * <pre>
 * class Product extends YiicmsActiveRecord
 * {
 *     //your code ..
 * }
 * </pre>
 *
 * 继承本类，该AR中必须有以下字段：create_time,update_time,is_delete
 *
 */
abstract class YiicmsActiveRecord extends CActiveRecord
{
	const PAGE_SIZE = 10;
	
	public function behaviors()
	{
		return array(
			// YII AR的事件行为
			'YiicmsActiveRecordBehavior',
			// 时间
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
			)
		);
		
	}
	/**
	* 系统日志的信息分类
	*/
	public function getResourceList()
	{
		//example 示例
		$array = array(
			'notice'=>'新闻',
			'product'=>'产品',
			'content'=>'信息',
			'ad'=>'广告',
			'user'=>'用户',
			'MagazineMagazine'=>'杂志',
		);
		return $array;
	}
	/**
	* 获得系统日志的中文名称
	*/
	public function getResourceName()
	{
		$modelclass = $this->getModelClass();
		$resource_list = $this->getResourceList();
		$resource_name = $resource_list[strtolower($modelclass)];
		if(empty($resource_name))
		{
			//throw new CHttpException(500,"错误的资源类型({$modelclass})。");
			return $modelclass;
		}
		return $resource_name;
	}
	/**
	* 获得model的类名
	*/
	public function getModelClass()
	{
		$modelclass = get_class($this);
		return $modelclass;
	}
	/**
	* 获得某行记录的缓存键值，做缓存的键值
	*/	
	public function getCacheKey($pk = '')
	{
		$modelclass = $this->getModelClass();
		$model_pk = $this->getPrimaryKey();
		$pk = $model_pk?$model_pk:$pk;
		$key = 'resource_'.$modelclass.'_'.$pk;
		//var_dump($key);die;
		return $key;
	}
	/**
	* 重写findByPk方法,如果缓存存在数据，则直接读取缓存
	* 在YiicmsActiveRecordBehavior中，一旦有数据更新则删除缓存
	*/
	public function findByPk($pk,$condition='',$params=array())
	{
		$key = $this->getCacheKey($pk);
		//Yii::app()->cache->delete($key);
		$resource=Yii::app()->cache->get($key);
		if($resource===false)
		{
			$resource=parent::findByPk($pk,$condition,$params);
			Yii::app()->cache->set($key,$resource);
			// 因为在缓存中没找到，重新生成 $value
			// 再缓存一下以备下次使用
			// Yii::app()->cache->set($id,$value);
		}
		return $resource;
	}
	
	public function scopes()
	{
		return array(
			'deleted'=>array(
				'condition'=>'is_delete=1',
			),
			'normal'=>array(
				'condition'=>'is_delete=0',
			),
		);
	}
	
	public function deleteMark()
	{
		$this->is_delete = 1;
		$this->save();
		return $this;
	}
	
	public function resetMark()
	{
		$this->is_delete = 0;
		$this->save();
		return $this;
	}
	
}
