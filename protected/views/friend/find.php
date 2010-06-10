<?php
include('_top.php');
?>
<div class="friendBox">
	<div class="FList"><!-- 访问脚印 begin  -->
	<ul>	
		<li class="btmlineD f14px lh25" style="padding:20px 0px;">
			<a href="javascript:sh('educationdiv');"><strong><img src="../Public/images/ico_search.gif" width="24" height="23" class="left"/> &nbsp;查找你的同学</strong></a>
			<ul>
				<script>
					//检查学校查询是否都输入了
					function check_school() {
						
						var school = $("#school").val();
						
						var ru_year = $("#ru_year").val();
						
						var classes = $("#class").val();
						
						var uname = $("#uname").val();
						
						//alert(school);alert(ru_year);alert(class);alert(uname);
						if(!school && !ru_year && !classes && !uname ) {
							Error("请至少填写一项!");
							return false;
						}else{
							return true;
						}
					
					}
				 </script>
	
			<li class="li">
				<form action="__APP__" method="get"  id="list_fri" onsubmit="return check_school()">
				<input type="hidden" name="s" value="/Friend/lists" >
				<input type="hidden" name="type" value="school" id="sub_type">
	
				<div class="left alR" style="width: 20%;">学校名称：</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="school" id="school" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" />
					<select name="year" class="TextH20" id="ru_year">
						<option value="">入学年份 </option>
						<?php for ($i=2009;$i>1910;$i--):?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php endfor;?>
					</select>
				</div>
				<div class="c"></div>
			</li>
			<li class="li">
				<form action="__APP__" method="get"  id="list_fri">
				<input type="hidden" name="s" value="/Friend/lists" >
				<input type="hidden" name="type" value="school" id="sub_type">
				<div class="left alR" style="width: 20%;">
				院系班级：</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="class" id="class" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" size="30" />
				</div>
				<div class="c"></div>
			</li>
			<li class="li">
				<div class="left alR" style="width: 20%;">
				姓名：</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="name" id="uname" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" size="30" />
				</div>
				<div class="c"></div>
			</li>
			<li class="li">
				<div class="left alR" style="width: 20%;">&nbsp;</div>
				<div class="left cGray2" style="width: 80%;">
					<input  type="submit" class="btn_b" id="button" value="查 找"  alt="school" style="cursor:pointer"/>
				</div>
				<div class="c"></div>
			</li>
			</form>
		</ul>
	</li>
	<li class="btmlineD f14px lh25" style="padding:20px 0px;"><a href="javascript:sh('educationdiv');"><strong><img src="../Public/images/ico_search.gif" width="24" height="23" class="left"/> &nbsp;</strong></a><a href="javascript:sh('careerdiv');"><strong>查找你的同事</strong></a>
	
		<ul>
			<form action="__APP__" method="get"  id="list_fri" class="form_validator" onsubmit="return check_company();">
			<input type="hidden" name="s" value="/Friend/lists" >
			<input type="hidden" name="type" value="company" id="sub_type">
			<li class="li">
				<div class="left alR" style="width: 20%;">公司名称：</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="company"type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" size="40" dataType="LimitB" min="1"  msg="公司名称不能为空" />
				</div>
				<div class="c"></div>
			</li>
			<li class="li">
				<div class="left alR" style="width: 20%;">
				姓名：</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="name" id="c_uname" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" size="30" />
				</div>
				<div class="c"></div>
			</li>
			<li class="li">
				<div class="left alR" style="width: 20%;">&nbsp;</div>
				<div class="left cGray2" style="width: 80%;">
					<input name="button" type="submit" class="btn_b" id="button" value="查 找" />
				</div>
				<div class="c"></div>
			</li>
		</ul>
		</form>
	</li>
	<li class="btmlineD f14px lh25" style="padding:20px 0px;"><a href="javascript:sh('educationdiv');"><strong><img src="../Public/images/ico_search.gif" width="24" height="23" class="left"/> &nbsp;</strong></a><a href="javascript:sh('otherdiv');"><strong>按姓名查找</strong></a>
		<ul>
			<form action="__APP__" method="get"  id="list_fri" class="form_validator" onsubmit="return check_isEmpty('username','用户名称不能为空');">
				<input type="hidden" name="s" value="/Friend/lists" >
				<input type="hidden" name="type" value="info" id="sub_type">
				<li class="li">
					<div class="left alR" style="width: 20%;">姓名：</div>
					<div class="left cGray2" style="width: 80%;">
						<input name="name" id='username'type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" dataType="LimitB" min="1" msg="姓名不能为空" />
					</div>
					<div class="c"></div>
				</li>
				<li class="li">
					<div class="left alR" style="width: 20%;">
					现住城市：</div>
					<div class="left cGray2" style="width: 80%;">
						<input name="ts_area" id="ts_area" type="hidden" />
						<input name="area" id="area" type="text" disabled class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" /><input type="button" class="btn_b" value="选择地区" selectArea="true" areatype="area" >
					</div>
					<div class="c"></div>
				</li>
				<li class="li">
					<div class="left alR" style="width: 20%;">
					性别：</div>
					<div class="left cGray2" style="width: 80%;">
						<select name="sex">
							 
							<option value="">全部</option>
							 
							<option value="1">男</option>
							 
							<option value="0">女</option>
							 
						</select>
					</div>
					<div class="c"></div>
				</li>
				<li class="li">
					<div class="left alR" style="width: 20%;">&nbsp;</div>
					<div class="left cGray2" style="width: 80%;">
						<input type="submit" class="btn_b" id="button" value="查 找" />
					</div>
					<div class="c"></div>
				</li>
			</form>
		</ul>
	</li>
	<li class="btmlineD f14px lh25" style="padding:20px 0px;"><a href="javascript:sh('educationdiv');"><strong><img src="../Public/images/ico_search.gif" width="24" height="23" class="left"/> &nbsp;</strong></a><a href="javascript:sh('otherdiv');"><strong>精确查找</strong></a>
		<ul>
	
			<form action="__APP__" method="get"  id="list_fri" class="form_validator" onsubmit="return check_isEmpty('uemail','用户Email为不能为空');">
				<input type="hidden" name="s" value="/Friend/lists" >
				<input type="hidden" name="type" value="email" id="sub_type">
				<li class="li">
					<div class="left alR" style="width: 20%;">对方Email：</div>
					<div class="left cGray2" style="width: 80%;">
						<input name="email" id="uemail" type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" dataType="LimitB" min="1" max="50" msg="email不能为空" dataType1="Email" msg1="email格式不正确"/>
						<input  type="submit" class="btn_b" id="button" value="查 找" />
					</div>
					<div class="c"></div>
				</li>
			</form>
			<form action="__APP__" method="get"  id="list_fri" class="form_validator" onsubmit="return check_isEmpty('uid','用户Id不能为空');">
				<input type="hidden" name="s" value="/Friend/lists" >
				<input type="hidden" name="type" value="id" id="sub_type">
				<li class="li">
					<div class="left alR" style="width: 20%;">
					对方ID号：</div>
					<div class="left cGray2" style="width: 80%;">
						<input name="id" id='uid' type="text" class="TextH20" onfocus="this.className='Text2'" onblur="this.className='TextH20'" dataType="LimitB"  min="1" msg="id不能为空" dataType1="Number" msg1="id必须为数字"/>
						<input  type="submit" class="btn_b" id="button" value="查 找" />
					</div>
					<div class="c"></div>
				</li>
			</form>
		</ul>
	</li>
	</ul>
	</div><!-- 访问脚印 end  -->
</div>

<script>
	function check_company(){
		var company = $.trim($('input[@name=company]').val());
		var c_uname = $.trim($("#c_uname").val());
		
		if(!company && !c_uname ) {
			Error("公司名称和用户名字不能同时为空!");
			return false;
		}else{
			return true;
		}
	}
	
	function check_isEmpty(id,msg){
		
		var info = $.trim($('#'+id).val());
		if(!info){
			Error(msg);
			return false;
		}else{
			return true;
		}
	}
	
	
</script>