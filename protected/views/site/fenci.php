<?php
$this->pageTitle=Yii::app()->name . ' - 新浪分词';
$this->breadcrumbs=array(
	'新浪分词',
);
?>
<?php if(!empty($model)):?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'str'); ?>
        <?php echo $form->textArea($model,'str',array('rows'=>6, 'cols'=>80)); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::SubmitButton('Submit'); ?>
	</div>

	<div class="row">
        <?php if(!empty($model->ret)):?>
            <table>
                <tr>
                    <td>分词</td><td>索引</td><td>词性，参考sae分词api</td>
                </tr>
            <?php foreach($model->ret as $one):?>
                <tr>
                    <td><?php echo $one['word']?></td><td><?php echo $one['index']?></td><td><?php echo $one['word_tag']?></td>
                </tr>
            <?php endforeach;?>
            </table>
        <?php endif;?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif;?>
