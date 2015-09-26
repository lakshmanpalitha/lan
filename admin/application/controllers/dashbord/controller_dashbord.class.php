<?php

class dashbord extends controller {

    function __construct($module) {
        auth::handleLoginAdmin();
        parent::__construct($module);
    }
    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $this->view->render('dashbord/dashbord', true, true, $this->module);
    }

}

?>