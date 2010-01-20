<?php
    include('_top.php');
?>

<?php $form = $this->beginWidget('CActiveForm', array('id'=>'user-form')); ?>

<?php echo $form->errorSummary($model); ?>

<div class="row">

    <?php echo CHtml::activeTextField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
</div>
<div class="row">

    <?php echo CHtml::activeTextField($model,'username'); ?>
    <?php echo $form->error($model,'username'); ?>
</div>

<?php $this->endWidget(); ?>

