<?php

class usersModel extends model {

    function addNewSystemUser($sysUserEmail, $sysUserPassword, $sysUserType) {
        if (!$sysUserEmail OR !$sysUserPassword OR !$sysUserType)
            return false;
        $check_qry = "SELECT user_id FROM tbl_sys_users WHERE user_email='" . mysql_real_escape_string($sysUserEmail) . "'";
        $sysUserId = $this->db->queryUniqueValue($check_qry);
        if ($sysUserId) {
            session::setError("feedback_negative", FEEDBACK_USER_EXIST);
            return false;
        }

        $insert_qry = "
            INSERT INTO 
            tbl_sys_users 
            VALUES(
            '',
                '" . mysql_real_escape_string($sysUserType) . "',
                    'A',
                     '" . mysql_real_escape_string($sysUserEmail) . "',
                         '" . mysql_real_escape_string(md5($sysUserPassword)) . "',
                             '" . date("Y-m-d H:i:s") . "',
                         '')";
        $result = $this->db->execute($insert_qry);
        return ($result ? $result : false);
    }

    function getSystemUsers() {
        $get_qry = "
            SELECT 
                * 
            FROM 
                tbl_sys_users
            WHERE 
                user_sataus NOT IN('D')";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }
       function getRegisterUsers() {
        $get_qry = "
            SELECT 
                * 
            FROM 
                tbl_reg_users
            WHERE 
                user_status NOT IN('D')";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }

    function changeSystemUserStatus($status = 'A', $sysUserIdArray = null) {
        $sysUserArray = array();
        $sysUserArray = $sysUserIdArray;
        if (empty($sysUserArray))
            return false;
        $sysUserIdList = '';
        foreach ($sysUserArray as $sh) {
            $sysUserIdList.="'$sh',";
        }
        $sysUserIdList = rtrim($sysUserIdList, ',');

        $update_qry = "
            UPDATE 
                tbl_sys_users 
            SET 
                user_sataus='" . mysql_real_escape_string($status) . "' 
            WHERE  
                user_id IN ($sysUserIdList)";
        $result = $this->db->execute($update_qry);
        return ($result ? $result : false);
    }

}

?>