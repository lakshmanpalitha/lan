<?php

//$lansuwa_reg_user = null;
//$lansuwa_reg_user_email = null;
//$lansuwa_reg_user_password = null;

$massage = "<html><body>";
$massage.="Dear " . (isset($lansuwa_reg_user) ? $lansuwa_reg_user : '') . ", </br></br>";
$massage.="<p>Your successfully registerd in lansuwa.Please click the below link to activate your account.</p></br></br>";
$massage.="<p>User name: " . (isset($lansuwa_reg_user_email) ? $lansuwa_reg_user_email : '') . "</p></br>";
$massage.="<p>Password: " . (isset($lansuwa_reg_user_password) ? $lansuwa_reg_user_password : '') . "</p></br>";
$massage.="<p>Activate Link</p></br>";
$massage.="<p><a href='" . URL . "backoffice/'>Login to back office</a></p></br></br>";
$massage.="<p>Warm Regards,</p></br>";
$massage.="<b><a href='www.lansuva.lk'>www.lansuva.lk</a></b>";
$massage.="</body></html>";
$lansuwa_reg_user_notification_email_subject = 'Lansuwa Registration';
$lansuwa_reg_user_notification_email = $massage;


//$bid_user = null;
//$bid_product_name = null;
//$bid_product_real_price = 0;
//$bid_price = 0;
$massage = "<html><body>";
$massage.="Dear " . (isset($bid_user) ? $bid_user : '') . ", </br></br>";
$massage.="<p>You have bidded on lansuwa product. here is the details..</p></br></br>";
$massage.="<p>Product Name: " . (isset($bid_product_name) ? $bid_product_name : '') . "</p></br>";
$massage.="<p>Real Price: " . (isset($bid_product_real_price) ? $bid_product_real_price : '') . "</p></br>";
$massage.="<p>Your Bid Price: " . (isset($bid_price) ? $bid_price : '') . "</p></br>";
$massage.="<p>Thank you using lansuwa. if you need any help please contact<a href=''>(help@lansuwa.lk)</a></p></br></br>";
$massage.="<p><a href='www.lansuva.lk'>www.lansuva.lk</a></p></br>";
$massage.="</body></html>";
$lansuwa_bid_notification_email_subject = 'Lansuwa Bid';
$lansuwa_bid_notification = $massage;
?>