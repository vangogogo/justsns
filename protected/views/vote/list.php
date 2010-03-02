<div class="LogList">
<?php if(!empty($mini_list)) foreach($mini_list as $vo){?>
	<ul>
	<volist name="data" id="vo">
	  <li class="bg04">
		<div class="box">
		  <div class="c1"><span class="headpic50"><a href="__TS__/space/{$vo.uid}"  class="tips" rel="__TS__/Index/userInfo/uid/{$vo['uid']}"><img src="{$vo.uid|getUserFace}" alt="" /></a></span><a href="__TS__/space/{$vo.uid}" class="U">{$vo.name}</a></div>
		  <div class="left" style="width: 67%;">
			<h3 class="f14px"><a href="__URL__/pollDetail/id/{$vo.id}" class="U"><strong>{$vo.title}</strong></a></h3>
			<p class="cGray2">投票发起时间：{$vo.cTime|friendlyDate}</p>
			<p class="cGray2">目前投票人数：{$vo.vote_num}</p>
			<p><span class="right">此投票由<a href="__TS__/space/{$vo.uid}">{$vo.name}</a>发起。{$vo.id|getIsVote=$mid}</span>
			<php>if( $vo['deadline'] <= time() ){</php>
				<span class="cRed">已结束</span>
				<php>}</php>
			</p>
		  </div>
		  <div class="left alR" style="width: 18%;"> <a href="__URL__/pollDetail/id/{$vo.id}#comment" class="cGray2 U">评论({$vo.commentCount})</a><br />
			  <br />
			<a href="__URL__/pollDetail/id/{$vo.id}" class="btna">去看看</a> </div>
		</div>
		</li>
		</volist>
	</ul>
	<div id="Pagination" class="pagination">{$html}</div>

<?php }?>
<div class="baikeUserPage">
	<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>
</div><!-- LogList end  -->