<?php

class bids extends controller {

    function __construct($module) {
        auth::handleLoginAdmin();
        parent::__construct($module);
    }

    function index() {
        $login_model = $this->loadModel('bids');
        $this->view->bids = $login_model->getBidsList();
        $this->view->render('bids/bids', true, true, $this->module);
    }
    function product($product_id=null) {
        $login_model = $this->loadModel('bids');
        $this->view->bids = $login_model->getBidsList(($product_id));
        $this->view->render('bids/bids', true, true, $this->module);
    }
}

?>