<?php // $sid_option = Unit::model()->findAll();          ?> 
<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="index.php?r=pic" class="current"><i></i>图库</a>
        <a href="#" class="current">添加图片</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>添加图片</h5>
        </div>
        <div class="widget-content nopadding">
            <?php
            $form = $this->beginWidget( 'CActiveForm' , array(
                      'id' => 'pic' ,
                      'enableAjaxValidation' => false ,
                      'htmlOptions' => array(
                                'class' => "form-horizontal" ,
                                'enctype' => 'multipart/form-data' ,
                      ) ,
                    ) );
            ?>
            <div class="control-group">
                <label class="control-label">选择图片 :</label>
                <div class="controls">
                    <?php echo $form->fileField( $model , 'big_pic[]' , array( 'multiple' => 'multiple' ) ); ?>
                    注：图片大小不得超过2M。
                </div>
            </div>
            <div class="form-actions">
                <?php echo CHtml::submitButton( $model->isNewRecord ? '确认添加' : '提交修改' , array( 'class' => 'btn btn-success' ) ); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>