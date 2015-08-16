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

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('DOMAIN',		    'http://192.168.2.5/');

define('BASIC_SUBSCRIPTION_PRICE',		    25);
define('PREMIUM_SUBSCRIPTION_PRICE',		    50);
define('BUSINESS_SUBSCRIPTION_PRICE',		    150);

define('SITE_NAME',                 'traveldotz');
define('FILE_PATH', 		        '/var/www/html/traveldotz/doc/');
define('FRONTEND_URL',              	'http://192.168.2.5/traveldotz/');
define('FILE_UPLOAD_ABSOLUTE_PATH',     '/var/www/html/traveldotz/upload/');
define('FILE_UPLOAD_URL',               'http://192.168.2.5/traveldotz/upload/');
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('IMAGE_UPLOAD_URL',          DOMAIN.SITE_NAME.'/upload/');

define('TABLE_PREFIX','tr_');
define('ADMINUSER', TABLE_PREFIX.'adminuser');
define('BANNERMASTER', TABLE_PREFIX.'banner_master');
define('CMS', TABLE_PREFIX.'cms');
define('COUNTRY', TABLE_PREFIX.'country');
define('STATE', TABLE_PREFIX.'state');
define('EMAILTEMPLATE', TABLE_PREFIX.'email_template');
define('FAQMASTER', TABLE_PREFIX.'faq_master');
define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('SITEUSER', TABLE_PREFIX.'site_user');
define('BUSINESSDETAILS', TABLE_PREFIX.'business_details');
define('BUSINESSMASTER', TABLE_PREFIX.'business_master');
define('PROFESSIONMASTER', TABLE_PREFIX.'profession_master');
define('TRAVELERTYPES', TABLE_PREFIX.'traveler_types');
define('DEAL_MASTER', TABLE_PREFIX.'deal_master');
define('DEAL_CATEGORY', TABLE_PREFIX.'deal_category');
define('FLYER_MASTER', TABLE_PREFIX.'flyer_master');
define('FRIEND', TABLE_PREFIX.'friend');
define('FLYER_CATEGOTY_MASTER', TABLE_PREFIX.'flyer_category_master');
define('CATEGORY_MASTER',TABLE_PREFIX.'category_master');


define('VENDORDETAILS', TABLE_PREFIX.'vendor_details');
define('DISCOUNT_TYPE', TABLE_PREFIX.'discount_type');
define('REVIEW', TABLE_PREFIX.'review');
define('BUCKET_LIST', TABLE_PREFIX.'bucket_list');

define('RESTAURANT_USER', TABLE_PREFIX.'home_restaurant_user');
define('TRAVEL_USER', TABLE_PREFIX.'home_travel_user');
define('EVENT_USER', TABLE_PREFIX.'home_event_user');
define('LOCATION_USER', TABLE_PREFIX.'home_location_user');
define('PAYMENT_INFO', TABLE_PREFIX.'payment_information');
define('PROMOCODE', TABLE_PREFIX.'promocode');
define('PROMOCODE_USERS', TABLE_PREFIX.'promocode_uses');
define('VENDOR_FRANCHISE', TABLE_PREFIX.'vendor_franchise');
define('AGE_RANGE_MASTER', TABLE_PREFIX.'age_range_master');
define('HOLIDAY_MASTER', TABLE_PREFIX.'holiday_master');
define('VENDOR_PAYMENT_INFO', TABLE_PREFIX.'vendor_payment_info');
define('PLAN', TABLE_PREFIX.'plan');

define('sandbox_mode', true);
define('APIUsername', 'pujanitdey-facilitator_api1.gmail.com');
define('APIPassword', '1406877976');
define('APISignature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AV2r6nnXjMhFB6a7oG5MVKGHEtpj');
define('APISubject', '');
define('version', '66.0');
define('SandboxAPIUsername', 'pujanitdey-facilitator_api1.gmail.com');
define('SandboxAPIPassword', '1406877976');
define('SandboxAPISignature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AV2r6nnXjMhFB6a7oG5MVKGHEtpj');
define('SandboxAPISubject', '');

define('AUTHNET_LOGIN', '5J5h6bG7');
define('AUTHNET_TRANSKEY', '673EarC8j7L786xd');

/* End of file constants.php */
/* Location: ./application/config/constants.php */