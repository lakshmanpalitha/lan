<?php

header('Access-Control-Allow-Origin: *');

class index extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->bid_products = $login_model_bid->bidProduts();
        $this->view->render('bid/bid_home', false, false, $this->module);
    }

    function contact() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/contact', false, false, $this->module);
    }

    function jsonSendContact() {
        $user = array();
        $valid = true;
        if (!$name = $this->read->get("name", "POST", '', 100, true))
            $valid = false;
        if (!$web_site = $this->read->get("website", "POST", '', 250, false))
            $valid = false;
        if (!$mesaage = $this->read->get("message", "POST", '', 1500, true))
            $valid = false;
        if (!$email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if ($valid) {
            include(DOC_PATH . "config/emails.php");
            $res = $this->sendMail($lansuwa_contact_us_email, $lansuwa_contact_us_email_subject, REQUEST_SUBMIT_EMAIL);
            $data = array('success' => true, 'data' => $this->view->renderCustomMassage(FEEDBACK_CONTACT_US, 'positive'), 'error' => '');
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function about() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/about', false, false, $this->module);
    }

    function faq() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/faq', false, false, $this->module);
    }

    function how_to_win() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/how_to_win', false, false, $this->module);
    }

    function privacy_policy() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/privacy_policy', false, false, $this->module);
    }

    function terms_and_conditions() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/terms_and_conditions', false, false, $this->module);
    }

    function what_is_lansuwa() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/what_is_lansuwa', false, false, $this->module);
    }



    function how_to_register() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->render('pages/how_to_register', false, false, $this->module);
    }

    function detail() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->bid_products = $login_model_bid->bidProduts();
        $this->view->render('bid/bid_detail', false, false, $this->module);
    }

    function jsonProductBid($product_id = null) {
        if ($product_id) {
            $product_id = base64_decode($product_id);
        }
        $login_model_bid = $this->loadModel('bid');
        $login_model_user = $this->loadModel('users');


        $pro_bid_time = $login_model_bid->checkProductBidTime($product_id);
        $bid = array();
        $pro_bid_array = array();
        if (!empty($pro_bid_time)) {
            foreach ($pro_bid_time as $pro_bid) {
                if ($pro_bid->bid_type == 'T') {
                    if ($pro_bid->bid_allow_time > $pro_bid->bid_time_def) {
                        $available_time = ($pro_bid->bid_allow_time - $pro_bid->bid_time_def);
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'A';
                        $bid['type'] = 'T';
                        $bid['count'] = $login_model_bid->time($available_time);
                        $bid['bid_count_left'] = '-';
                        $bid['user_count'] = $pro_bid->count_users;
                        $bid['bid_count'] = $pro_bid->bid_count;
                    } else {
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'N';
                        $bid['type'] = '-';
                        $bid['count'] = '-';
                        $bid['bid_count_left'] = '-';
                        $bid['user_count'] = $pro_bid->count_users;
                        $bid['bid_count'] = $pro_bid->bid_count;
                    }
                } else {


                    $bid_allow_count = (($pro_bid->bid_allow_time - $pro_bid->bid_count));
                    //***************This is for temprely.
                    if (session::get('user_id')) {
                        $user_id = session::get('user_id');
                        $setting = $login_model_user->userBidSetting($user_id);
                        $per_product_bid = $login_model_bid->userPerProducBid($pro_bid->pro_id, $user_id);
                        if (is_array($setting) && $setting->user_allow_bid_per_product > 0) {
                            $bid_count_left = ($setting->user_allow_bid_per_product - $per_product_bid);
                            $bid_allow_time = $setting->user_allow_bid_per_product;
                        } else {
                            $bid_count_left = (DEFAULT_ALLOW_BID_PER_PRODUCT - $per_product_bid);
                            $bid_allow_time = DEFAULT_ALLOW_BID_PER_PRODUCT;
                        }
                    } else {
                        $bid_count_left = DEFAULT_ALLOW_BID_PER_PRODUCT;
                        $bid_allow_time = DEFAULT_ALLOW_BID_PER_PRODUCT;
                    }
                    //*******************************************

                    if ($bid_allow_count > 0) {
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'A';
                        $bid['type'] = 'C';
                        //$bid['count'] = $pro_bid->bid_allow_time;
                        $bid['count'] = $bid_allow_time; //***********temperaly
                        //$bid['bid_count_left'] = ($bid_allow_count > 0 ? $bid_allow_count : 0);
                        $bid['bid_count_left'] = $bid_count_left; //***********temperaly
                        $bid['user_count'] = $pro_bid->count_users;
                        $bid['bid_count'] = $pro_bid->bid_count;
                    } else {
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'N';
                        $bid['type'] = '-';
                        $bid['count'] = '-';
                        $bid['bid_count_left'] = '-';
                        $bid['user_count'] = $pro_bid->count_users;
                        $bid['bid_count'] = $pro_bid->bid_count;
                    }
                }
                array_push($pro_bid_array, $bid);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => '');
        }
        $data = array('success' => true, 'data' => $pro_bid_array, 'error' => '');
        echo json_encode($data);
    }

}

?>