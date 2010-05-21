<script type="text/javascript" charset="utf-8">
var items_per_page = "<?php echo ($perpage); ?>";
var next_text      = "<?php echo ($next); ?>";
var prev_text      = "<?php echo ($prev); ?>";
var appid          = <?php echo ($appid); ?>;
var mid            = <?php echo ($mid); ?>;
var filed          = '<?php echo ($filed); ?>';
var type = "<?php echo ($type); ?>";

</script>
<?php 

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/pagination/jquery.pagination.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/pagination/pagination.css');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/pagination/Comment.js');

?>

<script type="text/javascript">

$(document).bind("keydown","ctrl+return",function(evt){
	//addComment($('#content_submit'));
	return false;
});
</script>

<div id="content1" class="Guestbook">
	<div class="tit">
	<div class="right pr5" style="position: relative; width: 40px; height: 29px;">
		<a class="phizIco" id="bqBottom" href="###" onclick='bq_show();' title="插入表情">插入表情</a>
		<div class="phiz" style="display: none; width: 365px; right: 0; top: 31px; line-height: 0px;" id="smileylist">
			<?php if(is_array($icon_list)): ?>
			<?php $k = 0;?><?php $__LIST__ = $icon_list?>
				<?php if( count($__LIST__)==0 ) : echo "" ; ?>
			<?php else: ?>
				<?php foreach($__LIST__ as $key=>$bq): ?><?php ++$k;?><?php $mod = ($k % 2 )?>
				<div class="ico_link hand">
					<img src="<?php echo Yii::app()->request->baseUrl.'/images/biaoqing/mini/'.$bq["filename"]?>" emotion="<?php echo ($bq["emotion"]); ?>" title="<?php echo ($bq["title"]); ?>" onclick="insertBQ(this,<?php echo ($k-1);?>);" />
				</div>
				<?php endforeach; ?><?php endif; ?><?php else: echo "" ;?>
			<?php endif; ?>
		</div>
	</div>
	<span class="pl5">添加评论</span>
	</div>
	<div class="GB_box">
		<textarea id="content_text" name="textarea" class="Text" onBlur="this.className='Text'" onFocus="this.className='Text1'"></textarea>
		<input id="content_submit" onclick="addComment($(this))" type="button" class="btn_b" value="发表留言" /> 
		<!--<span class="cGray">(每条最多2000字)</span>-->
		<input id="quietly" name="quietly" type="checkbox" value="1" />悄悄话
	</div>
</div>
<div id="loadding"></div>

<div id="comment" class="critique">
	<!-- 评论列表 begin  -->
	<ul>
	</ul>
	<div id="Pagination" class="pagination"></div>
	<div id="Searchresult"></div>
	<input id="toId" type="hidden" value="">
</div>

<div id="replay2" style="display: none">
	<div class="pt5 clear">
		<div style="width: 50px;" class="left">
			<span class="pic38"><img id="face" src="<?php echo ($face); ?>" /></span>
		</div>
		<div style="margin-left: 50px; overflow: hidden;">
			<textarea onfocus="this.className='Text1'" id="content2" onblur="this.className='Text'" class="Text" style="width: 99%; _width: 98%;" rows="4" name="textarea"> </textarea>
			<input onclick="ReplayComment( $( this ) )" type="button" value="回 复" class="btn_b mt5" /> 
			<input onclick="cancel( $( this ) )" type="button" value="取消" class="btn_w mt5" />
		</div>
	</div>
</div>
<input type="hidden" id='url' value="<?php echo ($url); ?>">