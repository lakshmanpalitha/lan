<div id="nav-wrap">
    <div class="nav-wrap-holder">
        <div class="container" id="nav_wrapper">
            <nav class="navbar navbar-static-top nav-white" id="main_navbar" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#Navbar">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                    <a  href="<?php echo URL; ?>" class="navbar-brand logo col-sm-3">
                        <img src="<?php echo URL . FRONTEND ?>public/images/logo.png" alt="" class="img-responsive">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="Navbar">
                    <!-- regular link -->
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="<?php echo URL; ?>"  role="button">
                                <i class="ti-home">
                                </i>
                                Home
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="<?php echo URL . FRONTEND ?>bid/listing/"  role="button">
                                All Bids
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URL . "front/index/about" ?>">
                                About Lansuwa
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URL . "front/index/contact" ?>">
                                Contact
                            </a>
                        </li>
                        <?php
                        if ($this->isLog === true) {
                            ?>
                            <li>
                                <a href="<?php echo URL . "front/user/user_profile" ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="ti-user">
                                    </i>
                                    My Account
                                    <span class="caret">
                                    </span>
                                </a>                           
                                <ul class="dropdown-menu" role="menu">
                                    <li>

                                        <a href="<?php echo URL . FRONTEND . "users/profile/" ?>">

                                            My profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL . FRONTEND . "users/mybid/" ?>">
                                            My bid list
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL . FRONTEND . "users/mywin/" ?>">
                                            My win item
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo URL . FRONTEND . "users/pwd/" ?>">
                                            Change My Password
                                        </a>
                                    </li>
                                </ul>                           
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- /.div nav wrap holder -->
</div>