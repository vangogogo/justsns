<?php 
    if(empty($fri_feeds)){
?>
<div class="cGray2 lh35 alC f14px" style="margin:20px 0">暂时没有动态</div>
<?php }else{?>

<volist name="fri_feeds" id="feed">
    <div class="Fli" id="a_feed_{$feed.id}">
        <div class="ico_img"><img src="{$feed.icon}" /></div>
        <div class="LC" style="overflow:hidden;">
            <!--动态title-->
            <div class="tit" alt="{$feed.id}" id="feed_title_{$feed.id}">
                <div class="cl">{$feed.title}</div>
                <div class="cr">
                    <?php if(MODULE_NAME == "Home" || ($mid == $uid) ){?>
                        <?php if(MODULE_NAME == "Home"){?>
                            <div class="pt5"> <a href="javascript:del_feed({$feed.id});" class="del">删除</a></div>
                        <?php }else{?>
                            <div class="pt5"> <a href="javascript:del_feed({$feed.id},1);" class="del">删除</a></div>
                        <?php }?>
                    <?php }?>
                    <div><em>{$feed.cTime|friendlyDate='month'}</em></div>
                </div>
                <div class="c"></div>
            </div>
            <!--end-->
            <!--动态body-->
            <div class="RC" id="feed_body_{$feed.id}">
                <div <?php if($feed["type"] == "mini"){?> class="bg_huifu" <?php }?> >
                    <?php if($feed['type'] == 'mini'){?>
                    <include file="../Public/feed_comment" /> {$feed.body}
                    <?php }else{?>
                    {$feed.body}
                    <?php }?>
                </div>
                <div class="c"></div>

            </div>
            <!--end-->
        </div>

    </div>
</volist>
<?php }?>
<input type='hidden' id='feed_type' value="{$type}">

