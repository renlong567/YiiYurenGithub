<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chat-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_fromuser_id'); ?>
		<?php echo $form->textField($model,'chat_fromuser_id'); ?>
		<?php echo $form->error($model,'chat_fromuser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_touser_id'); ?>
		<?php echo $form->textField($model,'chat_touser_id'); ?>
		<?php echo $form->error($model,'chat_touser_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_path'); ?>
		<?php echo $form->textField($model,'chat_path',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'chat_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_received'); ?>
		<?php echo $form->textField($model,'chat_received'); ?>
		<?php echo $form->error($model,'chat_received'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'chat_date'); ?>
		<?php echo $form->textField($model,'chat_date'); ?>
		<?php echo $form->error($model,'chat_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->