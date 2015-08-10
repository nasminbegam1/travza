<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);


define('DOMAIN',		    'http://localhost/');


define('SITE_NAME',                 'travza');
define('FRONTEND_URL',              DOMAIN.SITE_NAME.'/');
define('BACKEND_URL',               DOMAIN.SITE_NAME.'/admin/');
define('DOCUMENT_ROOT',             '/var/www/html/'.SITE_NAME.'/');
define("SERVER_ABSOLUTE_PATH",      '/var/www/html/'.SITE_NAME.'/');
define('FILE_UPLOAD_ABSOLUTE_PATH', '/var/www/html/'.SITE_NAME.'/upload/');
//define('FRONTEND_URL',              	'http://192.168.2.5/traveldotz/');


//define('FILE_UPLOAD_URL',           CDN_URL.'/traveldotz/upload/');
//
//define('CDN_BANNER_IMG',            FILE_UPLOAD_URL.'banner/');
//define('CDN_BANNER_THUMB_IMG',      FILE_UPLOAD_URL.'banner/thumb/');

//define('CDN_TEAM_IMG',              FILE_UPLOAD_URL.'team/');
//define('CDN_TEAM_THUMB_IMG',        FILE_UPLOAD_URL.'team/thumb/');



define('IMAGE_UPLOAD_URL',          DOMAIN.SITE_NAME.'/upload/');

define('FRONT_JS_PATH',             DOMAIN.SITE_NAME.'/js/');
define('BACKEND_CSS_PATH',          DOMAIN.SITE_NAME.'/admin/css/');
define('BACKEND_JS_PATH',           DOMAIN.SITE_NAME.'/admin/js/');
define('BACKEND_IMAGE_PATH',        DOMAIN.SITE_NAME.'/admin/images/');
define('FRONT_IMAGE_PATH',          DOMAIN.SITE_NAME.'/images/');
define('DEFAULT_CURRENCY','AUD');


// TABLE NAME

define('TABLE_PREFIX','tr_');

define('ADMINUSER', TABLE_PREFIX.'adminuser');
define('CMS', TABLE_PREFIX.'cms');
define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('BANNER_MASTER', TABLE_PREFIX.'banner_master');
define('FAQ', TABLE_PREFIX.'faq');
define('EMAILTEMPLATE', TABLE_PREFIX.'email_template');
define('SITEUSER', TABLE_PREFIX.'site_user');
define('COUNTRY', TABLE_PREFIX.'country');
define('BUSINESS_MASTER', TABLE_PREFIX.'business_master');
define('BUSINESS_DETAILS', TABLE_PREFIX.'business_details');
define('FLYER_MASTER', TABLE_PREFIX.'flyer_master');
define('FLYER_CATEGOTY_MASTER', TABLE_PREFIX.'flyer_category_master');
//define('FINE_PRINT_MASTER', TABLE_PREFIX.'fine_print_master');
define('VENDORDETAILS', TABLE_PREFIX.'vendor_details');
define('DEAL_MASTER', TABLE_PREFIX.'deal_master');
//define('DEAL_CATEGORY', TABLE_PREFIX.'deal_category');
define('DISCOUNT_TYPE', TABLE_PREFIX.'discount_type');
define('CATEGORY_MASTER', TABLE_PREFIX.'category_master');
//define('HOME_USER', TABLE_PREFIX.'home_user');
define('BUCKET_LIST', TABLE_PREFIX.'bucket_list');
define('EVENT_USER', TABLE_PREFIX.'home_event_user');
define('LOCATION_USER', TABLE_PREFIX.'home_location_user');
define('RESTAURANT_USER', TABLE_PREFIX.'home_restaurant_user');
define('TRAVEL_USER', TABLE_PREFIX.'home_travel_user');
define('REVIEW', TABLE_PREFIX.'review');
define('PROMOCODE', TABLE_PREFIX.'promocode');
define('PROMOCODE_USER', TABLE_PREFIX.'promocode_uses');
define('HOLIDAY_MASTER', TABLE_PREFIX.'holiday_master');
define('FLYER_OFFER', TABLE_PREFIX.'plan');


//define("CLIENT_ID",                 "137459539500-mga9doqf1t7eadblt0j0i5tgv3d7aog4.apps.googleusercontent.com");
//define("EMAIL",                     "137459539500-mga9doqf1t7eadblt0j0i5tgv3d7aog4@developer.gserviceaccount.com");
//define("ACCOUNT_ID"          ,       "ga:99029709");
//define("P12_FILE_PATH"      ,        SERVER_ABSOLUTE_PATH."admin/analytics-af4681e94483.p12");

// ******************** ANALYTICS DATA ***********



/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
