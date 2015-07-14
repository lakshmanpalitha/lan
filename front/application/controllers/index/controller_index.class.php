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
        $this->view->bid_products = $login_model_bid->bidProduts();
        $this->view->render('index/index', false, false, $this->module);
    }

    function jsonProductBid($product_id = null) {
        $login_model_bid = $this->loadModel('bid');
        $pro_bid_time = $login_model_bid->checkProductBidTime($product_id);
        $bid = array();
        if (!empty($pro_bid_time)) {
            $pro_bid_array = array();
            foreach ($pro_bid_time as $pro_bid) {
                if ($pro_bid->bid_type == 'T') {
                    if ($pro_bid->bid_allow_time > $pro_bid->bid_time_def) {
                        $available_time = ($pro_bid->bid_allow_time - $pro_bid->bid_time_def);
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'A';
                        $bid['type'] = 'T';
                        $bid['count'] = date("H:i:s", $available_time);
                        $bid['bid_count_left'] = '-';
                    } else {
                        $bid['id'] = $pro_bid->pro_id;
                        $bid['status'] = 'N';
                        $bid['type'] = '-';
                        $bid['count'] = '-';
                        $bid['bid_count_left'] = '-';
                    }
                } else {
                    $bid['id'] = $pro_bid->pro_id;
                    $bid['status'] = 'A';
                    $bid['type'] = 'C';
                    $bid['count'] = $pro_bid->bid_allow_time;
                    $bid['bid_count_left'] = ($pro_bid->bid_allow_time-$pro_bid->bid_count);
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