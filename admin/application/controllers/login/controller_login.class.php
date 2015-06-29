<?php

class login extends controller {

    function __construct($module) {
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $this->view->render('login/login', true, false, $this->module);
    }

    function doLogin() {
        $valid = true;
        $login_model = $this->loadModel('login');
        if (!$login_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$login_password = $this->read->get("password", "POST", '', '', true))
            $valid = false;
        if (!$valid) {
            session::setError("feedback_negative", FEEDBACK_FIELD_NOT_VALID_TYPE);
            header('location: ' . URL . 'admin/login/');
        }
        $res = $login_model->login($login_email, $login_password);
        if ($res) {
            header('location: ' . URL . 'admin/');
        } else {
            header('location: ' . URL . 'admin/login/');
        }
    }

    function logout() {
        session::set('user_logged_in', false);
        session::set('user_email', null);
        session::set('user_type', null);
        session::set('user_id', null);
        session::set('user_last_log', null);

        Session::clear('user_logged_in');
        Session::clear('user_email');
        Session::clear('user_type');
        Session::clear('user_id');
        Session::clear('user_last_log');

        header('location: ' . URL . 'admin/login/');
    }

}

?>