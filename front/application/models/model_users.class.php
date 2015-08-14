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
        if ($user->user_activated == 'N') {
            $this->session->setError("feedback_negative", FEEDBACK_INVALID_ACTIVATION_NOT_COMPLETE);
            return false;
        }
        if ($user->user_status == 'I') {
            session::setError("feedback_negative", FEEDBACK_FIELD_USER_INACTIVE);
            return false;
        }
        session::set('lansuwa_online_user_logged_in', true);
        session::set('user_email', $user->user_email);
        session::set('user_f_name', $user->user_f_name);
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
        $query = "SELECT user_id FROM tbl_reg_users WHERE user_email='" . $user[1] . "'";
        $user = $this->db->queryUniqueValue($query);
        if (!$user) {
            $primaryKey = $this->primaryKeyGenarator('tbl_reg_users', 'user_id');
            if ($primaryKey) {
                $query = "
            INSERT INTO 
            tbl_reg_users(user_id,user_f_name,user_email,user_pasword,user_reg_date,user_status,user_activated_code)
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($user[0]) . "',
                    '" . mysql_real_escape_string($user[1]) . "',
                        '" . mysql_real_escape_string(md5($user[2])) . "',
                            NOW(),
                       'A',
                       '" . mysql_real_escape_string($user[3]) . "'
            )";
                $result = $this->db->execute($query);
                return ($result ? true : false);
            } else {
                session::setError("feedback_negative", FEEDBACK_REQUEST_FAILED);
            }
        } else {
            session::setError("feedback_negative", FEEDBACK_USER_ALLREDY_REGISTERED);
        }
        return false;
    }

    function activateUser($code) {
        $query = "
            SELECT 
                user_id,
                user_activated
            FROM 
                tbl_reg_users 
            WHERE 
                user_activated_code='" . mysql_real_escape_string($code) . "'";
        $user = $this->db->queryUniqueObject($query);
        if ($user) {
            if ($user->user_activated == 'Y') {
                return true;
            } else {
                $query = "UPDATE 
                                tbl_reg_users 
                          SET
                                user_activated='Y'
                          WHERE
                                user_id='" . $user->user_id . "'";
                $result = $this->db->execute($query);
                if ($result) {
                    return true;
                }
            }
        }
        return false;
    }

    function resetPwd($user_email = null, $temp_pwd) {
        $query = "SELECT user_id FROM tbl_reg_users WHERE user_email='" . $user_email . "'";
        $user = $this->db->queryUniqueValue($query);
        if ($user) {
            $updateQuery = "
            UPDATE 
                tbl_reg_users 
            SET
                user_pasword='" . md5($temp_pwd) . "'
            WHERE
                user_id='" . $user . "'";
            $result = $this->db->execute($updateQuery);
            return ($result ? $result : false);
        }
        return false;
    }

    function updateProfile($info = array()) {
        if (!empty($info)) {
            $imageArray = $info[8];
            $new_img_name = (isset($imageArray['imgname']) ? $info[1] . "_" . $imageArray['imgname'] : '');
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
                if (!empty($imageArray)) {
                    $imageArray['filename'] = $new_img_name;
                    $imageArray['tempname'] = $imageArray['imgtemp'];
                    $imageArray['size'] = $imageArray['imgsize'];
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
                        session::setError("feedback_negative", FEEDBACK_IMG_UPLOAD_FAIL);
                    } else {
                        $query = "UPDATE 
                                        tbl_reg_users 
                                  SET
                                user_profile_image='" . $new_img_name . "'
                                    WHERE
                                user_id='" . $info[0] . "'";
                        $result = $this->db->execute($query);
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

    function signOut() {
        session::clear('lansuwa_online_user_logged_in');
        session::clear('user_email');
        session::clear('user_f_name');
        session::clear('user_type');
        session::clear('user_id');
        return true;
    }

}

?>