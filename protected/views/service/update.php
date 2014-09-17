<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="index.php?r=service" class="current"><i></i>游戏联运商管理</a>
        <a href="#" class="current"><?php echo $model->name; ?>&nbsp;&nbsp;信息修改</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5><?php echo $model->name; ?>&nbsp;&nbsp;信息修改</h5>
        </div>
        <div class="widget-content nopadding">
            <form id="update_service" action="#" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">联运商名称 :</label>
                    <div class="controls">
                        <input type="text" class="span6" placeholder="联运商名称" name="Service[name]" value="<?php echo $model->name; ?>" />
                    </div>
                </div>
                <div class="form-actions">
                    <!--<input class="btn btn-success" type="button"  value="提交修改" />-->
                    <input type="button" class="btn btn-success" onclick="ajaxSubmitForm('#update_service', 'update');" value="修改信息" />
                </div>
            </form>
        </div>
    </div>
</div>