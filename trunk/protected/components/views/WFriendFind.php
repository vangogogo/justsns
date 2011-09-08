<?php echo CHtml::beginForm(array('friend/find'),'get'); ?>
			<h2>搜索用户</h2>
			<div class="row">
            <?php $keyword = $_GET['keyword'];
            $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'name'=>'keyword',
                'value'=>$keyword,
                'source'=>array('ac1', 'ac2', 'ac3'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'2',
                ),
                'htmlOptions'=>array(
                'class'=>'t_input'
                ),
            ));
            ?>
           <input type="submit" class="btn_b hander" value="找 人" />
			</div>

<?php echo CHtml::endForm(); ?>
