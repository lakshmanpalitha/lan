<?php

class products extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    function index() {
        $login_model = $this->loadModel('products');
        $this->view->category = $login_model->getCategoryList();
        $this->view->products = $login_model->getProductList();
        $this->view->render('products/products', true, true, $this->module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function category() {
        //auth::handleLogin();
        $login_model = $this->loadModel('products');
        $this->view->category = $login_model->getCategoryList();
        $this->view->render('products/category', true, true, $this->module);
    }

    function createNewCategory() {
        $valid = true;
        $login_model = $this->loadModel('products');
        if (!$category_name = $this->read->get("category_name", "POST", 'NUMERIC', 100, true))
            $valid = false;
        if (!$category_desc = $this->read->get("category_description", "POST", '', 1500, true))
            $valid = false;

        $imageName = (isset($_FILES['image']) ? $_FILES['image']['name'] : null);
        $imageTemp = (isset($_FILES['image']) ? $_FILES['image']['tmp_name'] : null);
        $imageSize = (isset($_FILES['image']) ? filesize($_FILES['image']['tmp_name']) : 0);

        if ($valid) {
            $res = $login_model->addNewCategory($category_name, $category_desc, $imageName, $imageTemp, $imageSize);
            $category = $login_model->getCategoryList();
            if ($res) {
                $data = array('success' => true, 'data' => $category, 'error' => $this->view->renderFeedbackMessagesForJson());
            } else {
                $data = array('success' => false, 'data' => $category, 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function changeCategoryState() {
        $valid = true;
        $login_model = $this->loadModel('products');
        $selectCatList = $this->read->get("chk_each", "POST");

        if (!$action = $this->read->get("action", "POST", 'STRING', 1, true))
            $valid = false;

        if (!is_array($selectCatList) OR empty($selectCatList))
            $valid = false;
        if ($valid) {
            $res = $login_model->changeCategoryStatus($action, $selectCatList);
            if ($res) {
                $category = $login_model->getCategoryList();
                $data = array('success' => true, 'data' => $category, 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function createNewProduct() {
        $valid = true;
        $res = '';
        $login_model = $this->loadModel('products');

        if (!$product_action = $this->read->get("pro_action", "POST", 'STRING', 6, true))
            $valid = false;
        if ($product_action == 'new' OR $product_action = 'modify') {
            if ($product_action == 'modify') {
                if (!$product_id = $this->read->get("pro_id", "POST", 'INT', 11, true))
                    $valid = false;
            }
        }else {
            $valid = false;
        }
        if (!$productName = $this->read->get("product_name", "POST", 'NUMERIC', '', true))
            $valid = false;
        if (!$productCategory = $this->read->get("product_category", "POST", 'NUMERIC', 20, true))
            $valid = false;
        if (!$productVedioLink = $this->read->get("product_video_link", "POST", '', 250, false))
            $valid = false;
        if (!$productMktPrice = $this->read->get("product_market_price", "POST", 'DOUBLE', 20, true))
            $valid = false;
        if (!$productBidType = $this->read->get("product_bid_type", "POST", 'STRING', 1, true))
            $valid = false;

        if ($productBidType === 'C') {
            if (!$productMaxBidCount = $this->read->get("product_max_count", "POST", 'INT', 20, true))
                $valid = false;
            if ($valid)
                $proMaxCount = $productMaxBidCount;
        } else if ($productBidType === 'T') {
            if (!$productMaxBidDays = $this->read->get("product_max_days", "POST", 'INT', 20, false))
                $valid = false;
            if (!$productMaxBidHour = $this->read->get("product_max_hour", "POST", 'INT', 20, false))
                $valid = false;
            if (!$productMaxBidMin = $this->read->get("product_max_min", "POST", 'INT', 2, false))
                $valid = false;
            if (!$productMaxBidSec = $this->read->get("product_max_sec", "POST", 'INT', 2, false))
                $valid = false;
            if ($valid) {
                $productMaxBidDays = ($productMaxBidDays === true ? 0 : $productMaxBidDays);
                $productMaxBidHour = ($productMaxBidHour === true ? 0 : $productMaxBidHour);
                $productMaxBidMin = ($productMaxBidMin === true ? 0 : $productMaxBidMin);
                $productMaxBidSec = ($productMaxBidSec === true ? 0 : $productMaxBidSec);
                $proMaxCount = ($productMaxBidDays * 24 * 60 * 60) + ($productMaxBidHour * 60 * 60) + ( $productMaxBidMin * 60) + $productMaxBidSec;
            }
        }
        if (!$productBidIntDays = $this->read->get("product_bid_int_days", "POST", 'INT', 20, false))
            $valid = false;
        if (!$productBidIntHour = $this->read->get("product_bid_int_hour", "POST", 'INT', 20, false))
            $valid = false;
        if (!$productBidIntMin = $this->read->get("product_bid_int_min", "POST", 'INT', 2, false))
            $valid = false;
        if (!$productBidIntSec = $this->read->get("product_bid_int_sec", "POST", 'INT', 2, false))
            $valid = false;
        if ($valid) {
            $productBidIntDays = ($productBidIntDays === true ? 0 : $productBidIntDays);
            $productBidIntHour = ($productBidIntHour === true ? 0 : $productBidIntHour);
            $productBidIntMin = ($productBidIntMin === true ? 0 : $productBidIntMin);
            $productBidIntSec = ($productBidIntSec === true ? 0 : $productBidIntSec);
            $proBidInterval = ($productBidIntDays * 24 * 60 * 60) + ($productBidIntHour * 60 * 60) + ($productBidIntMin * 60) + $productBidIntSec;
        }


        if ($valid) {
            if ($product_action == 'new') {
                $res = $login_model->addNewProduct($productName, $productCategory, $productVedioLink, $productMktPrice, $productBidType, $proMaxCount, $proBidInterval);
            } else if ($product_action == 'modify') {
                $status = $login_model->getProductStatus($product_id);
                $bid_status = $login_model->getProductBidStatus($product_id);
                if ($bid_status == 'P' && $status='A') {
                    $res = $login_model->updateProduct($productName, $productCategory, $productVedioLink, $productMktPrice, $productBidType, $proMaxCount, $proBidInterval, $product_id);
                }
            }
            $products = $login_model->getProductList();
            if ($res) {
                $data = array('success' => true, 'data' => $products, 'error' => $this->view->renderFeedbackMessagesForJson());
            } else {
                $data = array('success' => false, 'data' => $products, 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function changeProductState() {
        $valid = true;
        $login_model = $this->loadModel('products');
        $select_products = $this->read->get("chk_each", "POST");

        if (!$action = $this->read->get("action", "POST", 'STRING', 1, true))
            $valid = false;

        if ($action == 'R' OR $action == 'S' OR $action == 'D') {
            if (!is_array($select_products) OR empty($select_products))
                $valid = false;
            if ($valid) {
                $res = $login_model->changeProductStatus($action, $select_products);
                if ($res) {
                    $products = $login_model->getProductList();
                    $data = array('success' => true, 'data' => $products, 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_REQUEST);
        }
        echo json_encode($data);
    }

    function addProductImg() {
        $valid = true;
        $imgArray = array();
        $product = array();
        $data = '';
        $login_model = $this->loadModel('products');

        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if (!$img_count = $this->read->get("img_count", "POST", 'INT', 1, true))
            $valid = false;
        if ($valid) {
            if ($img_count > 0) {
                for ($i = 0; $i <= $img_count; $i++) {
                    $imageName = (isset($_FILES['image' . $i]) ? $_FILES['image' . $i]['name'] : '');
                    $imageTemp = (isset($_FILES['image' . $i]) ? $_FILES['image' . $i]['tmp_name'] : '');
                    $imageSize = (isset($_FILES['image' . $i]) ? filesize($_FILES['image' . $i]['tmp_name']) : 0);
                    $imgArray[$i]['imgname'] = $imageName;
                    $imgArray[$i]['imgtemp'] = $imageTemp;
                    $imgArray[$i]['imgsize'] = $imageSize;
                }
            }
            $product['pro_id'] = $product_id;
            $product['img'] = $imgArray;
            $res = $login_model->addProductImg($product);
            $product_img = $login_model->getProductImg($product_id);
            if ($res) {
                $data = array('success' => true, 'data' => $product_img, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => $product_img, 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function jsonGetProductImg() {
        $login_model = $this->loadModel('products');
        $product_img = '';
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if ($valid) {
            $product_img = $login_model->getProductImg($product_id);
        }
        $data = array('success' => true, 'data' => $product_img, 'error' => '');
        echo json_encode($data);
    }

    function setDefaultProductImg() {
        $login_model = $this->loadModel('products');
        $product_img = '';
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if (!$img_id = $this->read->get("img_id", "POST", 'INT', 11, true))
            $valid = false;
        if ($valid) {
            $res = $login_model->setDefaultImg($product_id, $img_id);
            $product_img = $login_model->getProductImg($product_id);
            if ($res) {
                $data = array('success' => true, 'data' => $product_img, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        }
        $data = array('success' => true, 'data' => $product_img, 'error' => $this->view->renderFeedbackMessagesForJson());
        echo json_encode($data);
    }

    function addProductDesc() {
        $login_model = $this->loadModel('products');
        $product_desc = '';
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if (!$product_desc = $this->read->get("product_desc", "POST", '', 5000, false))
            $valid = false;
        if ($valid) {
            $res = $login_model->addProductDesc($product_id, $product_desc);
            $product_desc = $login_model->getProductDesc($product_id);
        }
        $data = array('success' => true, 'data' => $product_desc, 'error' => $this->view->renderFeedbackMessagesForJson());
        echo json_encode($data);
    }

    function jsonGetProductDesc() {
        $login_model = $this->loadModel('products');
        $product_desc = '';
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if ($valid) {
            $product_desc = $login_model->getProductDesc($product_id);
        }
        $data = array('success' => true, 'data' => $product_desc, 'error' => '');
        echo json_encode($data);
    }

    function viewEachProduct() {
        $login_model = $this->loadModel('products');
        $product = '';
        $valid = true;
        if (!$product_id = $this->read->get("product_id", "POST", 'INT', 11, true))
            $valid = false;
        if ($valid) {
            $product = $login_model->getProductList($product_id);
        }
        $data = array('success' => true, 'data' => $product, 'error' => '');
        echo json_encode($data);
    }

}

?>