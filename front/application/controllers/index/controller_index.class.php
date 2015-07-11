<?php

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

}

?>