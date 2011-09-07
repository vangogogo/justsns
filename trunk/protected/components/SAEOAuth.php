<?php  
/**
 * SAEOAuth 简单的新浪微薄API扩展
 * @author biner <huanghuibin@gmail.com>
 */
class SAEOAuth extends CComponent
{
	public $WB_AKEY, $WB_SKEY, $callback;
	const RequestTokenName = 'keys';
	const AccessTokenName = 'last_key';

	protected $oauth;
	private $_client;

	public function __construct($WB_AKEY = null, $WB_SKEY = null)
	{
		include_once( 'weibooauth.php' );
		$this->WB_AKEY = $WB_AKEY;
		$this->WB_SKEY = $WB_SKEY;
		$this->callback = Yii::app()->createAbsoluteUrl($this->callback);
	}

	public function init()
	{
		return $this;
	}
	/*
	* 生成前往新浪weibo的登录页面链接地址
	*/
	public function getAuthorizeURL()
	{
		session_start();
		$o = new SaeTOAuth($this->WB_AKEY , $this->WB_SKEY);
		$keys = $o->getRequestToken();
		$callback = Yii::app()->createAbsoluteUrl($this->callback);
		$aurl = $o->getAuthorizeURL( $keys['oauth_token'] ,false , $callback);

		//保存session
		$this->setOAuthData(self::RequestTokenName,$keys);

		return $aurl;
	}
	/*
	* 检验是否已经登录
	*/
	public function checkAuthorize()
	{
		$data = $this->getOAuthData(self::AccessTokenName);
		return !empty($data)?true:false;
	}

	public function getOAuthData($name)
	{
		$session=new CHttpSession;
		$session->open();
		$value=$session[$name];
		return $value;
	}

	public function setOAuthData($name,$value)
	{
		$session=new CHttpSession;
		$session->open();
		return Yii::app()->session->add($name,$value);
	}
	/*
	* 回调接口
	*/
	public function callback()
	{
		include_once( 'weibooauth.php' );
		$keys = $this->getOAuthData(self::RequestTokenName);
		$o = new SaeTOAuth( $this->WB_AKEY , $this->WB_SKEY , $keys['oauth_token'] , $keys['oauth_token_secret']  );
		$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']);
		$this->setOAuthData(self::AccessTokenName,$last_key);
	}
	/*
	* 获得sina client 
	*/
	public function getSinaClient()
	{
		if( $this->_client == false)
		{
			include_once( 'weibooauth.php' );
			$last_key = $this->getOAuthData(self::AccessTokenName);
			$this->_client = new SaeTClient( $this->WB_AKEY , $this->WB_SKEY , $last_key['oauth_token'] , $last_key['oauth_token_secret']  );
		}
		return $this->_client;
	}
	/*
	* 获得登录用户的id
	*/
	public function getUserID()
	{
        $last_key = $this->getOAuthData(self::AccessTokenName);
        return $last_key['user_id'];
	}

}
