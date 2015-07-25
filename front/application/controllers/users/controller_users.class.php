<?php

header('Access-Control-Allow-Origin: *');

class users extends controller {

    private $login_model;
    private $login_model_bid;

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);

        $this->login_model = $this->loadModel('users');
        $this->login_model_bid = $this->loadModel('bid');
    }

    function jsonLogin($product_id = null) {
        $valid = true;
        $user = array();
        if (!$login_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$login_password = $this->read->get("pwd", "POST", '', '', true))
            $valid = false;
        if ($valid) {
            $res = $this->login_model->login($login_email, $login_password);
            if ($res) {
                $data = array('success' => true, 'data' => '', 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_FIELD_NOT_VALID_TYPE);
        }
        echo json_encode($data);
    }

    private function print_bid($product_id) {
        $html_bid = '<div class="row center-text">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>
                                                What is your minimum price
                                            </label>
                                            <form id="user_bid_form">
                                                <input  type="text" name="bid_price" class="form-control center-text" id="bid_price" value="">
                                                <input  type="hidden" name="product_id" class="form-control center-text" id="product_id" value="' . base64_encode($product_id) . '">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                        <input onclick="bidnow()" type="button" class="btn btn-success btn-raised ripple-effect btn-block" value="BID NOW">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6 pad-adjust">
                                        <input type="submit" class="btn btn-danger btn-raised ripple-effect" value="CANCEL">
                                    </div>
                                </div>
                            </div>';
        return $html_bid;
    }

    private function print_login() {

        $html_login = '<div class="row">
                                <div id="user_login" class="col-sm-6">
                                    <label class="center-text">
                                        Please Login Add your Bid
                                    </label>
                                    <form id="user_login_form">
                                        <input class="form-control" name="email" id="email" type="text" placeholder="User Email...">
                                        <input class="form-control" name="pwd" id="pwd" type="password" placeholder="password...">
                                    </form>
                                    <button onclick="login()" class="btn btn-lg btn-raised ripple-effect btn-primary" type="button">
                                        <span class="ti-lock"> LOGIN</span>
                                        <span class="ink animate " style="height: 122px; width: 122px; top: -42.8667px; left: 45.5px;"></span>
                                    </button>
                                </div>
                                <div id="user_register"  class="col-sm-6">
                                    <div>
                                        <label class="center-text">
                                            Create your Account Now
                                        </label>
                                    </div>
                                    <a  target="_blank" href="<?php echo URL . FRONTEND ?>users/register/" class="btn btn-lg btn-danger ripple-effect btn-primary">
                                        <span class="ti-user"> Registor</span>
                                        <span class="ink animate ti-lock" style="height: 122px; width: 122px; top: -42.8667px; left: 45.5px;"></span>
                                    </a>
                                </div>
                            </div>';
        return $html_login;
    }

    private function print_msg($msg) {
        return "<div id='bid_msg'>" . $msg . "</div>";
    }

    private function print_time($msg) {
        return "<div id='bid_interval'>" . $msg . "</div>";
    }

    private function check_per_bid_allow($product_id) {
        $valid = true;
        $setting = $this->login_model->userBidSetting(session::get('user_id'));
        $per_product_bid = $this->login_model_bid->userPerProducBid($product_id, session::get('user_id'));
        if (is_array($setting) && $setting->user_allow_bid_per_product > 0) {
            if ($setting->user_allow_bid_per_product <= $per_product_bid) {
                $valid = false;
            }
        } else {
            if (DEFAULT_ALLOW_BID_PER_PRODUCT <= $per_product_bid) {
                $valid = false;
            }
        }
        return $valid;
    }

    private function check_tot_bid_allow($product_id) {
        $valid = true;
        $setting = $this->login_model->userBidSetting(session::get('user_id'));
        $tot_bid = $this->login_model_bid->userTotBid(session::get('user_id'));
        if (is_array($setting) && $setting->user_allow_tot_bid > 0) {
            if ($setting->user_allow_tot_bid <= $tot_bid) {
                $valid = false;
            }
        } else {
            if (DEFAULT_TOTAL_ALLOW_BID <= $tot_bid) {
                $valid = false;
            }
        }
        return $valid;
    }

    private function check_bid_interval_allow($product_id) {
        $valid = true;
        $setting = $this->login_model->userBidSetting(session::get('user_id'));
        $product_bid_interval = $this->login_model_bid->productInterval($product_id);
        if ($product_bid_interval > 0) {
            if ($setting->user_bid_interval >= $product_bid_interval) {
                $valid = true;
            } else {
                $time = ($product_bid_interval - $setting->user_bid_interval);
                $valid = false;
            }
        } else {
            if ($setting->user_bid_interval >= DEFAULT_BID_INTERVAL) {
                $valid = true;
            } else {
                $time = (DEFAULT_BID_INTERVAL - $setting->user_bid_interval);
                $valid = false;
            }
        }
        return $valid;
    }

    private function cal_interval($product_id) {
        $setting = $this->login_model->userBidSetting(session::get('user_id'));
        $product_bid_interval = $this->login_model_bid->productInterval($product_id);
        $time = 0;
        if ($product_bid_interval > 0) {
            $time = ($product_bid_interval - $setting->user_bid_interval);
        } else {
            $time = (DEFAULT_BID_INTERVAL - $setting->user_bid_interval);
        }
        return $this->login_model_bid->calTime($time);
    }

    function jsonBidInterval($product_id = null) {
        if (session::get('user_logged_in')) {
            if ($product_id) {
                $valid = $this->check_bid_interval_allow($product_id);
                if ($valid) {
                    $data = array('success' => true, 'data' => 0, 'error' => '');
                } else {
                    $data = array('success' => true, 'data' => $this->print_time($this->cal_interval($product_id)), 'error' => '');
                }
            } else {
                $data = array('success' => true, 'data' => 0, 'error' => '');
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->print_msg(FEEDBACK_INVALID_SESSION));
        }
        echo json_encode($data);
    }

    function jsonCheckAccess($product_id = null) {
        $product_id = base64_decode($product_id);
        $display = '';
        $valid = true;
        $recall = 'N';
        if ($product_id) {
            if (session::get('user_logged_in') === true) {
                $valid = $this->check_per_bid_allow($product_id);
                if ($valid) {
                    $valid = $this->check_tot_bid_allow($product_id);
                    if ($valid) {
                        $valid = $this->check_bid_interval_allow($product_id);
                        if ($valid) {
                            $display = $this->print_bid($product_id);
                        } else {
                            $display = $this->print_time($this->cal_interval($product_id));
                            $recall = 'Y';
                        }
                    } else {
                        $display = $this->print_msg(FEEDBACK_TOT_BID_ERROR);
                    }
                } else {
                    $display = $this->print_msg(FEEDBACK_PER_BID_ERROR);
                }
            } else {
                $display = $this->print_login();
            }
        } else {
            $data = array('success' => false, 'recall' => $recall, 'data' => '', 'error' => $this->print_msg(FEEDBACK_INVALID_PRODUCT));
        }
        $data = array('success' => true, 'recall' => $recall, 'data' => $display, 'error' => '');
        echo json_encode($data);
    }

    function register() {
        $this->view->render('user/user_register', false, false, $this->module);
    }

    function jsonRegister() {
        $valid = true;
        $data = array();
        $user = array();

        if (!$user_name = $this->read->get("name", "POST", 'STRING', 250, true))
            $valid = false;
        if (!$user_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$re_user_email = $this->read->get("re_email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$user_pwd = $this->read->get("pwd", "POST", '', '', true))
            $valid = false;
        if (!$user_re_pwd = $this->read->get("re_pwd", "POST", '', '', true))
            $valid = false;

        if ($valid) {
            $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : null;
            if ($user_pwd != $user_re_pwd) {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_PASSWORD_MISSMACH);
            } else if ($user_email != $re_user_email) {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMAIL_MISSMACH);
            } else {
                array_push($user, $user_name);
                array_push($user, $user_email);
                array_push($user, $user_pwd);
                $res = $this->login_model->register($user);
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }

        echo json_encode($data);
    }

    function userBid() {
        $valid = true;
        $bid = array();
        $bid_valid = true;
        if (!$bid_price = $this->read->get("bid_price", "POST", 'DOUBLE', 6, true))
            $valid = false;
        if (!$product_id = $this->read->get("product_id", "POST", '', '', true))
            $valid = false;
        if ($valid) {
            $product_id = base64_decode($product_id);
            if ($bid_price > 0) {
                $bid_valid = $this->check_per_bid_allow($product_id);
                if ($bid_valid) {
                    $bid_valid = $this->check_bid_interval_allow($product_id);
                    if ($bid_valid) {
                        $bid_valid = $this->check_bid_interval_allow($product_id);
                    }
                }
                if ($bid_valid) {
                    array_push($bid, $bid_price);
                    array_push($bid, $product_id);
                    $res = $this->login_model_bid->addBid($bid);
                    if ($res) {
                        $data = array('success' => true, 'data' => $this->print_msg(FEEDBACK_BID_DONE), 'error' => '');
                    } else {
                        $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                    }
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->print_msg(FEEDBACK_INVALID_BID));
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_BID_PRICE);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>