<?php

class productsModel extends model {

    function addNewCategory($catName, $catDesc = null, $imamge_name = null, $temp_name = null, $size = 0) {
        if (!$catName)
            return false;
        $check_qry = "SELECT category_id FROM tbl_product_category WHERE category_name='" . mysql_real_escape_string(trim(strtolower($catName))) . "'";
        $categoryId = $this->db->queryUniqueValue($check_qry);
        if ($categoryId) {
            session::setError("feedback_negative", FEEDBACK_CATEGORY_EXIST);
            return false;
        }

        $newImageName = null;
        if ($imamge_name) {
            $boss = explode(".", strtolower($imamge_name));
            $extension = strtolower(end($boss)); #make it lowercase with strtower
            $newImageName = "cat_" . rand(1000, 100000) . "_image." . $extension;
        }

        $insert_qry = "
            INSERT INTO 
            tbl_product_category 
            VALUES(
            '',
                '" . mysql_real_escape_string($catName) . "',
                     '" . mysql_real_escape_string($catDesc) . "',
                         '" . $newImageName . "',
                         'A')";
        $result = $this->db->execute($insert_qry);
        if ($result) {
            $isUploadImg = true;
            if ($imamge_name && $temp_name) {
                $imageArray['filename'] = $newImageName;
                $imageArray['tempname'] = $temp_name;
                $imageArray['size'] = $size;
                $imageArray['maximagesize'] = MAX_UPLOAD_SIZE;
                $imageArray['thumbwidth'] = CAT_THUMB_WIDTH;
                $imageArray['thumbheight'] = CAT_THUMB_HEIGHT;
                $imageArray['mediumwidth'] = CAT_MEDIUM_WIDTH;
                $imageArray['mediumheight'] = CAT_MEDIUM_HEIGHT;
                $imageArray['largeimguploadpath'] = CAT_ORIGINAL_UPLOAD_PATH;
                $imageArray['thumbimaguploadpath'] = CAT_THUMB_UPLOAD_PATH;
                $imageArray['mediumimageuploadpath'] = CAT_MEDIUM_UPLOAD_PATH;
                $imageArray['isallowthumb'] = CAT_ALLOW_THUMB;
                $imageArray['isallowmedium'] = CAT_ALLOW_MEDIUM;
                $this->setImage($imageArray);
                $res = $this->imageUpload();
                if (!$res) {
                    $isUploadImg = false;
                    session::setError("feedback_negative", "Category " . FEEDBACK_IMG_UPLOAD_FAIL);
                }
            }
        }

        return ($isUploadImg ? true : false);
    }

    function getCategoryList() {
        $get_qry = "
            SELECT 
                * 
            FROM 
                tbl_product_category
            WHERE 
                category_status NOT IN('D')";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }

    function changeCategoryStatus($status = 'A', $categoryIdArray = null) {
        $catListArray = array();
        $catListArray = $categoryIdArray;
        if (empty($catListArray))
            return false;
        $catIdList = '';
        foreach ($catListArray as $cat) {
            $catIdList.="'$cat',";
        }
        $catIdList = rtrim($catIdList, ',');

        $update_qry = "
            UPDATE 
                tbl_product_category 
            SET 
                category_status='" . mysql_real_escape_string($status) . "' 
            WHERE  
                category_id IN ($catIdList)";
        $result = $this->db->execute($update_qry);
        return ($result ? $result : false);
    }

    function changeProductStatus($status = 'A', $productArray = null) {
        $pro_Array = array();
        $pro_Array = $productArray;
        if (empty($pro_Array))
            return false;
        $proIdList = '';
        foreach ($pro_Array as $pro) {
            $proIdList.="'$pro',";
        }
        $proIdList = rtrim($proIdList, ',');

        $update_qry = "
            UPDATE 
                tbl_product 
            SET 
                " . ($status == 'D' ? 'product_status' : 'product_bid_status') . "='" . mysql_real_escape_string($status) . "' 
            WHERE  
                product_id IN ($proIdList)";
        $result = $this->db->execute($update_qry);
        $result2 = true;
        if ($result && $status = 'R') {
            $update_qry = "
            UPDATE 
                tbl_product 
            SET 
                product_bid_start_date =NOW() 
            WHERE  
                product_id IN ($proIdList)";
            $result2 = $this->db->execute($update_qry);
        } else {
            $result2 = false;
        }
        return ($result ? $result : false);
    }

    function getProductList($product_id = null) {
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
                pro.product_bid_type,
                pro.product_video_link,
               (SELECT SEC_TO_TIME(pro.product_max_bid_runtime))bit_time,
                pro.product_max_bid_runtime as bid_count,
               (SELECT SEC_TO_TIME(pro.product_bid_interval)) product_bid_interval,               
                pro.product_status,
                pro.product_bid_status,
                pro.product_short_description

            FROM 
                tbl_product pro
            WHERE pro.product_status NOT IN ('D') " . ($where ? $where : '');

        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function addNewProduct($proName, $proCat, $proVedioLink, $proMktPrice, $proBidTyp, $proMaxCount, $proBidInterval, $productShortDesc) {
        if (!$proName || !$proCat || !$proMktPrice || !$proBidTyp || !$proMaxCount || !$proBidInterval)
            return false;
        if (!session::get('user_id'))
            return false;

        $primaryKey = $this->primaryKeyGenarator('tbl_product', 'product_id');
        $query = "
            INSERT INTO 
                tbl_product
            VALUES
                (
                '" . mysql_real_escape_string($primaryKey) . "',             
                '" . mysql_real_escape_string($proCat) . "',
                '" . mysql_real_escape_string($proName) . "',
                 '',   
                '" . mysql_real_escape_string($proVedioLink) . "',
                '" . mysql_real_escape_string($proMktPrice) . "',
                '',
                '" . date("Y-m-d H:i:s") . "',
                '" . mysql_real_escape_string($proBidTyp) . "',
                '" . mysql_real_escape_string($proMaxCount) . "',
                '" . mysql_real_escape_string($proBidInterval) . "',
                'A',
                'P',
                '" . mysql_real_escape_string($productShortDesc) . "'
                )";

        $result = $this->db->execute($query);
        return ($result ? true : false);
    }

    function updateProduct($proName, $proCat, $proVedioLink, $proMktPrice, $proBidTyp, $proMaxCount, $proBidInterval, $product_id, $productShortDesc) {
        if (!$proName || !$proCat || !$proMktPrice || !$proBidTyp || !$proMaxCount || !$proBidInterval || !$product_id)
            return false;
        if (!session::get('user_id'))
            return false;
        $query = "UPDATE tbl_product SET
                        category_id= '" . mysql_real_escape_string($proCat) . "',
                        product_name= '" . mysql_real_escape_string($proName) . "',
                        product_video_link= '" . mysql_real_escape_string($proVedioLink) . "',  
                        product_real_price= '" . mysql_real_escape_string($proMktPrice) . "',  
                        product_bid_type= '" . mysql_real_escape_string($proBidTyp) . "',  
                        product_max_bid_runtime= '" . mysql_real_escape_string($proMaxCount) . "',  
                        product_bid_interval= '" . mysql_real_escape_string($proBidInterval) . "',
                        product_short_description= '" . mysql_real_escape_string($productShortDesc) . "' 
                 WHERE product_id='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->execute($query);
        return ($result ? true : false);
    }

    function addProductImg($product) {
        if (is_array($product)) {
            $imageArray['maximagesize'] = MAX_UPLOAD_SIZE;
            $imageArray['thumbwidth'] = PRO_THUMB_WIDTH;
            $imageArray['thumbheight'] = PRO_THUMB_HEIGHT;
            $imageArray['mediumwidth'] = PRO_MEDIUM_WIDTH;
            $imageArray['mediumheight'] = PRO_MEDIUM_HEIGHT;
            $imageArray['largeimguploadpath'] = PRO_ORIGINAL_UPLOAD_PATH;
            $imageArray['thumbimaguploadpath'] = PRO_THUMB_UPLOAD_PATH;
            $imageArray['mediumimageuploadpath'] = PRO_MEDIUM_UPLOAD_PATH;
            $imageArray['isallowthumb'] = PRO_ALLOW_THUMB;
            $imageArray['isallowmedium'] = PRO_ALLOW_MEDIUM;

            if (is_array($product['img'])) {
                $values = null;
                $final_result = true;
                foreach ($product['img'] as $img) {

                    $newImageName = null;
                    if ($img['imgname']) {
                        $boss = explode(".", strtolower($img['imgname']));
                        $extension = strtolower(end($boss)); #make it lowercase with strtower
                        $newImageName = "pro_" . $product['pro_id'] . "_" . rand(1, 1000) . "_image." . $extension;

                        $imageArray['filename'] = $newImageName;
                        $imageArray['tempname'] = $img['imgtemp'];
                        $imageArray['size'] = $img['imgsize'];

                        $this->setImage($imageArray);
                        $res = $this->imageUpload();
                        if ($res) {
                            $primaryKey = $this->primaryKeyGenarator('tbl_product_images', 'image_id');
                            $values = "(
                        '" . $primaryKey . "',
                            '" . $product['pro_id'] . "',
                             '" . $newImageName . "',
                             'N'
                         )";
                        }
                        $query = "
                            INSERT INTO 
                            tbl_product_images
                                 VALUES " . ($values);
                        $result = $this->db->execute($query);
                        if (!$result)
                            $final_result = false;
                    }
                }
                return $final_result ? true : false;
            }
        }
        return false;
    }

    function getProductImg($product_id) {
        if (!$product_id)
            return false;
        $get_qry = "
            SELECT 
                * 
            FROM 
                tbl_product_images
            WHERE 
                product_id='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->queryMultipleObjects($get_qry);
        return ($result ? $result : false);
    }

    function setDefaultImg($product_id, $img_id) {
        if ($product_id && $img_id) {
            $query = "UPDATE tbl_product_images SET default_image='N' WHERE product_id='" . mysql_real_escape_string($product_id) . "'";
            $result = $this->db->execute($query);
            if ($result) {
                $query = "UPDATE tbl_product_images SET default_image='Y' WHERE image_id='" . mysql_real_escape_string($img_id) . "'";
                $result = $this->db->execute($query);
                return $result ? true : false;
            }
        }
        return false;
    }

    function addProductDesc($product_id, $product_desc) {
        if ($product_id) {
            $query = "UPDATE tbl_product SET product_description='" . mysql_real_escape_string($product_desc) . "' WHERE product_id='" . mysql_real_escape_string($product_id) . "'";
            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

    function getProductDesc($product_id) {
        if (!$product_id)
            return false;
        $get_qry = "
            SELECT 
                product_description
            FROM 
                tbl_product
            WHERE 
                product_id='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->queryUniqueValue($get_qry);
        return ($result ? $result : false);
    }

    function getProductStatus($product_id) {
        if (!$product_id)
            return false;
        $get_qry = "
            SELECT 
                product_status
            FROM 
                tbl_product
            WHERE 
                product_id='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->queryUniqueValue($get_qry);
        return ($result ? $result : false);
    }

    function getProductBidStatus($product_id) {
        if (!$product_id)
            return false;
        $get_qry = "
            SELECT 
                product_bid_status
            FROM 
                tbl_product
            WHERE 
                product_id='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->queryUniqueValue($get_qry);
        return ($result ? $result : false);
    }

}

?>