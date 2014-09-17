<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> 
        <a href="index.php?r=admin" title="回到首页" class="tip-bottom"><i class="icon-home"></i> 首页</a>
        <a href="index.php?r=unit" class="tip-bottom"> 部门管理</a>
        <a href="javascript:void(0);" class="current"><?php echo $model->isNewRecord ? '添加新部门' : '修改 ' . $model->name; ?></a>
    </div>
</div>
<!--End-breadcrumbs-->
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5><?php echo $model->isNewRecord ? '添加新部门' : '修改 ' . $model->name; ?></h5>
            <div id="options">
                <a href="index.php?r=unit" class="btn btn-success btn-mini">返回部门管理</a>
            </div>
        </div>
        <div class="widget-content nopadding">
            <?php
            $form = $this->beginWidget( 'CActiveForm' , array(
                      'id' => 'unit' ,
                      'enableAjaxValidation' => false ,
                      'htmlOptions' => array( 'class' => "form-horizontal" ) ,
                    ) );
            ?>
            <div class="control-group">
                <?php echo $form->labelEx( $model , 'name' , array( 'class' => 'control-label' ) ); ?>
                <div class="controls">
                    <?php echo $form->textField( $model , 'name' , array( 'class' => 'span6' , 'placeholder' => '部门名称' ) ); ?>
                    <?php echo $form->error( $model , 'name' ); ?>
                </div>
            </div>
            <div class="form-actions">
                <?php // echo CHtml::submitButton( $model->isNewRecord ? '确认添加' : '保存修改' , array( 'class' => 'btn btn-success' ) ); ?>
                <?php echo CHtml::button( $model->isNewRecord ? '确认添加' : '提交修改' , array( 'class' => 'btn btn-success','onclick'=>"ajaxSubmitForm('#unit', 'add')") ); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>