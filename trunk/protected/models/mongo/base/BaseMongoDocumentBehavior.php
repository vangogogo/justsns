<?php

class BaseMongoDocumentBehavior extends CActiveRecordBehavior
{
	public function events()
	{
        if(is_subclass_of($this->getOwner(),'BaseMongoDocument'))
        {
            $tmp = parent::events();
        }
        else
        {
            $tmp = array();
        }   

	    return array_merge($tmp, array(
		    'onBeforeEmbeddedDocsInit'=>'beforeEmbeddedDocsInit',
		    'onAfterEmbeddedDocsInit'=>'afterEmbeddedDocsInit',
		    'onBeforeToArray'=>'beforeToArray',
		    'onAfterToArray'=>'afterToArray'
	    ));
	}

	public function beforeEmbeddedDocsInit($event){}
	public function afterEmbeddedDocsInit($event){}
	public function beforeToArray($event){}
	public function afterToArray($event){}
}
