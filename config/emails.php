<?php

//$lansuwa_reg_user = null;
//$lansuwa_reg_user_email = null;
//$lansuwa_reg_user_password = null;

$massage = "<html><body>";
$massage.="Dear " . (isset($lansuwa_reg_user) ? $lansuwa_reg_user : '') . ", </br></br>";
$massage.="<p>Your successfully registerd in lansuwa.Please click the below link to activate your account.</p></br></br>";
$massage.="<p>User name: " . (isset($lansuwa_reg_user_email) ? $lansuwa_reg_user_email : '') . "</p></br>";
$massage.="<p>Activate Link</p></br>";
$massage.="<p><a href='" . URL . FRONTEND . "users/activateAccount/" . (isset($activate_code) ? $activate_code : '') . "'>Click to activate your account</a></p></br></br>";
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


$massage = "<html><body>";
$massage.="Dear user, </br></br>";
$massage.="<p>Please find the reset password herewith.</p></br></br>";
$massage.="<p>New Password: " . (isset($temp_pwd) ? $temp_pwd : '') . "</p></br>";
$massage.="<p>Warm Regards,</p></br>";
$massage.="<b><a href='www.lansuva.lk'>www.lansuva.lk</a></b>";
$massage.="</body></html>";
$lansuwa_reset_user_pwd_email_subject = 'Lansuwa Reset Password';
$lansuwa_reset_user_pwd_email = $massage;


$massage = "<html><body>";
$massage.="Dear Lansuwa, </br></br>";
$massage.="<p>Some one has submit inquery through contact form.</p></br></br>";
$massage.="<p>Name: " . (isset($name) ? $name : '') . "</p></br>";
$massage.="<p>Email: " . (isset($email) ? $email : '') . "</p></br>";
$massage.="<p>Web Site: " . (isset($website) ? $website : '') . "</p></br>";
$massage.="<p>Message: " . (isset($mesaage) ? $mesaage : '') . "</p></br>";
$massage.="<p>Warm Regards,</p></br>";
$massage.="<b><a href='www.lansuva.lk'>www.lansuva.lk</a></b>";
$massage.="</body></html>";
$lansuwa_contact_us_email_subject = 'Request';
$lansuwa_contact_us_email = $massage;
?>