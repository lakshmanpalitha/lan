<?php

class bidsModel extends model {

    function getBidsList($product_id = null) {
        $where = '';
        if ($product_id) {
            $where = "WHERE bid.product_id='" . ($product_id) . "'";
        }
        $query = "
            SELECT 
                bid.bid_id,
                bid.product_id,
                (SELECT pro.product_name FROM tbl_product pro WHERE pro.product_id=bid.product_id) product_name,
                bid.user_id,
                (SELECT user.user_email FROM tbl_reg_users user WHERE user.user_id=bid.user_id) user_email,
                bid.bid_price,
                bid.bid_time,
                bid.bid_status
            FROM 
                tbl_bid bid
            " . ($where ? $where : '') . "
            ORDER BY
                bid.bid_id DESC";

        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSingleBid($bid_id = null) {
        if ($bid_id) {
            $query = "
            SELECT 
                bid.bid_id,
                bid.product_id,
                (SELECT pro.product_name FROM tbl_product pro WHERE pro.product_id=bid.product_id) product_name,
                bid.user_id,
                (SELECT user.user_email FROM tbl_reg_users user WHERE user.user_id=bid.user_id) user_email,
                bid.bid_price,
                bid.bid_time,
                bid.bid_status
            FROM 
                tbl_bid bid.
            WHERE bid.bid_id='" . $bid_id . "'";

            $result = $this->db->queryUniqueObject($query);
            return ($result ? $result : false);
        }
        return false;
    }

}

?>