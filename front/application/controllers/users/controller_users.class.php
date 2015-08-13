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

    function login() {
        $this->view->render('user/user_login', false, false, $this->module);
    }

    function profile() {
        if (auth::handleLogin()) {
            $this->view->bid_summary = $this->login_model_bid->userBidSummary(session::get('user_id'));
            $this->view->info = $this->login_model->userInfo(session::get('user_id'));
            $this->view->active = 'profile';
            $this->view->render('user/user_profile', false, false, $this->module);
        } else {
            header('Location:' . URL . FRONTEND . 'users/login/');
        }
    }

    function changePassword() {
        $valid = true;
        $pwd = array();
        if (!$new_pwd = $this->read->get("new_pwd", "POST", '', '', true))
            $valid = false;
        if (!$re_pwd = $this->read->get("re_pwd", "POST", 'NUMERIC', 150, true))
            $valid = false;
        if (!$user_id = $this->read->get("user_id", "POST", '', '', true))
            $valid = false;
        if ($new_pwd != $re_pwd) {
            session::setError("feedback_negative", FEEDBACK_PASSWORD_MISSMACH);
            $valid = false;
        }
        if ($valid) {
            array_push($pwd, $new_pwd);
            array_push($pwd, base64_decode($user_id));
            $res = $this->login_model->updatePassword($pwd);
        }
        header('Location:' . URL . FRONTEND . 'users/profile/');
    }

    function changeprofile() {
        $user = array();
        $valid = true;
        $imgArray = array();
        if (!$user_id = $this->read->get("user_id", "POST", '', '', true))
            $valid = false;
        if (!$user_fname = $this->read->get("fname", "POST", 'NUMERIC', 150, true))
            $valid = false;
        if (!$user_lname = $this->read->get("lname", "POST", 'NUMERIC', 150, true))
            $valid = false;
        if (!$user_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$user_telephone = $this->read->get("telephone", "POST", 'INT', 10, false))
            $valid = false;
        if (!$user_mobile = $this->read->get("mobile", "POST", 'INT', 10, true))
            $valid = false;
        if (!$user_address = $this->read->get("address", "POST", '', 250, true))
            $valid = false;
        if (!$user_nic_no = $this->read->get("nic", "POST", 'NUMERIC', 10, true))
            $valid = false;

        $user_telephone = is_bool($user_telephone) ? '' : $user_telephone;
        if ($valid) {
            array_push($user, base64_decode($user_id));
            array_push($user, $user_fname);
            array_push($user, $user_lname);
            array_push($user, $user_email);
            array_push($user, $user_telephone);
            array_push($user, $user_mobile);
            array_push($user, $user_address);
            array_push($user, $user_nic_no);
            $imageName = (isset($_FILES['profile_img']) ? $_FILES['profile_img']['name'] : '');
            $imageTemp = (isset($_FILES['profile_img']) ? $_FILES['profile_img']['tmp_name'] : '');
            $imageSize = (isset($_FILES['profile_img']) ? filesize($_FILES['profile_img']['tmp_name']) : 0);
            if ($imageName && $imageTemp && $imageSize > 0) {
                $imgArray['imgname'] = $imageName;
                $imgArray['imgtemp'] = $imageTemp;
                $imgArray['imgsize'] = $imageSize;
            }
            array_push($user, $imgArray);

            $res = $this->login_model->updateProfile($user);
        }
        header('Location:' . URL . FRONTEND . 'users/profile/');
    }

    function jsonLogin() {
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
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderCustomMassage(FEEDBACK_FIELD_NOT_VALID_TYPE, 'negative'));
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
                                    <a  target="_blank" href="' . URL . FRONTEND . 'users/register/" class="btn btn-lg btn-danger ripple-effect btn-primary">
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

    private function check_per_bid_allow($product_id, $user_id) {
        $valid = null;
        $setting = $this->login_model->userBidSetting($user_id);
        if ($setting) {
            $per_product_bid = $this->login_model_bid->userPerProducBid($product_id, $user_id);
            if (is_array($setting) && $setting->user_allow_bid_per_product > 0) {
                if ($setting->user_allow_bid_per_product <= $per_product_bid) {
                    $valid = false;
                } else {
                    $valid = true;
                }
            } else {
                if (DEFAULT_ALLOW_BID_PER_PRODUCT <= $per_product_bid) {
                    $valid = false;
                } else {
                    $valid = true;
                }
            }
        }
        return $valid;
    }

    private function check_tot_bid_allow($product_id, $user_id) {
        $valid = null;
        $setting = $this->login_model->userBidSetting($user_id);
        if ($setting) {
            $tot_bid = $this->login_model_bid->userTotBid($user_id);
            if (is_array($setting) && $setting->user_allow_tot_bid > 0) {
                if ($setting->user_allow_tot_bid <= $tot_bid) {
                    $valid = false;
                } else {
                    $valid = true;
                }
            } else {
                if (DEFAULT_TOTAL_ALLOW_BID <= $tot_bid) {
                    $valid = false;
                } else {
                    $valid = true;
                }
            }
        }
        return $valid;
    }

    private function check_bid_interval_allow($product_id, $user_id = null) {
        $valid = null;
        $setting = $this->login_model->userBidSetting($user_id);
        if ($setting) {
            $product_bid_interval = $this->login_model_bid->productInterval($product_id);
            if (empty($setting->user_bid_interval)) {
                $valid = true;
            } else
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
        }
        return $valid;
    }

    private function check_product_bid_limit_allow($product_id) {
        $valid = null;
        $product = $this->login_model_bid->checkProductBidTime($product_id);
        if ($product) {
            if ($product[0]->bid_status == 'E') {
                $valid = false;
            } else if ($product[0]->bid_type == 'T') {
                if ($product[0]->bid_allow_time > $product[0]->bid_time_def) {
                    $valid = true;
                } else {
                    $valid = false;
                }
            } else {
                if (($product[0]->bid_allow_time - $product[0]->bid_count) > 0) {
                    $valid = true;
                } else {
                    $valid = false;
                }
            }
        }
        return $valid;
    }

    private function cal_interval($product_id, $user_id = null) {
        $setting = $this->login_model->userBidSetting($user_id);
        if ($setting) {
            $product_bid_interval = $this->login_model_bid->productInterval($product_id);
            $time = 0;
            if ($product_bid_interval > 0) {
                $time = ($product_bid_interval - $setting->user_bid_interval);
            } else {
                $time = (DEFAULT_BID_INTERVAL - $setting->user_bid_interval);
            }
            return $this->login_model_bid->calTime($time);
        }
        return false;
    }

    function jsonCheckAccess($product_id = null) {
        $product_id = base64_decode($product_id);
        $display = '';
        if ($product_id) {
            if (session::get('user_logged_in') === true) {
                $valid = $this->check_product_bid_limit_allow($product_id);
                if ($valid === true) {
                    $valid = $this->check_per_bid_allow($product_id, session::get('user_id'));
                    if ($valid === true) {
                        $valid = $this->check_tot_bid_allow($product_id, session::get('user_id'));
                        if ($valid === true) {
                            $valid = $this->check_bid_interval_allow($product_id, session::get('user_id'));
                            if ($valid === true) {
                                $display = $this->print_bid($product_id);
                            } else if ($valid === false) {
                                $display = $this->print_time($this->cal_interval($product_id, session::get('user_id')));
                            }
                        } else if ($valid === false) {
                            $display = $this->print_msg(FEEDBACK_TOT_BID_ERROR);
                        }
                    } else if ($valid === false) {
                        $display = $this->print_msg(FEEDBACK_PER_BID_ERROR);
                    }
                } else {
                    $display = $this->print_msg(FEEDBACK_INVALID_BID_PRODUCT);
                }
                if (is_null($valid)) {
                    $data = array('success' => false, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => true, 'data' => $display, 'error' => '');
                }
            } else {
                $display = $this->print_login();
                $data = array('success' => true, 'data' => $display, 'error' => '');
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->print_msg(FEEDBACK_INVALID_PRODUCT));
        }
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
                $bid_valid = $this->check_product_bid_limit_allow($product_id);
                if ($bid_valid === true) {
                    $bid_valid = $this->check_per_bid_allow($product_id, session::get('user_id'));
                    if ($bid_valid === true) {
                        $bid_valid = $this->check_tot_bid_allow($product_id, session::get('user_id'));
                        if ($bid_valid === true) {
                            $bid_valid = $this->check_bid_interval_allow($product_id, session::get('user_id'));
                        }
                    }
                }
                if ($bid_valid === true) {
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
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderCustomMassage(FEEDBACK_BID_PRICE, 'negative'));
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>