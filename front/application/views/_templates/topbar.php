<div class="top-bar bg-light hdden-xs">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 list-inline list-unstyled no-margin hidden-xs">
                <p class="no-margin">
                    Have any questions?
                    <strong>
                        &nbsp;&nbsp; info@lansuwa.lk
                    </strong>
                </p>
            </div>
            <div class="pull-right col-sm-6">
                <ul class="list-inline list-unstyled pull-right">
                    <li>
                        <a href="<?php echo URL . FRONTEND . "users/profile/" ?>">
                            <?php echo ($this->isLog === true ? $this->user : ''); ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL . FRONTEND . "users/" . ($this->isLog === true ? 'signout/' : 'signin/') ?>">
                            <?php echo ($this->isLog === true ? 'Sign Out' : 'Sign In'); ?>
                        </a>
                    </li>
                    <li>
                        <a  href="<?php echo URL . FRONTEND . "users/register/" ?>">
                            Sign Up
                        </a>
                    </li>
                    <li class="active">
                        <a href="<?php echo URL . FRONTEND . "index/faq" ?>">
                            <i class="ti-cart">
                            </i>
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>