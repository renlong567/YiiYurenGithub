<!DOCTYPE html>
<html>
    <head>
        <title>育人学校管理系统</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="css/font-awesome.css" rel="stylesheet" />
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->
    </head>
    <body>
        <div id="loginbox">
            <form id="loginform" class="form-vertical" method="post" action="index.php?r=admin/login">
                <div class="control-group normal_text"> <h3><img src="images/logo2.png" alt="Logo" /><span style="font-family:black">育人学校管理系统</span></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"></i></span>
                            <input type="text" name="LoginForm[username]" placeholder="用户名" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span>
                            <input type="password" name="LoginForm[password]" placeholder="密码" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lb"><i class="icon-lock"></i></span>
                            <input type="text" name="LoginForm[verifyCode]" placeholder="验证码" />
                            <?php
                            $this->widget('CCaptcha', array(
                                'showRefreshButton' => false,
                                'clickableImage' => true,
                                'buttonLabel' => '刷新验证码',
                                'imageOptions' => array(
                                    'alt' => '点击换图',
                                    'title' => '点击换图',
                                    'style' => 'cursor:pointer;',
                                    'id' => 'captcha',
                                )
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!--<span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>-->
                    <span class="pull-right">
                        <a type="submit" href="javascript:ajaxSubmitForm('#loginform','login');" class="btn btn-success ajax_link_button" />登录</a>
                    </span>
                </div>
            </form>
        </div>
        <script src="js/jquery.min.js"></script>  
        <!--<script src="js/matrix.login.js"></script>--> 
        <link href="js/jBox/Skins/Red/jbox.css" rel="stylesheet" type="text/css" />
        <script src="js/jBox/jquery.jBox-2.3.min.js"></script>
        <script src="js/jBox/jquery.jBox-zh-CN.js"></script>
        <script src="js/common.js"></script>
    </body>
</html>