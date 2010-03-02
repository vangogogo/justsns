<script type="text/javascript" src="http://static.manyou.com/scripts/my_iframe.js"></script>
<script language="javascript">
var prefixURL = "http://uchome.manyou.com";
var suffixURL = "/userapp/privacy?appId=1021978";
var queryString = '';
var url = "http://uchome.manyou.com/userapp/privacy?appId=1021978&my_extra=&s_id=2240353&uch_id=1&uch_url=http%3A%2F%2Fhome.lockphp.com%2Fcp.php%3Fac%3Duserapp&my_suffix=%2Fuserapp%2Fprivacy%3FappId%3D1021978&timestamp=1267428302&my_sign=7aa8d8f86781d003fbeedc5b45b579bb";
var oldHash = null;
var timer = null;
var server = new MyXD.Server("ifm0");
server.registHandler('iframeHasLoaded');
server.registHandler('setTitle');
server.start();

function iframeHasLoaded(ifm_id) {
        MyXD.Util.showIframe(ifm_id);
        //document.getElementById(ifm_id).style.display = '';
        document.getElementById('loading').style.display = 'none';
}

function  htmlspecialchars_decode(string) {
string = string.toString();
string = string.replace(/&amp;/g, '&');
string = string.replace(/&lt;/g, '<');
string = string.replace(/&gt;/g, '>');
string = string.replace(/&quot;/g, '"');
string = string.replace(/&#039;/g, "'");
return string;

}

function setTitle(x) {
var my_site_name = htmlspecialchars_decode('我的空间');

x = htmlspecialchars_decode(x);
document.title = x + ' - huanghuibin - ' + my_site_name + ' - Powered by UCenter Home';
}

</script>


<div id="mx2note" style="display:none; padding:150px 0 150px 0; margin:1px; text-align:center; background-color:#FFFFBF;  font-size:12px; line-height:14px; color:#DB0000; letter-spacing:1px;">
	本页面暂时不支持遨游2浏览器, 请您使用IE或Firefox, 我们对由此给您带来的不便深表歉意
</div>
<div id="loading" style="display:block; padding:100px 0 100px 0;text-align:center;color:#999999;font-size:12px;">
	<img src="images/loading_blue_big.gif" alt="loading..." style="position:relative;top:11px;"/>  页面加载中...
</div>
<iframe id="ifm0" frameborder="0" width="810" scrolling="no" height="810" style="position:absolute; top:-5000px; left:-5000px;" src="<?php echo $url;?>"></iframe>