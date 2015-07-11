<?php

class bidModel extends model {

    function bidProduts($product_id = null) {
        $where = null;
        if ($product_id) {
            $where = "AND product_id='" . mysql_real_escape_string($product_id) . "'";
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
                * 
            FROM 
                tbl_product_category
            WHERE 
                category_status IN('A')";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }

}

?>