<?php
/**
 * YiicmsActiveRecordBehavior class file.
 *
 * @reference YiicmsActiveRecord <http://www.lockphp.com/nocate/yii-ar-log-auto.html> <created by Biner>
 *
 * @version alpha1 (2010-10-27 16:16)
 * @author Biner <huanghuibin@gmail.com>
 *
 * A typical usage of YiicmsActiveRecordBehavior is as follows:
 * <pre>
 * abstract class YiicmsActiveRecord extends YiicmsActiveRecord
 * {
 *		public function behaviors()
 *		{
 *			return array(
 *				// YII AR的事件行为
 *				'YiicmsActiveRecordBehavior',
 *				// 时间
 *				'CTimestampBehavior' => array(
 *					'class' => 'zii.behaviors.CTimestampBehavior',
 *					'createAttribute' => 'create_time',
 *					'updateAttribute' => 'update_time',
 *				)
 *			);
 *		
 *		}
 * }
 * </pre>
 *
 * 使用本“行为”部件，需要存在log AR 表sql
 
		 CREATE TABLE IF NOT EXISTS `yiicms_log` (
		  `log_id` mediumint(11) NOT NULL AUTO_INCREMENT,
		  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '操作时间',
		  `log_time` int(11) NOT NULL COMMENT '时间戳',
		  `log_ip` char(15) NOT NULL COMMENT '操作员ip',
		  `log_controller` varchar(50) DEFAULT NULL COMMENT '请求的控制器',
		  `log_action` varchar(50) DEFAULT NULL COMMENT '请求的执行的动作',
		  `log_operator_id` int(11) DEFAULT NULL COMMENT '操作员id',
		  `log_operator_name` varchar(50) NOT NULL COMMENT '操作员名',
		  `log_type` varchar(50) NOT NULL COMMENT '操作行为的大类',
		  `log_category` varchar(40) DEFAULT NULL COMMENT '该操作属于何种性质的操作(常规维护 或者其它 )',
		  `log_description` varchar(255) DEFAULT NULL COMMENT '操作员输入的操作描述',
		  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已标记为删除. 0否, 1是.',
		  `log_model` varchar(50) NOT NULL COMMENT '操作的model',
		  `log_model_pk` int(11) NOT NULL COMMENT '操作的model的主键',
		  `log_model_attributes_old` text NOT NULL COMMENT '旧数据',
		  `log_model_attributes_new` text NOT NULL COMMENT '新数据',
		  PRIMARY KEY (`log_id`),
		  KEY `log_id` (`log_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='操作日志表';

 *
 */
class YiicmsActiveRecordBehavior extends CActiveRecordBehavior
{
	public function beforeSave($event)
	{   
        //删除缓存
		$key = $this->Owner->getCacheKey();
		Yii::app()->cache->delete($key);
	}
	public function beforeDelete($event)
	{
		//删除缓存
		$key = $this->Owner->getCacheKey();
		Yii::app()->cache->delete($key);
	}
}
