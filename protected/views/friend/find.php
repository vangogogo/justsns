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
						 
						<option value="2009">2009</option>
						 
						<option value="2008">2008</option>
						 
						<option value="2007">2007</option>
						 
						<option value="2006">2006</option>
						 
						<option value="2005">2005</option>
						 
						<option value="2004">2004</option>
						 
						<option value="2003">2003</option>
						 
						<option value="2002">2002</option>
						 
						<option value="2001">2001</option>
						 
						<option value="2000">2000</option>
						 
						<option value="1999">1999</option>
						 
						<option value="1998">1998</option>
						 
						<option value="1997">1997</option>
						 
						<option value="1996">1996</option>
						 
						<option value="1995">1995</option>
						 
						<option value="1994">1994</option>
						 
						<option value="1993">1993</option>
						 
						<option value="1992">1992</option>
						 
						<option value="1991">1991</option>
						 
						<option value="1990">1990</option>
						 
						<option value="1989">1989</option>
						 
						<option value="1988">1988</option>
						 
						<option value="1987">1987</option>
						 
						<option value="1986">1986</option>
						 
						<option value="1985">1985</option>
						 
						<option value="1984">1984</option>
						 
						<option value="1983">1983</option>
						 
						<option value="1982">1982</option>
						 
						<option value="1981">1981</option>
						 
						<option value="1980">1980</option>
						 
						<option value="1979">1979</option>
						 
						<option value="1978">1978</option>
						 
						<option value="1977">1977</option>
						 
						<option value="1976">1976</option>
						 
						<option value="1975">1975</option>
						 
						<option value="1974">1974</option>
						 
						<option value="1973">1973</option>
						 
						<option value="1972">1972</option>
						 
						<option value="1971">1971</option>
						 
						<option value="1970">1970</option>
						 
						<option value="1969">1969</option>
						 
						<option value="1968">1968</option>
						 
						<option value="1967">1967</option>
						 
						<option value="1966">1966</option>
						 
						<option value="1965">1965</option>
						 
						<option value="1964">1964</option>
						 
						<option value="1963">1963</option>
						 
						<option value="1962">1962</option>
						 
						<option value="1961">1961</option>
						 
						<option value="1960">1960</option>
						 
						<option value="1959">1959</option>
						 
						<option value="1958">1958</option>
						 
						<option value="1957">1957</option>
						 
						<option value="1956">1956</option>
						 
						<option value="1955">1955</option>
						 
						<option value="1954">1954</option>
						 
						<option value="1953">1953</option>
						 
						<option value="1952">1952</option>
						 
						<option value="1951">1951</option>
						 
						<option value="1950">1950</option>
						 
						<option value="1949">1949</option>
						 
						<option value="1948">1948</option>
						 
						<option value="1947">1947</option>
						 
						<option value="1946">1946</option>
						 
						<option value="1945">1945</option>
						 
						<option value="1944">1944</option>
						 
						<option value="1943">1943</option>
						 
						<option value="1942">1942</option>
						 
						<option value="1941">1941</option>
						 
						<option value="1940">1940</option>
						 
						<option value="1939">1939</option>
						 
						<option value="1938">1938</option>
						 
						<option value="1937">1937</option>
						 
						<option value="1936">1936</option>
						 
						<option value="1935">1935</option>
						 
						<option value="1934">1934</option>
						 
						<option value="1933">1933</option>
						 
						<option value="1932">1932</option>
						 
						<option value="1931">1931</option>
						 
						<option value="1930">1930</option>
						 
						<option value="1929">1929</option>
						 
						<option value="1928">1928</option>
						 
						<option value="1927">1927</option>
						 
						<option value="1926">1926</option>
						 
						<option value="1925">1925</option>
						 
						<option value="1924">1924</option>
						 
						<option value="1923">1923</option>
						 
						<option value="1922">1922</option>
						 
						<option value="1921">1921</option>
						 
						<option value="1920">1920</option>
						 
						<option value="1919">1919</option>
						 
						<option value="1918">1918</option>
						 
						<option value="1917">1917</option>
						 
						<option value="1916">1916</option>
						 
						<option value="1915">1915</option>
						 
						<option value="1914">1914</option>
						 
						<option value="1913">1913</option>
						 
						<option value="1912">1912</option>
						 
						<option value="1911">1911</option>
						 
						<option value="1910">1910</option>
						 
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