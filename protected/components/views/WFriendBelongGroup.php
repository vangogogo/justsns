<span class="user-group-rs">
    <?php if(!empty($frienBelongdGroup)):?>
        <?php foreach($frienBelongdGroup as $gid => $gname):?>
            <?php echo $gname?>,
        <?php endforeach;?>
    <?php else:?>
        未分组
    <?php endif;?>
</span>
<div class="user-group-arrow">
    <span class="user-group-arrow-btn"></span>
    <ul class="set-group-list">


        <?php if(!empty($friendGroup)): foreach($friendGroup as $key => $value) : 
                $htmlOptions = array(
                    'data-gid'=>$value->id,
                    'data-fuid'=>$fuid,
                    'data-status'=>!empty($frienBelongdGroup[$value->id]),
                );
                $htmlOptions['id'] = "FriendBelongGroup_{$fuid}_{$value->id}" 
        ;?>

        <li>
            <?php #echo CHtml::CheckBox($htmlOptions['id'],!empty($frienBelongdGroup[$value->id]), $htmlOptions); ?>
            <?php #echo CHtml::label($value->name,$htmlOptions['id'],$labelOptions);?>

        <?php
        $this->widget('zii.widgets.jui.CJuiButton',
            array(
                'buttonType'=>'checkbox',

                'name'=>"FriendBelongGroup[{$fuid}][{$value->id}]",
                'caption'=>$value->name,
                'value'=>!empty($frienBelongdGroup[$value->id]),
                'htmlOptions'=>array(
                    'data-gid'=>$value->id,
                    'data-fuid'=>$fuid,
                    'data-status'=>!empty($frienBelongdGroup[$value->id]),
                ),
                #'onclick'=>'js:function(){alert("Save button clicked"); this.blur(); return false;}',
                )
        );
        ?>
        </li>
        <?php endforeach;endif;?>
    </ul>
</div>
