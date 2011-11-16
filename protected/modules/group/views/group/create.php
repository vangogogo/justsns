<div class="content">
	<?php
		//话题列表
		$this->renderPartial('_form',array('model'=>$group,'category_list'=>$category_list));
	?>
</div>
<div class="sidebar">

    
    <p class="m">真的要建一个新的小组吗？</p>
    <div class="indent"><span class="pl">
    如果想就某一类话题（例如自助游、香港电影、python等）跟别人交流，可以创建一个小组。小组是对同一个话题感兴趣的人的聚集地。<br><br>
    每个人最多可以管理和申请创建15个小组，最多可以参加250个小组。<br><br>
    豆瓣目前有数万个小组，你感兴趣的话题很有可能正在被某个小组热烈讨论，建议你先在下面找找。</span></div>
    <br>
    <h2>豆瓣小组搜索 &nbsp; ·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;·&nbsp;
        </h2><div class="infobox">
    <div class="ex1"><span></span></div>
    <div class="bd">
    <form id="group_search" name="group_search" action="/search" method="get">
    <div class="tc"><input name="q" class="j a_search_text input_search greyinput" type="text" size="20" maxlength="36" value=""></div>
    <div class="tc"><input class="butt" name="group_submit" type="submit" value="搜索小组"> &nbsp; &nbsp;
    
        <input name="topic_submit" class="butt" type="submit" value="搜索发言">
        
    </div></form>
    </div>
     <div class="ex2"><span></span></div>
     </div><br><br><p class="pl2">&gt; <a href="/group/category/1/">浏览小组分类</a></p>

</div>
