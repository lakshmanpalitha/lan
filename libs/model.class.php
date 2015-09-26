<?php

class model extends common {

    function __construct() {

        // create database connection
        try {
            $this->db = new database();
        } catch (Exception $e) {
            die('Database connection could not be established.');
        }
        $this->read = new read();
        $this->session = new session();
        // $this->email = new PHPMailer();
        $this->arr = array();
    }

    function randomCategory() {
        $get_qry = "
            SELECT 
                pc.category_id,
                pc.category_name
            FROM 
                tbl_product_category pc
            WHERE 
                pc.category_status IN('A') ORDER BY RAND() LIMIT 5";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }


    function primaryKeyGenarator($table = null, $primaryKeyCol = null) {
        if (!$table OR !$primaryKeyCol)
            return false;
        $query = "SELECT " . $primaryKeyCol . " FROM " . $table . " ORDER BY " . $primaryKeyCol . " DESC";
        $res = $this->db->queryUniqueValue($query);

        if ($res === null) {
            $key = 1;
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            return $key ? $key : false;
        } else if ($res) {
            $key = (int) ($res);
            $key+=1;
            $key = str_pad($key, 5, "0", STR_PAD_LEFT);
            return $key ? $key : false;
        }
        return false;
    }

    function time($seconds) {

        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - $hours * 3600) / 60);
        $s = $seconds - ($hours * 3600 + $mins * 60);

        $mins = ($mins < 10 ? "0" . $mins : "" . $mins);
        $s = ($s < 10 ? "0" . $s : "" . $s);

        $time = ($hours > 0 ? $hours . ":" : "00:") . ($mins > 0 ? $mins : '00') . ":" . $s;
        return $time;
    }

}

?>