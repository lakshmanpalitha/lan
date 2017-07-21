<?php

class bid extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function detail($product_id = null) {
        if ($product_id) {
            $login_model_bid = $this->loadModel('bid');
            $this->view->categorys = $login_model_bid->activeCategory();
            $this->view->bid_product = $login_model_bid->bidProduts(base64_decode($product_id));
            $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        } else {
            $this->view->categorys = null;
            $this->view->bid_product = null;
        }
        $this->view->render('bid/bid_detail', false, false, $this->module);
    }

    function preview($product_id = null) {
        if ($product_id) {
            $login_model_bid = $this->loadModel('bid');
            $this->view->categorys = $login_model_bid->activeCategory();
            $this->view->bid_product = $login_model_bid->bidProduts(base64_decode($product_id), null, null, false);
            $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        } else {
            $this->view->categorys = null;
            $this->view->bid_product = null;
        }
        $this->view->render('bid/bid_priview', false, false, $this->module);
    }

    function listing() {
        $login_model_bid = $this->loadModel('bid');

        if (!$key = $this->read->get("key", "GET", '', '', false))
            $valid = false;
        if (!$cat = $this->read->get("category", "GET", '', '', false))
            $valid = false;
        if (!$title = $this->read->get("ch", "GET", '', '', false))
            $valid = false;
        $key = is_bool($key) ? '' : $key;
        $cat = is_bool($cat) ? '' : $cat;
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->bid_products = $login_model_bid->bidProduts(null, $cat, $key);
        $this->view->top_bid_products = $login_model_bid->topBidsProducts();
        $this->view->key = $key;
        $this->view->cat = $cat;
        if ($title == 'ct') {
            $this->view->title = 'PRODUCT BY CATEGORY';
        } else if ($title == 'sh') {
            $this->view->title = 'PRODUCT BY SEARCH';
        } else {
            $this->view->title = "PRODUCT LISTING PAGE";
        }

        $this->view->render('bid/bid_listing', false, false, $this->module);
    }

    function bidersList($product_id) {
        if ($product_id) {
            $product_id = base64_decode($product_id);
        } else {
            $product_id = '';
        }
        $login_model_bid = $this->loadModel('bid');
        $bid_list = $login_model_bid->bidersList($product_id);
        $data = array('success' => true, 'data' => $bid_list, 'error' => '');
        echo json_encode($data);
    }

}

?>