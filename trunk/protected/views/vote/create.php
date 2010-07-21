<?php echo Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/poll.css');?>


<div class="page_title" style="width:100%"> <!-- page_title begin -->
	<h2>
		<span class="right f12px fn"><a href="javascript:history.back( -1 )">返回上一页</a></span>
		<img src="<?php echo THEME_URL;?>images/apps/ico_app06.gif" class="img" />发起投票
	</h2>
	<div class="c"></div>
</div><!-- page_title end -->

		<style>
		.choice-list li{display:block;}
		</style>
		<script>
			$(function(){
				$("#tog_explain").toggle(function(){
					$("#vote_explain").show();
					$(this).text("隐藏投票详细说明");
				},function(){
					$("#vote_explain").hide();
					$(this).text("添加投票详细说明");
				});

				//截止时间
				$("#year option[value='{$date.year}']").attr('selected',true);
				$("#month option[value='{$date.month}']").attr('selected',true);
				$("#day option[value='{$date.day}']").attr('selected',true);
				$("#hour option[value='{$date.hour}']").attr('selected',true);
			});

		  	function check_vote() {

				var title = $.trim($("#title").val());
				if(!title){
					Alert("投票主题不能为空!");
					return false;
				}
				var flag = 0;
				$(".vote_opt").each(function (i) {
					if($.trim($(this).val())) flag++;
				})
				if(flag<2){
					Alert("至少填写2个选项!");
					return false;
				}
				var type = $( '#type' ).val();
				if( type > flag-1 ){
				  Alert( '投票选项不得少于可选选项限数' ) ;
				  return false;
				}
			}

			flag = 1;
			var num_limit=10;
			function more(){
				var new_vote = $( '#vote_default' ).clone();
				if( flag == 1 ){
					$( '.vote_opt' ).each( function( i ){
						flag++;
					});
				}
				new_vote.children( '.alR' ).html( "候选项"+flag+"：" );
				new_vote.find( 'input' ).val( '' );
				flag++;
				$( '#vote_more_options' ).before( new_vote );
				// $("#more_options").show();
				// $("#add_more").hide();
				num_limit--;
				if( num_limit == 0 ){
					$( '#add_more' ).hide();
					return;
				}
			}


		</script>

		
  <div class="pollBox">
  	<div class="LogList">
		<?php echo CHtml::beginForm('','POST',array('onsubmit'=>'return check_vote() '));?>
  		<ul>
	   	  <li>
		  		<div class="left alR" style="width: 15%;">投票主题：</div>
	   		<div class="left" style="width: 85%;">
		  		  <input id="title" name="title" type="text" class="TextH20" id="textfield3" style="width:70%" onblur="this.className='TextH20'" onfocus="this.className='Text2'" maxlength="30"/> 
	   			<a id="tog_explain" href="javascript:void(0)">添加投票详细说明</a>	   		  </div>
				<div class="c"></div>
		  </li>
		  <li id="vote_explain" style="display:none;">
		  		<div class="left alR" style="width: 15%;">详细说明：</div>
		  		<div class="left" style="width: 85%;"><textarea name="explain" rows="5" class="Text"  style="width:90%" onfocus="this.className='Text1';" onblur="this.className='Text';"></textarea>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li><div class="btmlineD"></div></li>
		  <li id="vote_default">
		  		<div class="left alR" style="width: 15%;">候选项1：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项2：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项3：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项4：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项5：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项6：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项7：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项8：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项9：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">候选项10：</div>
	   			<div class="left" style="width: 85%;">
		  		  <input name="opt[]" type="text" class="TextH20 vote_opt" id="textfield3" style="width:70%" onblur="this.className='TextH20 vote_opt'" onfocus="this.className='Text2 vote_opt'" maxlength="30"/>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li id="vote_more_options"><div class="btmlineD"></div></li>
		  <li>
		  		<div class="left alR" style="width: 15%;">&nbsp;</div>
	   			<div class="left" style="width: 85%;"><a id="add_more" href="javascript:more()">增加更多候选项</a></div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">可投选项：</div>
	   			<div class="left" style="width: 85%;">
		  		  	<select id="type" name="type">
					  <option value="0">单选</option>
					  <option value="1">可多选，最多2项</option>
					  <option value="2">可多选，最多3项</option>
					  <option value="3">可多选，最多4项</option>
					  <option value="4">可多选，最多5项</option>
					  <option value="5">可多选，最多6项</option>
					  <option value="6">可多选，最多7项</option>
					  <option value="7">可多选，最多8项</option>
					  <option value="8">可多选，最多9项</option>
					  <option value="9">可多选，最多10项</option>
					  <option value="10">可多选，最多11项</option>
					  <option value="11">可多选，最多12项</option>
					  <option value="12">可多选，最多13项</option>
					  <option value="13">可多选，最多14项</option>
					  <option value="14">可多选，最多15项</option>
					  <option value="15">可多选，最多16项</option>
					  <option value="16">可多选，最多17项</option>
					  <option value="17">可多选，最多18项</option>
					  <option value="18">可多选，最多19项</option>
					  <option value="19">可多选，最多20项</option>
					</select>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">截止时间：</div>
	   			<div class="left" style="width: 85%;">
		  											  <select  style="width: 55px;" name="year" id="year">
										<option value="2008">2008</option>
										<option value="2009">2009</option>
										<option value="2010">2010</option>
										<option value="2011">2011</option>
										<option value="2012">2012</option>
									</select>
									年
									<select  style="width: 42px;" name="month" id="month">
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
									月
									<select style="width: 42px;" name="day" id="day">
										<option value="01">01</option>

									<option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
									日
									<select style="width: 42px;" name="hour" id="hour">
										<option value="0">00</option>
										<option value="1">01</option>
										<option value="2">02</option>
										<option value="3">03</option>
										<option value="4">04</option>
										<option value="5">05</option>
										<option value="6">06</option>
										<option value="7">07</option>
										<option value="8">08</option>
										<option value="9">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
									</select>
								时  </div>
								<div class="c"></div>
								</li>
		  <li>
		  		<div class="left alR" style="width: 15%;">投票权限：</div>
	   			<div class="left" style="width: 85%;">
		  		  	<select id="onlyfriend" name="onlyfriend">
					  <option value="0">任何人可参与</option>
					  <option value="1">仅好友可参与</option>
					</select>
		  		</div>
				<div class="c"></div>
		  </li>
		  <li>
		  		<div class="left alR" style="width: 15%;">&nbsp;</div>
	   			<div class="left" style="width: 85%;">
		  		  <input type="submit" class="btn_b" value="发起投票" />
		  		</div>
				<div class="c"></div>
		  </li>

   		</ul>
		<?php echo CHtml::endForm(); ?>
	  </div> <!-- LogList end  -->
  </div>

  <div class="c"></div>