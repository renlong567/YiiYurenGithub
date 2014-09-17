<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="#" class="current">成员列表</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>搜索</h5>
        </div>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
            'htmlOptions' => array('class' => "form-horizontal"),
        ));
        ?>
        <div class="control-group">
            <label class="control-label">ID :</label>
            <div class="controls">
                <?php echo $form->textField($model, 'id', array('class' => 'span3', 'placeholder' => '姓名')); ?>
                <?php echo $form->error($model, 'id'); ?>
                <span class='zoom' id='ex1'>
		<img src="images/gallery/imgbox2.jpg" width="100px" height="80px" />
	</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">name :</label>
            <div class="controls">
                <?php echo $form->textField($model, 'name', array('class' => 'span3', 'placeholder' => '电话')); ?>
                <?php echo $form->error($model, 'name'); ?>
            </div>
        </div>
        <div class="form-actions">
            <?php echo CHtml::submitButton( '搜索' , array( 'class' => 'btn btn-success') ); ?>
            <?php // echo CHtml::button($model->isNewRecord ? '确认添加' : '提交修改', array('class' => 'btn btn-success', 'onclick' => "ajaxSubmitForm('#accounts', 'add')")); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>成员列表</h5>
            <div id="options">
                <a class="btn btn-success btn-mini" href="index.php?r=accounts/create">添加新成员</a>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab0">所有成员</a></li>
        </ul>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'list_table',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('class' => "form-horizontal"),
        ));
        ?>
        <div class="widget-content tab-content">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'test-grid',
                'dataProvider' => $model->search(),
//            'filter' => $model,
                'cssFile' => 'css/page.css',
                'pager' => array(
                    'class' => 'MyPage', //定义要调用的分页器类，默认是CLinkPager，需要完全自定义，还可以重写一个，参考我的另一篇博文：http://blog.sina.com.cn/s/blog_71d4414d0100yu6k.html
                    'cssFile' => false, //定义分页器的要调用的css文件，false为不调用，不调用则需要亲自己css文件里写这些样式
                    'header' => '', //定义的文字将显示在pager的最前面
                    'footer' => '', //定义的文字将显示在pager的最后面
                    'firstPageLabel' => '首页', //定义首页按钮的显示文字
                    'lastPageLabel' => '尾页', //定义末页按钮的显示文字
                    'nextPageLabel' => '下一页', //定义下一页按钮的显示文字
                    'prevPageLabel' => '前一页', //定义上一页按钮的显示文字
                ),
                'template' => '{items}<div id="list_footer">{pager}{summary}<div style="clear: both"></div></div>',
                'itemsCssClass' => 'table table-bordered data-table dataTable',
                'htmlOptions' => array('class' => 'tab-pane active'),
                'columns' => array(
                    'id',
                    'name',
                    'pass',
                    'content',
//        array(
//            'class' => 'CButtonColumn',
//        ),
                ),
            ));
            ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>