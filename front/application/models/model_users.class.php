<?php

class usersModel extends model {

    function login($email = null, $pass = null) {
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
        if ($user->user_status === 'I') {
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

    function register($user) {
        $primaryKey = $this->primaryKeyGenarator('tbl_reg_users', 'user_id');
        if ($primaryKey) {
            $query = "
            INSERT INTO 
            tbl_reg_users(user_id,user_f_name,user_email,user_pasword,user_reg_date,user_status)
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($user[0]) . "',
                    '" . mysql_real_escape_string($user[1]) . "',
                        '" . mysql_real_escape_string(md5($user[2])) . "',
                            NOW(),
                       'A'
            )";
            $result = $this->db->execute($query);
            return ($result ? true : false);
        }
        return false;
    }

    function userBidSetting($user_id = null) {
        $user = (session::get('user_id')) ? session::get('user_id') : false;
        if ($user_id && $user) {
            $query = "
            SELECT 
                user_allow_bid_per_product,
                user_allow_tot_bid,
                TIME_TO_SEC(TIMEDIFF(NOW(),user_last_bid_time)) AS user_bid_interval
            FROM 
                tbl_reg_users 
            WHERE 
                user_id='" . $user . "' 
                AND user_status IN('A')";
            $result = $this->db->queryUniqueObject($query);
            return ($result ? $result : false);
        }
        return false;
    }

}

?>