<?php
$_CACHE['apps'] = array (
  2 => 
  array (
    'appid' => '2',
    'type' => 'UCHOME',
    'name' => '个人家园',
    'url' => 'http://localhost/uchome2',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => 'utf-8',
    'dbcharset' => 'utf8',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => false,
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
 <item id="template"><![CDATA[<a href="{url}" target="_blank">{subject}</a>]]></item>
 <item id="fields">
 <item id="subject"><![CDATA[日志标题]]></item>
 <item id="uid"><![CDATA[用户 ID]]></item>
 <item id="username"><![CDATA[用户名]]></item>
 <item id="dateline"><![CDATA[日期]]></item>
 <item id="spaceurl"><![CDATA[空间地址]]></item>
 <item id="url"><![CDATA[日志地址]]></item>
 </item>
</root>',
  ),
  3 => 
  array (
    'appid' => '3',
    'type' => 'OTHER',
    'name' => 'sns',
    'url' => 'http://localhost/yiisns',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => '',
    'dbcharset' => '',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => false,
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
 <item id="template"><![CDATA[]]></item>
</root>',
  ),
  4 => 
  array (
    'appid' => '4',
    'type' => 'OTHER',
    'name' => 'test',
    'url' => 'http://localhost/examples',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => '',
    'dbcharset' => '',
    'synlogin' => '0',
    'recvnote' => '0',
    'extra' => false,
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
 <item id="template"><![CDATA[]]></item>
</root>',
  ),
);

?>