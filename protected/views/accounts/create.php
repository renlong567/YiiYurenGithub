<?php $sid_option = Unit::model()->findAll(); ?>  
<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="index.php?r=accounts" class="current"><i></i>成员列表</a>
        <a href="#" class="current"><?php echo $model->isNewRecord ? '添加新成员' : '修改 ' . $model->name; ?></a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5><?php echo $model->isNewRecord ? '添加新成员' : '修改 ' . $model->name; ?></h5>
        </div>
        <div class="widget-content nopadding">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'accounts',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => "form-horizontal"),
            ));
            ?>
            <div class="control-group">
                <label class="control-label"><?php
                    CHtml::$afterRequiredLabel = ' :';
                    echo $form->labelEx($model, 'sid');
                    ?></label>
                <div class="controls">
                    <?php echo $form->dropDownList($model, 'sid', CHtml::listData($sid_option, 'id', 'name')); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">姓名 :</label>
                <div class="controls">
                    <?php echo $form->textField($model, 'name', array('class' => 'span6', 'placeholder' => '姓名')); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">性别 :</label>
                <div class="controls">
                    <?php
                    switch ($model->isNewRecord)
                    {
                        case TRUE:
                            echo $form->dropDownList(
                                    $model, 'sex', array('男' => '男', '女' => '女'));
                            break;
                        default:
                            echo Chtml::dropDownList(
                                    'Accounts[sex]', $model->sex, array('男' => '男', '女' => '女'));
                            break;
                    }
                    ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">电话 :</label>
                <div class="controls">
                    <?php echo $form->textField($model, 'phone', array('class' => 'span6', 'placeholder' => '电话')); ?>
                    <?php echo $form->error($model, 'phone'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">身份证号 :</label>
                <div class="controls">
                    <?php echo $form->textField($model, 'personal_ID', array('class' => 'span6', 'placeholder' => '身份证号')); ?>
                    <?php echo $form->error($model, 'personal_ID'); ?>
                </div>
            </div>
            <div class="form-actions">
                <?php // echo CHtml::submitButton( $model->isNewRecord ? '确认添加' : '提交修改' , array( 'class' => 'btn btn-success') ); ?>
                <?php echo CHtml::button($model->isNewRecord ? '确认添加' : '提交修改', array('class' => 'btn btn-success', 'onclick' => "ajaxSubmitForm('#ONESHOPGIFTCARDS', 'add')")); ?>
            </div>
<?php $this->endWidget(); ?>
        </div>
    </div>
</div>