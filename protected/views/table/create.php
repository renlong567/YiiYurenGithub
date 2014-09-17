<?php $sid_option = Service::model()->findAll(); ?>
<?php $gid_option = Games::model()->findAll(); ?>
<div id="content-header">
    <div id="breadcrumb">
        <a href="index.php" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="index.php?r=servers" class="current"><i></i>游戏区服管理</a>
        <a href="#" class="current">建立新服务器</a>
    </div>
</div>
<div class="container-fluid">
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-th"></i>
            </span>
            <h5>建立新服务器</h5>
        </div>
        <div class="widget-content nopadding">
            <form id="add_servers" action="index.php?r=servers/create" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label">选择联运商 :</label>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList(
                                "Servers[sid]" , null , CHtml::listData( $sid_option , "id" , "name" ) );
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">选择游戏 :</label>
                    <div class="controls">
                        <?php
                        echo CHtml::dropDownList(
                                "Servers[gid]" , null , CHtml::listData( $gid_option , "id" , "name" ) );
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">服务器名称 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[name]" placeholder="服务器名称" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Web地址 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[domain]" placeholder="Web地址" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">连接地址 :</label>
                    <div class="controls">
                        <input type="text"  class="span6" name="Servers[linkip]" placeholder="连接地址" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">内网地址 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[address]" placeholder="内网地址" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">端口 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[port]" placeholder="端口" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">管理端口 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[mport]" placeholder="管理端口" value="" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">限制ip列表 :</label>
                    <div class="controls">
                        <textarea class="span6" name="Servers[iplist]"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">服务器状态 :</label>
                    <div class="controls">
                        <input type="text" class="span6" name="Servers[status]" placeholder="服务器状态" value="" />
                        <p>0-停止 1-运行</p>
                    </div>
                </div>
                <div class="form-actions">
                    <input type="button" class="btn btn-success" onclick="ajaxSubmitForm('#add_servers', 'add');" value="确认建立" />
                </div>
            </form>
        </div>
    </div>
</div>