<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from pamukovic.com/demo/kupon/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Jun 2015 05:34:34 GMT -->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <?php include DOC_PATH . FRONTEND . "application/views/_templates/head.php"; ?>
    </head>

    <body>
        <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <header>
                <?php include DOC_PATH . FRONTEND . "application/views/_templates/topbar.php"; ?>
                <?php include DOC_PATH . FRONTEND . "application/views/_templates/nav.php"; ?>

                <!-- /#nav wrap -->
            </header>
            <!-- /.search form -->

            <section id="page" class="container mBtm-50">
                <div class="row">
                    <div class="col-sm-12 clearfix mTop-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hpanel">
                                    <div class="panel-body frameLR bg-white shadow">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?php $this->renderFeedbackMessages(); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" mTop-30 col-sm-9 col-sm-offset-3" id="wizardControl">
                                                <div class="wizNav">
                                                    <a class="btn <?php echo ($this->active == 'bid' ? 'btn-primary' : 'btn-default') ?> btn-raised ripple-effect" href="#bid" data-toggle="tab">
                                                        <span class="ti-package"></span>&nbsp;&nbsp;My Bids
                                                    </a>
                                                    <a class="btn <?php echo ($this->active == 'win' ? 'btn-primary' : 'btn-default') ?> btn-raised ripple-effect" href="#win" data-toggle="tab">
                                                        <span class="ti-cup"></span>&nbsp;&nbsp;win product
                                                    </a>
                                                    <a class="btn <?php echo ($this->active == 'profile' ? 'btn-primary' : 'btn-default') ?> btn-raised ripple-effect" href="#profile" data-toggle="tab">
                                                        <span class="ti-user"></span>&nbsp;&nbsp;My Profile
                                                    </a>
                                                    <a class="btn <?php echo ($this->active == 'pwd' ? 'btn-primary' : 'btn-default') ?> btn-raised ripple-effect" href="#pwd" data-toggle="tab">
                                                        <span class="ti-user"></span>&nbsp;&nbsp;Change Password
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div id="bid" class="tab-pane <?php echo ($this->active == 'bid' ? 'active' : '') ?>">

                                                <table class="cart-contents">
                                                    <thead>
                                                        <tr>
                                                            <th class="hidden-xs">
                                                                Image
                                                            </th>
                                                            <th>
                                                                Description
                                                            </th>
                                                            <th>
                                                                Bids
                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($this->bid_summary)) {
                                                            foreach ($this->bid_summary as $summ) {
                                                                ?>
                                                                <tr>
                                                                    <td class="image hidden-xs">
                                                                        <img src="<?php echo URL ?>public/uploads/product/thumb/thumb_<?php echo $summ->product_img ?>" alt="product">
                                                                    </td>
                                                                    <td class="details">
                                                                        <div class="clearfix">
                                                                            <div class="pull-left">
                                                                                <a href="#" class="title">
                                                                                    <?php echo $summ->produc_name ?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="qty">
                                                                        <?php echo $summ->count ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>

                                            </div>

                                            <div id="win" class="tab-pane <?php echo ($this->active == 'win' ? 'active' : '') ?>">

                                                <div class="row">
                                                    <div class="col-sm-8 col-sm-offset-2">

                                                        <div class="alert alert-success alert-dismissible ripple-effect btn-raised" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">
                                                                    ×
                                                                </span>
                                                            </button>
                                                            <strong>
                                                                Oops!
                                                            </strong>
                                                            Thank you ! You have not win product!
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                            <div id="profile" class="tab-pane profile-wrapper <?php echo ($this->active == 'profile' ? 'active' : '') ?>">
                                                <form action="<?php echo URL . FRONTEND ?>users/changeprofile/" method="POST" enctype="multipart/form-data">
                                                    <div class="row text-center m-t-lg m-b-lg">
                                                        <div id="step1" class="tab-pane active">
                                                            <div class="row wizForm">
                                                                <div class="col-lg-3">
                                                                    <h5>
                                                                        Hallo Lakshman
                                                                    </h5>
                                                                    <div class="profile-image-wapper shadow"><img src="<?php echo URL ?>public/uploads/user/thumb/thumb_<?php echo (isset($this->info->user_profile_image) ? $this->info->user_profile_image : '')?>" alt="Profile"></div>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                First Name
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_f_name) ? $this->info->user_f_name : '') ?>" id="fname" class="form-control" name="fname" placeholder="Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Last Name
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_l_name) ? $this->info->user_l_name : '') ?>" id="" class="form-control" name="lname" placeholder="lname">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                E-Mail
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_email) ? $this->info->user_email : '') ?>" id="email" class="form-control" name="email" placeholder="Email">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Telephone
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_land_number) ? $this->info->user_land_number : '') ?>" id="telephone" class="form-control" name="telephone" placeholder="Telphone">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Mobile
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_mobile_number) ? $this->info->user_mobile_number : '') ?>" id="mobile" class="form-control" name="mobile" placeholder="Telphone">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                NIC number
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="text" value="<?php echo (isset($this->info->user_nic_no) ? $this->info->user_nic_no : '') ?>" id="nic" class="form-control" name="nic" placeholder="NIC">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Profile Image
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="file"  id="profile_img" class="form-control" name="profile_img" placeholder="Profile Image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Address
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <textarea id="address" class="form-control" name="address"  rows="6"><?php echo (isset($this->info->user_address) ? $this->info->user_address : '') ?></textarea>
                                                                            </div>
                                                                        </div>     
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                   
                                                    <div class="text-right col-sm-12">
                                                        <button type="submit" class="btn btn-primary btn-raised ripple-effect"> Update Profile </button>
                                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo base64_encode(isset($this->info->user_id) ? $this->info->user_id : '') ?>"/>
                                                    </div>
                                                </form>
                                            </div>                                          
                                            <div id="pwd" class="tab-pane profile-wrapper <?php echo ($this->active == 'pwd' ? 'active' : '') ?>">
                                                <form action="<?php echo URL . FRONTEND ?>users/changePassword/" method="POST">
                                                    <div class="row text-center m-t-lg m-b-lg">
                                                        <div id="step1" class="tab-pane active">

                                                            <div class="row wizForm">                  
                                                                <div class="col-lg-9">
                                                                    <div class="row">
                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                New Password
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="password" value="" id="new_pwd" class="form-control" name="new_pwd" placeholder="New Password">
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group col-lg-12">
                                                                            <label class="col-lg-2">
                                                                                Re-Password
                                                                            </label>
                                                                            <div class="col-lg-10">
                                                                                <input type="password" value="" id="re_pwd" class="form-control" name="re_pwd" placeholder="Re-Password">
                                                                            </div>
                                                                        </div>                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-right col-sm-12">
                                                        <button type="submit" class="btn btn-primary btn-raised ripple-effect">Change Password</button>
                                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo base64_encode(isset($this->info->user_id) ? $this->info->user_id : '') ?>"/>
                                                    </div>
                                                </form>
                                            </div>                                          
                                        </div>                                       
                                        <div class="mBtm-50 clearfix">
                                        </div>                                      



                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /inner wrap -->
                </div>


            </section>

            <!-- /#page ends -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/welcome.php"; ?>
            <!-- /.CTA -->
            <?php include DOC_PATH . FRONTEND . "application/views/_templates/footer.php"; ?>      
        </div>
        <!-- /animitsion -->
        <!-- JS files -->
        <?php include DOC_PATH . FRONTEND . "application/views/_templates/js.php"; ?>


    </body>

</html>