<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="#" class="current">部门管理</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>所有部门列表</h5>
            <div id="options">
                <a class="btn btn-success btn-mini" href="index.php?r=unit/create">添加新部门</a>
            </div>
        </div>
        <div class="widget-content nopadding">
            <?php
            $this->widget( 'zii.widgets.grid.CGridView' , array(
                      'dataProvider' => $dataProvider ,
                      'cssFile' => 'css/page.css' ,
                      'pager' => array(
                                'class' => 'MyPage' , //定义要调用的分页器类，默认是CLinkPager，需要完全自定义，还可以重写一个，参考我的另一篇博文：http://blog.sina.com.cn/s/blog_71d4414d0100yu6k.html
                                'cssFile' => false , //定义分页器的要调用的css文件，false为不调用，不调用则需要亲自己css文件里写这些样式
                                'header' => '' , //定义的文字将显示在pager的最前面
                                'footer' => '' , //定义的文字将显示在pager的最后面
                                'firstPageLabel' => '首页' , //定义首页按钮的显示文字
                                'lastPageLabel' => '尾页' , //定义末页按钮的显示文字
                                'nextPageLabel' => '下一页' , //定义下一页按钮的显示文字
                                'prevPageLabel' => '前一页' , //定义上一页按钮的显示文字
                      ) ,
                      'template' => '{items}<div id="list_footer">{pager}{summary}<div style="clear: both"></div></div>' ,
                      'itemsCssClass' => 'table table-bordered data-table dataTable' ,
                      'htmlOptions' => array( 'class' => 'list_table' ) ,
                      'id' => 'list_table' ,
                      'columns' => array(
                                'id' ,
                                'name' ,
                                array(
                                          'class' => 'CButtonColumn' ,
                                          'header' => '操作' ,
                                          'template' => '{update}{delete}' ,
                                          'deleteConfirmation' => "js:'删除部门将干掉其下的所有成员，老婆你确定要删除 \"'+$(this).parent().parent().children(':first-child').next().text()+'\" ？'" ,
                                ) ,
                      ) ,
            ) );
            ?>
        </div>
    </div>
</div>