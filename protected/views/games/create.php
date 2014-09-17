<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> 
        <a href="index.php?r=admin" title="回到首页" class="tip-bottom"><i class="icon-home"></i> 首页</a>
        <a href="index.php?r=games" class="tip-bottom"> 游戏管理</a>
        <a href="javasrcipt:;" class="current">添加新游戏</a>
    </div>
</div>
<!--End-breadcrumbs-->
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>添加新游戏</h5>
            <div id="options">
                <a href="index.php?r=games" class="btn btn-success btn-mini">返回游戏列表</a>
            </div>
        </div>
        <div class="widget-content nopadding">
            <form id="add_game" class="form-horizontal" action="index.php?r=games/create" method="post">
                <div class="control-group">
                    <label class="control-label">游戏名称 :</label>
                    <div class="controls">
                        <input type="text" class="span-1" name="Games[name]" placeholder="游戏名称">
                    </div>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn btn-success" onclick="ajaxSubmitForm('#add_game','add');" value="确认添加" />
                </div>
            </form>
        </div>
    </div>
</div>
