<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> 
        <a href="index.php?r=admin" title="回到首页" class="tip-bottom"><i class="icon-home"></i> 首页</a>
        <a href="index.php?r=gameservice" class="tip-bottom"> 游戏联运信息管理</a>
        <a href="javasrcipt:;" class="current">添加新游戏联运信息</a>
    </div>
</div>
<!--End-breadcrumbs-->
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>添加新游戏联运信息</h5>
            <div id="options">
                <a href="index.php?r=gameservice" class="btn btn-success btn-mini">返回游戏联运信息管理</a>
            </div>
        </div>
        <div class="widget-content nopadding">
            <form id="addForm" class="form-horizontal" action="" method="post">
                <div class="control-group">
                    <label class="control-label">选择游戏 :</label>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList(
                                "gs[gameid]" , null , CHtml::listData( $listGames , "id" , "name" ) , array( 'options' => array( $model->gameid => array( 'selected' => true ) ) )
                        );
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">选择联运商 :</label>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList(
                                "gs[sid]" , null , CHtml::listData( $listService , "id" , "name" ) , array( 'options' => array( $model->sid => array( 'selected' => true ) ) )
                        );
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">密钥 :</label>
                    <div class="controls">
                        <input type="text" class="span-1" name="gs[key]" value="<?php echo $model->key;?>" placeholder="密钥">
                    </div>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn btn-success" onclick="ajaxSubmitForm('#addForm','update');" value="确认修改" />
                </div>
            </form>
        </div>
    </div>
</div>
