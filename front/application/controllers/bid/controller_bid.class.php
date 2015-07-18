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
        } else {
            $this->view->categorys = null;
            $this->view->bid_product = null;
        }
        $this->view->render('bid/bid_detail', false, false, $this->module);
    }

    function listing() {
        $login_model_bid = $this->loadModel('bid');
        $this->view->categorys = $login_model_bid->activeCategory();
        $this->view->bid_products = $login_model_bid->bidProduts();
        $this->view->render('bid/bid_listing', false, false, $this->module);
    }

}

?>