<?php

class users extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function systemUsers() {
        //auth::handleLogin();
        $login_model = $this->loadModel('users');
        $this->view->systemUsers = $login_model->getSystemUsers();
        $this->view->render('users/system_user_list', true, true, $this->module);
    }

    function onlineUsers() {
        //auth::handleLogin();
        $this->view->render('users/online_user_list', true, true, $this->module);
    }

    function createNewSystemUser() {
        $valid = true;
        $login_model = $this->loadModel('users');
        if (!$user_email = $this->read->get("user_email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$user_password = $this->read->get("user_password", "POST", '', 10, true))
            $valid = false;
        if (!$confirm_user_password = $this->read->get("confirm_user_password", "POST", '', 10, true))
            $valid = false;
        if (!$user_type = $this->read->get("user_type", "POST", 'STRING', 2, true))
            $valid = false;
        if ($user_password != $confirm_user_password) {
            session::setError("feedback_negative", FEEDBACK_PASSWORD_MISSMATCH);
            $valid = false;
        }


        if ($valid) {
            $res = $login_model->addNewSystemUser($user_email, $user_password, $user_type);
            if ($res) {
                $users = $login_model->getSystemUsers();
                $data = array('success' => true, 'data' => $users, 'error' => $this->view->renderFeedbackMessagesForJson());
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function changeSystemUserStatus() {
        $valid = true;
        $login_model = $this->loadModel('users');
        $selectSysUserList = $this->read->get("chk_each", "POST");

        if (!$action = $this->read->get("action", "POST", 'STRING', 1, true))
            $valid = false;

        if (!is_array($selectSysUserList) OR empty($selectSysUserList))
            $valid = false;
        if ($valid) {
            $res = $login_model->changeSystemUserStatus($action, $selectSysUserList);
            if ($res) {
                $shops = $login_model->getSystemUsers();
                $data = array('success' => true, 'data' => $shops, 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>