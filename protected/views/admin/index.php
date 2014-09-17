<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> <a href="javascript:void(0);" title="首页" class="tip-bottom"><i class="icon-home"></i> 首页</a></div>
</div>
<!--End-breadcrumbs-->

<!--Action boxes-->
<div class="container-fluid">
    <!--Chart-box-->    
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                <h5>成员统计</h5>
            </div>
            <div class="widget-content" >
                <div class="row-fluid">
                    <div class="span9">
                        <div id="chart1" class="example-chart" style="height:300px;"></div>
                    </div>
                    <div class="span3">
                        <ul class="site-stats">
                            <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $uAllTotal; ?></strong> <small>成员总数</small></li>
                            <li class="bg_lh"><i class="icon-globe"></i> <strong><?php echo $unitTotal; ?></strong> <small>部门总数</small></li>
                            <!--<li class="bg_lh"><i class="icon-user"></i> <strong><?php // echo 3;   ?></strong> <small>在线用户</small></li>-->
                            <!--<li class="bg_lh hidden"><i class="icon-tag"></i> <strong>9540</strong> <small>Total Orders</small></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Chart-box-->    
</div>
<link href="js/jqplot/jquery.jqplot.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jqplot/jquery.jqplot.js"></script>
<script type="text/javascript" src="js/jqplot/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="js/jqplot/jqplot.pointLabels.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var userData = <?php echo $uData; ?>;
        $('#chart1').jqplot([userData], {
            title: '部门成员统计',
            animate: !$.jqplot.use_excanvas,
            seriesDefaults: {
                renderer: $.jqplot.BarRenderer,
                pointLabels: {show: true},
                rendererOptions: {
                    barWidth: 40
                            //   varyBarColor: true
                }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    tickOptions: {
//                        angle: -30,       //设置角度
//                        fontFamily: 'Courier New',
                        fontSize: '9pt'
                    }
                },
                yaxis: {
                    min: 0,     //最小单位
//                    max: userTotal,
                    tickInterval: 5,    //单位跨度
                    tickOptions: {
                        fontSize: '9pt'
                    }
                    //                    max:userTotal + 10,
                }
            }
        });
    });
</script>


