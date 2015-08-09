<div class="col-sm-4 sidebar">
    <div class="inner-side shadow">
        <div class="widget widget-add">
            <hr data-symbol="ADVERTISE">
            <img src="<?php echo URL . FRONTEND ?>public/images/add-1.jpg" alt="add" class="img-responsive">
        </div>
        <div class="widget widget-subscribe">
            <hr data-symbol="SUBSCRIBE">
            <div class="newsletter">
                <h4>
                    Get Updates
                                        <span class="color-orange">
                                            (it’s free)
                                        </span>
                </h4>
                <p>
                    Subscribe to our newsletter for good deals, sent out every month.
                </p>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger btn-raised ripple-effect" type="button">
                                                Subscribe
                                            </button>
                                        </span>
                </div>
            </div>
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
                            <a href="<?php echo $cat->category_id ?>">
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
            <div class="media media-sm entry-rating">
                <div class="media-left">
                    <img class="media-object" src="<?php echo URL . FRONTEND ?>public/images/affiliate-8.jpg" alt="blog-thumb">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">
                        <a href="#">
                            Sirenis Punta Cana Resort Casino
                        </a>
                    </h5>
                    <p class="stars">
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-start">
                        </i>
                        <i class="ti-star disabled">
                        </i>
                    </p>
                    <ul class="list-inline">
                        <li>
                            <p class="price line-trough">
                                $399.00
                            </p>
                        </li>
                        <li>
                            <p class="price">
                                $99.00
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /entry rating -->
            <div class="media media-sm entry-rating">
                <div class="media-left">
                    <img class="media-object" src="<?php echo URL . FRONTEND ?>public/images/affiliate-7.jpg" alt="blog-thumb">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">
                        <a href="#">
                            Plaza Resort Hotel & SPA
                        </a>
                    </h5>
                    <p class="stars">
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-start">
                        </i>
                        <i class="ti-star">
                        </i>
                    </p>
                    <ul class="list-inline">
                        <li>
                            <p class="price line-trough">
                                $423.00
                            </p>
                        </li>
                        <li>
                            <p class="price">
                                $86.00
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /entry rating -->
            <div class="media media-sm entry-rating">
                <div class="media-left">
                    <img class="media-object" src="<?php echo URL . FRONTEND ?>public/images/affiliate-1.jpg" alt="blog-thumb">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">
                        <a href="#">
                            Wyndham Garden at Palmas del Mar
                        </a>
                    </h5>
                    <p class="stars">
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-star">
                        </i>
                        <i class="ti-start">
                        </i>
                        <i class="ti-star">
                        </i>
                    </p>
                    <ul class="list-inline">
                        <li>
                            <p class="price line-trough">
                                $789.00
                            </p>
                        </li>
                        <li>
                            <p class="price">
                                $243.00
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /entry rating -->
        </div>
        <!-- /widget -->
    </div>
    <!-- /col 4 - sidebar -->
</div>