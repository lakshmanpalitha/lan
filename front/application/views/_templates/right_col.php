<div class="col-sm-4 sidebar">
    <div class="inner-side shadow">
        <div class="widget widget-add">
            <hr data-symbol="ADVERTISE">
            <img src="<?php echo URL . FRONTEND ?>public/images/add-1.jpg" alt="add" class="img-responsive">
        </div>

        <!-- /.widget -->
        <div class="widget widget-menu">
            <hr data-symbol="CATEGORIES">
            <!-- Sidebar navigation -->
            <ul class="nav sidebar-nav">
                <?php
                if (!empty($this->categorys)) {
                    foreach ($this->categorys as $cat) {
                        ?>
                        <li>
                            <a href="<?php echo URL . FRONTEND ?>bid/listing/?key=&category=<?php echo $cat->category_id ?>&ch=ct">
                                <i class="ti-gift">
                                </i>
                                <?php echo $cat->category_name ?>
                                <span class="sidebar-badge">
                                    <?php echo $cat->pro_count ?>
                                </span>
                            </a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
            <!-- Sidebar divider -->
        </div>
        <!-- /widget -->
        <div class="widget widget-featured">
            <hr data-symbol="BEST RATED">
            <?php
            if (!empty($this->top_bid_products)) {
                foreach($this->top_bid_products as $pro){
                ?>
                <div class="media media-sm entry-rating">
                    <div class="media-left">
                        <img class="media-object" src="<?php echo URL ?>public/uploads/product/medium/medium_<?php echo trim($pro->pro_img) ?>" alt="blog-thumb">
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?php echo URL . FRONTEND ?>bid/detail/<?php echo base64_encode($pro->pro_id) ?>/">
                                <?php echo $pro->pro_name ?>
                            </a>
                        </h5>
                        <ul class="list-inline">
                            <li>
                                <p class="price">
                                   <?php //echo $pro->pro_price ?>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } 
            }?>
            <!-- /entry rating -->
        </div>
        <!-- /widget -->
    </div>
    <!-- /col 4 - sidebar -->
</div>