<footer id="footer">
    <div class="container">
        <div class="col-sm-4">
            <img src="<?php echo URL . FRONTEND ?>public/images/logo.png" alt="#" class="img-responsive logo">
            <p>
                Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
            </p>
        </div>
        <div class="col-sm-4">
            <h5>
                COMMON TAGS
            </h5>
            <ul class="tags">
                <li>
                    <a href="#" class="tag">
                        Vacation
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Rentals
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Deals
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Travel deals
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Vacation deals
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Adriatic coast
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Europe
                    </a>
                </li>
                <li>
                    <a href="#" class="tag">
                        Island
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-2">
            <h5>
                CATEGORIES
            </h5>
            <ul class="list-unstyled">
                <?php               
                if (!empty($this->randCat)) {
                    foreach ($this->randCat as $cat) {
                        ?>
                        <li>
                            <a href="<?php echo URL . FRONTEND ?>bid/listing/?key=&category=<?php echo $cat->category_id ?>&ch=ct">
                                <?php echo $cat->category_name ?>
                            </a>
                        </li>
                    <?php }
                }
                ?>
            </ul>
        </div>
        <div class="col-sm-2">
            <h5>
                Featured Links
            </h5>
            <ul class="list-unstyled">
                <li>
                    <a href="<?php echo URL . "front/index/what_is_lansuwa" ?>">
                        What is Lansuwa
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL . "front/index/how_to_win" ?>">
                        How to Win
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL . "front/index/privacy_policy" ?>">
                        Privacy Policy
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL . "front/index/terms_and_conditions" ?>">
                        Terms and Conditions
                    </a>
                </li>
                <li>
                    <a href="<?php echo URL . "front/index/contact" ?>">
                        Contact Us
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="btmFooter">
        <div class="container">
            <div class="col-sm-7">
                <p>
                    <strong>
                        Copyright 2015 
                    </strong>
                    Lansuwa.lk all right reserved.
                    <strong>
                        &nbsp;&nbsp;&nbsp;Solution By: <a class="btn btn-xs btn-flat ripple-effect btn-primary" href="http://microsola.com" target="_blank">Microsola</a>
                    </strong>
                </p>
            </div>
            <div class="col-sm-5">

                <button type="button" class="btn btn-circle ripple-effect btn-info facebook" onclick="window.open('https://www.facebook.com/Lansuwa.lk', '_blank');">
                          <span class="ti-facebook">
                          </span>
                </button>
                <button type="button" class="btn btn-circle ripple-effect btn-info twitter"  onclick="window.open('https://www.facebook.com/Lansuwa.lk', '_blank');">
                          <span class="ti-twitter">
                          </span>
                </button>
                <button type="button" class="btn btn-circle ripple-effect btn-info google" onclick="window.open('https://plus.google.com/104315030913500470438/about', '_blank');">
                          <span class="ti-google">
                          </span>
                </button>


            </div>
        </div>
    </div>
</footer>