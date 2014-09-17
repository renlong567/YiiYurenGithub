<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="#" class="current">制作表单</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>制作表单</h5>
        </div>
        <div class="row-fluid">
            <div id="list_table">
                <div class ="span4">
                    <input type="text" style="margin: 10px;width: 170px;" name="team_num" placeholder="请输入组别" />
                    <input type="button" class="btn btn-success" id="team_sub" name="team_sub" value="保存" />
                    <span></span>
                    <?php
                    $form = $this->beginWidget( 'CActiveForm' , array(
                              'id' => 'table' ,
                              'enableAjaxValidation' => false ,
                              'htmlOptions' => array( 'class' => "table_form" ) ,
                            ) );
                    ?>
                    <input type="text" style="margin: 10px;width: 170px" name="team_title" placeholder="请输入主题" />
                    <?php echo CHtml::submitButton( '生成表单' , array( 'class' => 'btn btn-success' , 'id' => 'create_table' ) ); ?>                 
                    <?php
                    $this->endWidget();
                    ?>
                </div>
                <?php
                foreach ( $unit->findAll() as $c ):
                    ?>
                    <div class="span3">
                        <div class="widget-box">
                            <div class="widget-title">
                                <span class="icon">
                                    <i class="icon-eye-open"></i>
                                </span>
                                <h5><?php echo $c['name'] ?></h5>
                            </div>
                            <?php
                            $this->widget( 'zii.widgets.grid.CGridView' , array(
                                      'dataProvider' => $dataProvider[$c['id']] ,
                                      'cssFile' => 'css/page.css' ,
//                              'pager' => array(
//                                        'class' => 'MyPage' , //定义要调用的分页器类，默认是CLinkPager，需要完全自定义，还可以重写一个，参考我的另一篇博文：http://blog.sina.com.cn/s/blog_71d4414d0100yu6k.html
//                                        'cssFile' => false , //定义分页器的要调用的css文件，false为不调用，不调用则需要亲自己css文件里写这些样式
//                                        'header' => '' , //定义的文字将显示在pager的最前面
//                                        'footer' => '' , //定义的文字将显示在pager的最后面
//                                        'firstPageLabel' => '首页' , //定义首页按钮的显示文字
//                                        'lastPageLabel' => '尾页' , //定义末页按钮的显示文字
//                                        'nextPageLabel' => '下一页' , //定义下一页按钮的显示文字
//                                        'prevPageLabel' => '前一页' , //定义上一页按钮的显示文字
//                              ) ,
                                      'template' => '{items}' ,
                                      'itemsCssClass' => 'table table-bordered data-table dataTable' ,
                                      'htmlOptions' => array( 'class' => 'list_table' ) ,
                                      'columns' => array(
                                                array(
                                                          'selectableRows' => 2 ,
                                                          'class' => 'CCheckBoxColumn' ,
                                                ) ,
//                                        'id' ,
                                                'name' ,
//                                        array(
//                                                  'name' => 'sid' ,
//                                                  'value' => '$data->unit->name' ,
//                                        ) ,
                                                'sex' ,
//                                        'phone' ,
//                                        'personal_ID' ,
//                                            array(
//                                                      'class' => 'CButtonColumn' ,
//                                                      'header' => '操作' ,
//                                                      'template' => '{update}{delete}'
//                                            ) ,
                                      ) ,
                            ) );
                            ?>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
</div>