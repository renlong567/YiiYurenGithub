<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="index.php?r=service" class="current"><i></i>游戏联运商管理</a>
        <a href="#" class="current">建立新联运商</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>建立新联运商</h5>
        </div>
        <div class="widget-content nopadding">
            <form id="add_service" action="index.php?r=service/create" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">联运商名称 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Service[name]" placeholder="联运商名称" value="" />
                    </div>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn btn-success" onclick="ajaxSubmitForm('#add_service', 'add');" value="确认建立" />
                </div>
            </form>
        </div>
    </div>
</div>