<?php

class bidModel extends model {

    function bidProduts($product_id = null, $category = null, $key = null) {
        $where = null;
        if ($product_id) {
            $where = "AND pro.product_id='" . mysql_real_escape_string($product_id) . "'";
        }
        if ($category) {
            $where.= "AND pro.category_id='" . mysql_real_escape_string($category) . "'";
        }
        if ($key) {
            $where.= "AND pro.product_name LIKE '%" . mysql_real_escape_string($key) . "%'";
        }

        $query = "
            SELECT 
                pro.product_id,
                pro.category_id,
                (SELECT cat.category_name FROM tbl_product_category cat WHERE cat.category_id=pro.category_id) cat_name,
                pro.product_name,
                pro.product_real_price,
                pro.product_bid_start_date,
                pro.product_create_date,
                pro.product_video_link,
                pro.product_short_description,
                pro.product_bid_type,
                pro.product_description,
                (select 
                    GROUP_CONCAT(pimg.image_name SEPARATOR ', ')
                 FROM 
                    tbl_product_images pimg 
                 WHERE 
                    pimg.product_id=pro.product_id ) as images,
                (select 
                    pimg2.image_name
                FROM 
                    tbl_product_images pimg2 
                WHERE 
                    pimg2.product_id=pro.product_id 
                    AND pimg2.default_image='Y' ) as def_image
                        FROM 
                tbl_product pro
            WHERE pro.product_status NOT IN ('D')
                  AND pro.product_bid_status IN ('R')
                  " . ($where ? $where : '');

        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function activeCategory() {
        $get_qry = "
            SELECT 
                pc.category_id,
                pc.category_name,
               (SELECT COUNT(product_id) FROM tbl_product WHERE category_id=pc.category_id) AS pro_count
            FROM 
                tbl_product_category pc
            WHERE 
                pc.category_status IN('A')";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }

    function checkProductBidTime($product_id = null) {
        $where = '';
        if ($product_id) {
            $where = "pro.product_id='" . mysql_real_escape_string($product_id) . "' AND";
        }
        $query = "
            SELECT 
                pro.product_id AS pro_id,
                TIME_TO_SEC(TIMEDIFF(NOW(),pro.product_bid_start_date)) AS bid_time_def,
                pro.product_bid_type AS  bid_type,
                pro.product_max_bid_runtime AS bid_allow_time,
                (SELECT COUNT(product_id) FROM tbl_bid WHERE product_id=pro.product_id) AS bid_count,
                pro.product_bid_status AS bid_status
            FROM 
                tbl_product pro
            WHERE 
                " . ($where ? $where : '') . "
                pro.product_status='A'
                AND pro.product_bid_status='R'";

        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function addBid($bid) {
        if (!empty($bid)) {
            $result2 = false;
            $primaryKey = $this->primaryKeyGenarator('tbl_bid', 'bid_id');
            if ($primaryKey) {
                $query = "
            INSERT INTO 
            tbl_bid(bid_id,product_id,user_id,bid_price,bid_time,bid_status)
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($bid[1]) . "',
                    '" . mysql_real_escape_string(session::get('user_id')) . "',
                        '" . mysql_real_escape_string($bid[0]) . "',
                            NOW(),
                       'A'
            )";
                $result = $this->db->execute($query);
                if ($result) {
                    $query2 = "UPDATE tbl_reg_users SET user_last_bid_time=NOW() WHERE user_id='" . session::get('user_id') . "'";
                    $result2 = $this->db->execute($query2);
                }
                return ($result2 ? true : false);
            }
            return false;
        }
    }

    function userPerProducBid($product_id = null, $user_id = null) {
        if ($product_id && $user_id) {
            $qry = "
            SELECT 
                COUNT(bid_id)              
            FROM 
                tbl_bid 
            WHERE 
                product_id='" . $product_id . "'
                AND user_id='" . $user_id . "'
                AND bid_status='A'";
            $result = $this->db->queryUniqueValue($qry);
            return ($result ? $result : false);
        }
        return false;
    }

    function userTotBid($user_id = null) {
        if ($user_id) {
            $qry = "
            SELECT 
                COUNT(bid_id)           
            FROM 
                tbl_bid 
            WHERE 
                user_id='" . $user_id . "'
                AND bid_status='A'";
            $result = $this->db->queryUniqueValue($qry);
            return ($result ? $result : false);
        }
        return false;
    }

    function productInterval($product_id = null) {
        if ($product_id) {
            $qry = "
            SELECT 
                product_bid_interval              
            FROM 
                tbl_product 
            WHERE 
                product_id='" . $product_id . "'
                AND product_status='A'
                AND product_bid_status='R'";
            $result = $this->db->queryUniqueValue($qry);
            return ($result ? $result : false);
        }
        return false;
    }

    function calTime($sec) {
        return $this->time($sec);
    }

    function userBidSummary($user_id = null) {
        if ($user_id) {
            $qry = "
            SELECT 
                bid.product_id, 
                COUNT(bid.bid_id) AS count,
                (SELECT pro.product_name FROM tbl_product pro WHERE pro.product_id=bid.product_id) AS produc_name,              
                (SELECT img.image_name FROM tbl_product_images img WHERE img.product_id=bid.product_id AND img.default_image='Y') AS product_img  
            FROM 
                tbl_bid bid 
            WHERE 
                bid.user_id='" . $user_id . "'
                AND bid.bid_status='A'
            GROUP BY bid.product_id";
            $result = $this->db->queryMultipleObjects($qry);
            return ($result ? $result : false);
        }
        return false;
    }
}

?>