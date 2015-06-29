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
        $login_model = $this->loadModel('products');

        if (!$productName = $this->read->get("product_name", "POST", 'NUMERIC', 100, true))
            $valid = false;
        if (!$productCategory = $this->read->get("product_category", "POST", 'NUMERIC', 20, true))
            $valid = false;
        if (!$productDesc = $this->read->get("product_description", "POST", '', 1500, true))
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
            if (!$productMaxBidHour = $this->read->get("product_max_hour", "POST", 'INT', 20, true))
                $valid = false;
            if (!$productMaxBidMin = $this->read->get("product_max_min", "POST", 'INT', 2, true))
                $valid = false;
            if (!$productMaxBidSec = $this->read->get("product_max_sec", "POST", 'INT', 2, true))
                $valid = false;
            if ($valid)
                $proMaxCount = ($productMaxBidHour * 60 * 60) + ($productMaxBidMin * 60) + $productMaxBidSec;
        }

        if ($valid) {
            $res = $login_model->addNewProduct($productName, $productCategory, $productDesc, $productVedioLink, $productMktPrice, $productBidType, $proMaxCount);
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

}

?>