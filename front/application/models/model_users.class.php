<?php

class usersModel extends model {

    function log($email = null, $pass = null) {
        if (!$email || !$pass)
            return false;

        $query = "
            SELECT 
                * 
            FROM 
                tbl_reg_users 
            WHERE 
                user_email='" . mysql_real_escape_string($email) . "' 
                AND user_pasword='" . md5($pass) . "'
                AND user_status NOT IN('D')";

        $user = $this->db->queryUniqueObject($query);
        if (empty($user)) {
            session::setError("feedback_negative", FEEDBACK_FIELD_NOT_VALID);
            return false;
        }
        if ($user->user_sataus === 'I') {
            session::setError("feedback_negative", FEEDBACK_FIELD_USER_INACTIVE);
            return false;
        }
        session::set('user_logged_in', true);
        session::set('user_email', $user->user_email);
        session::set('user_type', $user->user_account_type);
        session::set('user_id', $user->user_id);

        $updateQuery = "
            UPDATE 
                tbl_reg_users 
            SET
                user_last_log='" . date("Y-m-d H:i:s") . "'
            WHERE
                user_id='" . $user->user_id . "'";
        $result = $this->db->execute($updateQuery);
        return true;
    }

}

?>