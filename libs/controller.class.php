<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 * Whenever a controller is created, we also
 * 1. initialize a session
 * 2. check if the user is not logged in anymore (session timeout) but has a cookie
 * 3. create a database connection (that will be passed to all models that need a database connection)
 * 4. create a view object
 */
class controller extends common {

    function __construct($module) {

        //intilize module (backoffice or reservation)
        $this->module = $module;
        session::init();
        // create a view object (that does nothing, but provides the view render() method)
        $this->view = new view($this->module);
        $this->model = new model();
        $this->view->randCat = $this->model->randomCategory();
        $this->read = new read();
        $this->view->isLog = false;
        $this->view->user = null;
        if (session::get('lansuwa_online_user_logged_in') === true) {
            $this->view->isLog = true;
            $this->view->user = session::get('user_f_name');
        }
        $this->email = new PHPMailer();
    }

    /**
     * loads the model with the given name.
     * @param $name string name of the model
     */
    public function loadModel($name, $module = null) {
        $this->module = ($module ? $module : $this->module);
        $path = DOC_PATH . $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
        if (file_exists($path)) {
            require DOC_PATH . $this->module . "/" . MODELS_PATH . "model_" . strtolower($name) . '.class.php';
            // The "Model" has a capital letter as this is the second part of the model class name,
            // all models have names like "LoginModel"
            $modelName = $name . 'Model';
            return new $modelName();
        }
        return false;
    }

    function sendMail($Message, $Subject, $ToEmail) {

        $FromEmail = 'lakmalwimaladasa@yahoo.com';
        $FromName = 'Lansuwa';
        $this->email->From = $FromEmail;
        $this->email->FromName = $FromName;

        $this->email->IsSMTP();

        $this->email->SMTPAuth = true;     // turn of SMTP authentication
        $this->email->Username = "lakmalwimaladasa@yahoo.com";  // SMTP username  (Ex: sumithnets@yahoo.com)
        $this->email->Password = "123456"; // SMTP password  (Ex: yahoo email password)
        $this->email->SMTPSecure = "ssl";

        $this->email->Host = "smtp.mail.yahoo.com";
        $this->email->Port = 465;

        $this->email->SMTPDebug = 2; // Enables SMTP debug information (for testing, remove this line on production mode)
        // 1 = errors and messages
        // 2 = messages only

        $this->email->Sender = $FromEmail; // $bounce_email;
        $this->email->ConfirmReadingTo = $FromEmail;

        $this->email->AddReplyTo($FromEmail);
        $this->email->IsHTML(true); //turn on to send html email
        $this->email->Subject = $Subject;

        $this->email->Body = $Message;
        $this->email->AltBody = "ALTERNATIVE MESSAGE FOR TEXT WEB BROWSER LIKE SQUIRRELMAIL";

        $this->email->AddAddress($ToEmail, $ToEmail);

        if (@$this->email->Send()) {
            @$this->email->ClearAddresses();
            return true;
        } else {
            return false;
        }
        return false;
    }

    function sms($msg, $no) {

        $user = "lakmal";
        $password = "R1okGUCy";
        $api_id = "3397131";
        $baseurl = "http://api.clickatell.com";

        $text = urlencode($msg);
        $to = $no;


        // auth call
        $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $sess = explode(":", $ret[0]);
        if ($sess[0] == "OK") {

            $sess_id = trim($sess[1]); // remove any whitespace
            $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":", $ret[0]);

            if ($send[0] == "ID") {
                session::setError("feedback_positive", "successnmessage ID: " . $send[1]);
                return true;
            } else {
                session::setError("feedback_negative", "Massage sending failed");
                return false;
            }
        } else {
            session::setError("feedback_negative", "Authentication failure: " . $ret[0]);
            return false;
        }
    }

}
