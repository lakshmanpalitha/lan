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

    function updateProfile($info = array()) {
        if (!empty($info)) {
            $query = "UPDATE 
                tbl_reg_users 
            SET
                user_f_name='" . mysql_real_escape_string($info[1]) . "',
                user_l_name='" . mysql_real_escape_string($info[2]) . "',
                user_email='" . mysql_real_escape_string($info[3]) . "',
                user_address='" . mysql_real_escape_string($info[6]) . "',
                user_mobile_number='" . mysql_real_escape_string($info[5]) . "',
                user_land_number='" . mysql_real_escape_string($info[4]) . "',
                user_nic_no='" . mysql_real_escape_string($info[7]) . "'
            WHERE
                user_id='" . $info[0] . "'";

            $result = $this->db->execute($query);
            if ($result) {
                $imageArray = $info[7];
                if (!empty($imageArray)) {
                    $imageArray['filename'] = $newImageName;
                    $imageArray['tempname'] = $temp_name;
                    $imageArray['size'] = $size;
                    $imageArray['maximagesize'] = MAX_UPLOAD_SIZE;
                    $imageArray['thumbwidth'] = CAT_THUMB_WIDTH;
                    $imageArray['thumbheight'] = CAT_THUMB_HEIGHT;
                    $imageArray['mediumwidth'] = CAT_MEDIUM_WIDTH;
                    $imageArray['mediumheight'] = CAT_MEDIUM_HEIGHT;
                    $imageArray['largeimguploadpath'] = PROFILE_ORIGINAL_UPLOAD_PATH;
                    $imageArray['thumbimaguploadpath'] = PROFILE_THUMB_UPLOAD_PATH;
                    $imageArray['mediumimageuploadpath'] = PROFILE_MEDIUM_UPLOAD_PATH;
                    $imageArray['isallowthumb'] = CAT_ALLOW_THUMB;
                    $imageArray['isallowmedium'] = CAT_ALLOW_MEDIUM;
                    $this->setImage($imageArray);
                    $res = $this->imageUpload();
                    if (!$res) {
                        $isUploadImg = false;
                        session::setError("feedback_negative",FEEDBACK_IMG_UPLOAD_FAIL);
                    }
                }
            }
            return ($result ? $result : false);
        }
        return false;
    }

    function updatePassword($pwd = array()) {
        if (!empty($pwd)) {
            $query = "UPDATE 
                tbl_reg_users 
            SET
                user_pasword='" . mysql_real_escape_string(md5($pwd[0])) . "'
            WHERE
                user_id='" . $pwd[1] . "'";
            $result = $this->db->execute($query);
            return ($result ? $result : false);
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

    function userInfo($user_id = null) {
        if ($user_id) {
            $query = "
            SELECT 
                * 
            FROM 
                tbl_reg_users 
            WHERE 
                user_id='" . mysql_real_escape_string($user_id) . "'";

            $user = $this->db->queryUniqueObject($query);
            return ($user ? $user : false);
        }
        return false;
    }

}

?>