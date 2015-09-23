<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
//ini_set("display_errors", -1);
date_default_timezone_set("Asia/Calcutta");

/**
 * Configuration for: Base URL
 */
define('BACKEND', 'admin/');
define('FRONTEND', 'front/');

define('URL', 'http://localhost/lansuwa/');
define('FILE_URL', '//localhost/lansuwa/');
define('DOC_PATH', 'D:/xampp/htdocs/lansuwa/');

/*live*
 * 
 */

//define('URL', '//microsola.com/preview/lansuwa/');
//define('FILE_URL', '//microsola.com/preview/lansuwa/');
//define('DOC_PATH', '/home2/microsq0/public_html/preview/lansuwa/');

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('COMMON_PATH', 'libs/');
define('CONTROLLER_PATH', 'application/controllers/');
define('MODELS_PATH', 'application/models/');
define('VIEWS_PATH', 'application/views/');



/**
 * Configuration for: Cookies 
 */
define('COOKIE_RUNTIME', 1209600);
define('COOKIE_DOMAIN', '.localhost');

/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'db_lansuwa');
define('DB_USER', 'root');
define('DB_PASS', '');

/*live*/

//define('DB_TYPE', 'mysql');
//define('DB_HOST', 'localhost');
//define('DB_NAME', 'microsq0_lansuwa');
//define('DB_USER', 'microsq0_preview');
//define('DB_PASS', 'lanka1234');



/**
 * Configuration for: Email server credentials
 */
define("PHPMAILER_DEBUG_MODE", 0);
// use SMTP or basic mail() ? SMTP is strongly recommended
define("EMAIL_USE_SMTP", false);
// name of your host
define("EMAIL_SMTP_HOST", 'yourhost');
// leave this true until your SMTP can be used without login
define("EMAIL_SMTP_AUTH", true);
// SMTP provider username
define("EMAIL_SMTP_USERNAME", 'yourusername');
// SMTP provider password
define("EMAIL_SMTP_PASSWORD", 'yourpassword');
// SMTP provider port
define("EMAIL_SMTP_PORT", 465);
// SMTP encryption, usually SMTP providers use "tls" or "ssl", for details see the PHPMailer manual
define("EMAIL_SMTP_ENCRYPTION", 'ssl');


/* image upload setting */
define("MAX_UPLOAD_SIZE", 5000 * 1024);
/* Category icon */
define("CAT_THUMB_WIDTH", 100);
define("CAT_THUMB_HEIGHT", 70);
define("CAT_MEDIUM_WIDTH", 300);
define("CAT_MEDIUM_HEIGHT", 180);
define("CAT_ORIGINAL_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/large/");
define("CAT_THUMB_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/thumb/");
define("CAT_MEDIUM_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/medium/");
define("CAT_ALLOW_THUMB", true);
define("CAT_ALLOW_MEDIUM", true);



/* product image */
define("PRO_THUMB_WIDTH", 100);
define("PRO_THUMB_HEIGHT", 70);
define("PRO_MEDIUM_WIDTH", 300);
define("PRO_MEDIUM_HEIGHT", 180);
define("PRO_ORIGINAL_UPLOAD_PATH", DOC_PATH . "public/uploads/product/large/");
define("PRO_THUMB_UPLOAD_PATH", DOC_PATH . "public/uploads/product/thumb/");
define("PRO_MEDIUM_UPLOAD_PATH", DOC_PATH . "public/uploads/product/medium/");
define("PRO_ALLOW_THUMB", true);
define("PRO_ALLOW_MEDIUM", true);

define("DEFAULT_ALLOW_BID_PER_PRODUCT", 50);
define("DEFAULT_TOTAL_ALLOW_BID", 100);
define("DEFAULT_BID_INTERVAL",  60);


/*Profile image setting*/

define("PROFILE_ORIGINAL_UPLOAD_PATH", DOC_PATH . "public/uploads/user/large/");
define("PROFILE_THUMB_UPLOAD_PATH", DOC_PATH . "public/uploads/user/thumb/");
define("PROFILE_MEDIUM_UPLOAD_PATH", DOC_PATH . "public/uploads/user/medium/");

define('REQUEST_SUBMIT_EMAIL', 'lakmalwimaladasa@gmail.com');

/*
 * include error description file
 */
include('error.php');
?>