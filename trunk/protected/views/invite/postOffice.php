<?php
	include('_top.php');
?>
     <div class="friendBox">
       <div class="FList">
          <form action="__URL__/getEmailList" method="post">
     	  <div class="f14px lh25" style="padding:20px 0px;">
            <div><a href="javascript:sh('emaildiv');"><strong>邀请163等邮箱联系人</strong></a>
              <p class="f12px cGray">从我的邮箱导入通讯录，选择待邀请人并发送邀请邮件</p>
            </div>
            <ul>
              <li class="li">
                <div class="left alR" style="width: 20%;">邮箱地址：</div>
                <div class="left cGray2" style="width: 80%;">
                  <input name="account" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" />
                  @
                  <select name="email_type" class="TextH20">
                     <option value="126.com" >126.com</option>
	  				 <option value="sohu.com" >sohu.com</option>
	    			 <option value="163.com" >163.com</option>
        			 <option value="sina.com" >sina.com</option>
        			 <option value="tom.com" >tom.com</option>
        			 <option value="gmail.com" >gmail.com</option>
        			 <option value="yahoo.cn" >yahoo.cn</option>
        			 <option value="yahoo.com" >yahoo.com</option>
        			 <option value="yahoo.com.cn" >yahoo.com.cn</option>
                  </select>
                </div>
				<div class="c"></div>
              </li>
              <li class="li">
                <div class="left alR" style="width: 20%;"> 邮箱密码：</div>
                <div class="left cGray2" style="width: 80%;">
                  <input name="password" type="password" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" size="30" />
                </div>
				<div class="c"></div>
              </li>
              <li class="li">
                <div class="left alR" style="width: 20%;">&nbsp;</div>
                <div class="left cGray2" style="width: 80%;">
                  <input type="hidden" name="gid" value="{$gid}">
                  <input name="button" type="submit" class="btn_b" id="button" value="导 入" />
                </div>
				<div class="c"></div>
              </li>
              <li class="li">
                <div class="left alR" style="width: 20%;">&nbsp;</div>
                <div class="left" style="width: 80%;">
                  <div class="msg">{$site_name}不会存储你的邮箱密码，请放心使用。你也可以先改密码再导入，成功后再改回原始密码，确保密码安全。</div>
                </div>
				<div class="c"></div>
              </li>
            </ul>
          </div>
       </form>
      </div>
    </div>
