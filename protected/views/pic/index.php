<!--breadcrumbs-->
<div id="content-header">
    <div id="breadcrumb"> 
        <a href="index.php?r=admin" title="回到首页" class="tip-bottom"><i class="icon-home"></i>首页</a>
        <a href="javasrcipt:void(0);" class="current">图集</a>
    </div>
</div>
<!--End-breadcrumbs-->
<div class="container-fluid"><hr>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
                    <h5>图库</h5>          
                    <div id="options">
                        <a href="index.php?r=pic/create" class="btn btn-success btn-mini">添加图片</a>
                    </div>
                </div>
                <div class="widget-content">
                    <?php if ( is_array( $pic_data ) ): ?>
                        <div id="carousel1">
                            <?php foreach ( $pic_data as $value ): ?>
                                <img class="cloudcarousel" src="<?php echo $value['big_pic']; ?>" />
                            <?php endforeach; ?>
                            <div id="but1" class="carouselLeft"></div>
                            <div id="but2" class="carouselRight"></div> 
                        </div>
                        <ul class="thumbnails">
                            <?php foreach ( $pic_data as $value ): ?>
                                <li class="span2"> <a> <img src="<?php echo $value['big_pic']; ?>" /> </a>
                                    <div class="actions"> <a title="" class="" href="index.php?r=pic/delete&id=<?php echo $value['id']; ?>"><i class="icon-remove"></i></a> <a class="lightbox_trigger" href="<?php echo $value['big_pic']; ?>"><i class="icon-search"></i></a> </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <ul class="thumbnails">
                            <?php foreach ( $pic_data as $value ): ?>
                                <li class="span1"> <a> <img src="<?php echo $value['big_pic']; ?>" /> </a>
                                    <div class="actions"> <a title="" href="#"><i class="icon-remove"></i></a> <a class="lightbox_trigger" href="<?php echo $value['big_pic']; ?>"><i class="icon-search"></i></a> </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <?php echo $pic_data; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>