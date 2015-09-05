<?php

class bidModel extends model {

    function bidProduts($product_id = null, $category = null, $key = null, $check_bid_status = true) {
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
                (SELECT COUNT(bid.user_id)
FROM(
SELECT DISTINCT user_id
FROM tbl_bid
WHERE product_id=product_id
)bid) AS count_users,
                (SELECT COUNT(product_id) FROM tbl_bid WHERE product_id=pro.product_id) AS bid_count,
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
                  " . ($check_bid_status ? "AND pro.product_bid_status IN ('R')" : "") . "
                  " . ($where ? $where : '')." ORDER BY pro.product_create_date";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function topProducts() {
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
               (SELECT COUNT(product_id) FROM tbl_product WHERE category_id=pc.category_id AND product_status NOT IN ('D') AND product_bid_status IN ('R')  ) AS pro_count
            FROM 
                tbl_product_category pc
            WHERE 
                pc.category_status IN('A') AND (SELECT COUNT(product_id) FROM tbl_product WHERE category_id=pc.category_id AND product_status NOT IN ('D') AND product_bid_status IN ('R')  ) > 0";
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
                pro.product_bid_status AS bid_status,
                (SELECT COUNT(bid.user_id)
FROM(
SELECT DISTINCT user_id
FROM tbl_bid
WHERE product_id=product_id
)bid) AS count_users
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

    function topBidsProducts() {
        $query = "
           SELECT 
                  b.product_id AS pro_id,
                  (SELECT product_name FROM tbl_product WHERE product_id=b.product_id) AS pro_name,
                  (SELECT image_name FROM tbl_product_images WHERE product_id=b.product_id AND default_image='Y') AS pro_img,
                  (SELECT product_real_price FROM tbl_product WHERE product_id=b.product_id) as pro_price                  
                  FROM 
                  tbl_bid b
                         WHERE 
                         b.product_id IN (SELECT product_id FROM tbl_product WHERE product_bid_status='R' AND product_status='A')
                                        GROUP BY b.product_id 
                                        ORDER BY COUNT(b.product_id) 
                                        DESC LIMIT 5";
        $result = $this->db->queryMultipleObjects($query);
        if (empty($result)) {
            $query = "
           SELECT 
                   p.product_id AS pro_id,
                   p.product_name AS pro_name,
                  (SELECT image_name FROM tbl_product_images WHERE product_id=p.product_id AND default_image='Y') AS pro_img,
                   p.product_real_price as pro_price                  
                  FROM 
                  tbl_product p
                  WHERE product_bid_status='R' AND product_status='A' 
									ORDER BY product_real_price ASC
                  LIMIT 5";
            $result = $this->db->queryMultipleObjects($query);
        }
        return ($result ? $result : false);
    }

}

?>