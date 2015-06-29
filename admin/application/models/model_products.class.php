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

    function getProductList() {
        $where = null;
        if (session::get('user_type') === 'SH') {
            if (!session::get('user_id'))
                return false;
            $where = "WHERE user_id='" . mysql_real_escape_string(session::get('user_id')) . "'";
        }

        $query = "
            SELECT 
                * 
            FROM 
                tbl_product
             " . ($where ? $where : '') . "";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function addNewProduct($proName, $proCat, $proDesc, $proVedioLink, $proMktPrice, $proBidTyp, $proMaxCount) {
        if (!$proName || !$proCat || !$proDesc || !$proMktPrice || !$proBidTyp || !$proMaxCount)
            return false;
        if (!session::get('user_id'))
            return false;
        if ($proBidTyp === 'C') {
            $maxBidTime = 0;
            $maxBidCount = $proMaxCount;
        } else {
            $maxBidTime = $proMaxCount;
            $maxBidCount = 0;
        }

        $query = "
            INSERT INTO 
                tbl_product
            VALUES
                (
                '',
                '" . mysql_real_escape_string(session::get('user_id')) . "',
                '" . mysql_real_escape_string($proCat) . "',
                '" . mysql_real_escape_string($proName) . "',
                '" . mysql_real_escape_string($proDesc) . "',
                '" . mysql_real_escape_string($proVedioLink) . "',
                '" . mysql_real_escape_string($proMktPrice) . "',
                '',
                '" . date("Y-m-d H:i:s") . "',
                '" . mysql_real_escape_string($proBidTyp) . "',
                '" . mysql_real_escape_string($maxBidTime) . "',
                '" . mysql_real_escape_string($maxBidCount) . "',
                'A',
                ''
                )";
        $result = $this->db->execute($query);
        return ($result ? true : false);
    }

}

?>