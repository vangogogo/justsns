<div id="maincon_l">
	<?php if(!empty($new_groups)):?>
	<h2>最活跃的小组 ······</h2>
	<div id="grouplist">
		<ul>
			<?php foreach($new_groups as $group):?>
			<li>
				<div id="image">
					<a href="/group/68/"><img src="http://img.u148.net/ghead/2008/d2007121604631.jpg" /></a>
				</div>
				<?php echo CHtml::link($group['name'],array('group/show','gid'=>$group['id']));?>
				(<?php echo CHtml::encode($group['threadcount'])?>)
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	<br/>
	<br/>
	<?php endif;?>
	<h2>小组的最近话题 ······</h2>
	<table class="disli">
		<tr>
			<td>
				话题
			</td>
			<td>
				小组
			</td>
			<td>
				作者
			</td>
			<td width="36">
				回应
			</td>
			<td width="110" align=right>
				最后回应
			</td>
		</tr>
		<tr>
			<td>
				<a href="/topic/14027.html">如果可以选择，下辈子你想成为什么</a>
			</td>
			<td>
				<a href="/group/u149/">童心未泯</a>
			</td>
			<td>
				五月&amp;莲声
			</td>
			<td>
				7
			</td>
			<td align="right">
				<span class="color02">2010-07-25 23:51</span>
			</td>
		</tr>
	</table>
	<div class="height01">
	</div>
	<div class="dislib">
		<a href="/group/list.html">&gt; 更多话题</a>
	</div>
	<br/>
	<br/>
</div>
<div id="maincon_r">
	<div id="sgroup">
		<!-- SiteSearch Google -->
		<form action=" " id="cse-search-box" target="_blank">
			<input type="hidden" name="cx" value="" /><input type="hidden" name="cof" value="FORID:11" /><input type="hidden" name="ie" value="UTF-8" /><input type="text" name="q" size="22" /><input type="submit" name="sa" value=" 站内搜索 " />
		</form>
		<script type="text/javascript" src="http://www.google.com/cse/brand?form=cse-search-box&lang=zh-Hans">
		</script>
		<!-- SiteSearch Google -->
	</div>
	<br/>
	<h2><a href="/group/glist.html">&gt; 浏览所有 <?php echo $groups_count?> 个小组</a></h2>
	<br/>
	<br/>
</div>
