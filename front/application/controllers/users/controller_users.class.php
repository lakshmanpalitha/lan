<?php

header('Access-Control-Allow-Origin: *');

class users extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function jsonLogin() {
        $valid = true;
        $user = array();
        $login_model = $this->loadModel('users');
        if (!$login_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$login_password = $this->read->get("password", "POST", '', '', true))
            $valid = false;
        if ($valid) {
            $res = $login_model->login($login_email, $login_password);
            if ($res) {
                $user['login'] = session::get('user_logged_in');
                $user['email'] = session::get('user_email');
                $user['type'] = session::get('user_type');
                $data = array('success' => true, 'data' => $user, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_FIELD_NOT_VALID_TYPE);
        }
        echo json_encode($data);
    }

    function jsonCheckAccess() {
        if (session::get('user_logged_in') === true) {
            $data = array('success' => true);
        } else {
            $data = array('success' => false);
        }
    }

    function register() {
        
    }

}

?>