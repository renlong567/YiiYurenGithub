<!DOCTYPE html>
<html>
    <head>
        <title>育人学校管理系统</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <!--<link rel="stylesheet" href="css/fullcalendar.css" />-->    
        <link rel="stylesheet" href="css/matrix-style.css" />
        <link rel="stylesheet" href="css/matrix-media.css" />
        <link rel="stylesheet" href="css/font-awesome.css"  />
        <link rel="stylesheet" href="css/jquery.gritter.css" />
        <!--<link rel="stylesheet" href="css/uniform.css" />-->
        <link rel="stylesheet" href="css/style.css" />
        <script src="js/jquery.min.js"></script>
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->
        <!--<script type="text/javascript" src="js/CloudCarousel.1.0.5.js"></script>-->
        <!--<script type="text/javascript" src="js/jquery.mousewheel.js"></script>  鼠标滚动插件-->
<!--        <script src="js/excanvas.min.js"></script>
        <script src="js/jquery.ui.custom.js"></script> 
        <script src="js/bootstrap.min.js"></script>
        <script src="js/matrix.js"></script>
       <script src="js/jquery.uniform.min.js"></script>     图片上传模块样式及JS-->
        <!--<script src="js/matrix.form_validation.js"></script>-->
        <!--<script src="js/select2.min.js"></script>--> 
<!--    <script src="js/jquery.flot.min.js"></script> 
        <script src="js/jquery.flot.resize.min.js"></script> 
        <script src="js/jquery.peity.min.js"></script> 
        <script src="js/fullcalendar.min.js"></script>     
        <script src="js/matrix.dashboard.js"></script> 
        <script src="js/jquery.gritter.min.js"></script> 
        <script src="js/matrix.interface.js"></script> 
        <script src="js/matrix.chat.js"></script> 
        <script src="js/jquery.validate.js"></script> 
        <script src="js/jquery.wizard.js"></script>        
        <script src="js/matrix.popover.js"></script> 
        <script src="js/jquery.dataTables.min.js"></script> 
        <script src="js/matrix.tables.js"></script> -->
        <link href="js/jBox/Skins/Red/jbox.css" rel="stylesheet" type="text/css" />
        <script src="js/jBox/jquery.jBox-2.3.min.js"></script>
        <script src="js/jBox/jquery.jBox-zh-CN.js"></script>
        <script src="js/jquery.zoom.min.js"></script>
        <script src="js/common.js"></script>
    </head>
    <body>
        <!--Header-part-->
        <div id="header">
            <h1></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar navbar-inverse">
            <ul class="nav">
                <li class="">
                    <a title="" href="javascript:;">
                        <i class="icon icon-user"></i> 
                        <span class="text">老婆万福金安！</span>
                    </a>
                </li>
                <li class=""><a title="退出" href="index.php?r=admin/logout"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
            </ul>
        </div>
        <!--close-top-Header-menu-->
        <!--start-top-serch-->
        <!--        <div id="search">
                    <input type="text" placeholder="Search here..."/>
                    <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
                </div>-->
        <!--close-top-serch-->
        <!--sidebar-menu-->
        <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
            <ul>
                <?php
                $r = Yii::app()->controller->id . '/' . $this->getAction()->getId();
                $navs = array(
                    '后台首页' => array('admin/index', 'icon-home', array()),
                    '成员列表' => array(
                        'accounts/index',
                        'icon-file',
                        array(
//                            '所有成员列表' => 'accounts/index',
//                            '分组显示' => '#',
                        )
                    ),
                    '部门管理' => array('unit/index', 'icon-file', array()),
                    '制作表单' => array('table/index', 'icon-file', array()),
                    '图库' => array('pic/index', 'icon-file', array()),
                    'test' => array('test/index', 'icon-file', array()),
                );
                $html = '';
                foreach ($navs as $key => $value)
                {
                    $num = $child = '';
                    $class = $r == $value[0] ? 'active ' : '';
                    $url = "index.php?r={$value[0]}";
                    $count = count($value[2]);
                    if ($count > 0)
                    {
                        $show = '';
                        $url = '#';
                        $class .= 'submenu ';
                        if (in_array($r, $value[2]))
                        {
                            $class .= 'active nobdtom';
                            $show = 'style="display:block"';
                        }
                        $num = "<span class='label label-important'>{$count}</span>";
                        $child = "<ul {$show}>";
                        foreach ($value[2] as $k => $v)
                        {
                            $cs = $r == $v ? 'current ' : '';
                            $child .= <<<ETO
                                <li><a class="{$cs}" href="index.php?r={$v}">{$k}</a></li>
ETO;
                        }
                        $child .= '</ul>';
                    }
                    $html .= <<<ETO
                        <li class="{$class}"><a href="{$url}"><i class="icon {$value[1]}"></i><span>{$key}</span>{$num}</a>{$child}</li>
ETO;
                }
                echo $html;
                ?>
            </ul>
        </div>
        <!--sidebar-menu-->

        <!--main-container-part-->
        <div id="content">
            <?php echo $content; ?>
        </div>
        <!--end-main-container-part-->

        <!--Footer-part-->
        <div class="row-fluid">
            <div id="footer" class="span12"> 2013 &copy; made by your husband </div>
        </div>
        <!--end-Footer-part-->
    </body>
</html>