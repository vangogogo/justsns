<?php
    include('_top.php');
?>
<div style="padding-top: 30px;" class="data"><!-- 帐号安全 begin  -->
	<div>
		<?php if(!empty($lastLoginInfo)){?>
		<h2 class="lh35 f14px btmline"><strong>你上次的登录：</strong></h2>
		<ul>
			<li>
				<div style="width: 15%;" class="left alR">登录时间：</div>
				<div style="width: 85%;" class="left cGray2"><?php echo date('Y年m月d日 H:i:s',$lastLoginInfo['login_time']);?><br/>
				</div>
				<div class="left cGray2"></div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR">IP  地址：</div>
				<div style="width: 85%;" class="left"><?php echo $lastLoginInfo['login_ip']?></div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR">上网地点：</div>
				<div id="lastLoginAddress" style="width: 85%;" class="left">本机地址 </div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR"> </div>
				<div style="width: 85%;" class="left"></div>
			</li>
		</ul>
		<?php }?>
		<?php if(!empty($thisLoginInfo)){?>
		<h2 class="lh35 f14px btmline"><strong>本次的登录：</strong></h2>
		<ul>
			<li>
				<div style="width: 15%;" class="left alR">登录时间：</div>
				<div style="width: 85%;" class="left cGray2"><?php echo date('Y年m月d日 H:i:s',$thisLoginInfo['login_time']);?><br/>
				</div>
				<div class="left cGray2"></div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR">IP  地址：</div>
				<div style="width: 85%;" class="left"><?php echo $thisLoginInfo['login_ip']?></div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR">上网地点：</div>
				<div id="thisLoginAddress" style="width: 85%;" class="left">本机地址 </div>
			</li>
			<li>
				<div style="width: 15%;" class="left alR"> </div>
				<div style="width: 85%;" class="left"></div>
			</li>
		</ul> 
		<?php }?>
	</div>

</div>
