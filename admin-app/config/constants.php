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

define('IMAGE_UPLOAD_URL',          DOMAIN.SITE_NAME.'/upload/');

define('FRONT_JS_PATH',             DOMAIN.SITE_NAME.'/js/');
define('BACKEND_CSS_PATH',          DOMAIN.SITE_NAME.'/admin/css/');
define('BACKEND_JS_PATH',           DOMAIN.SITE_NAME.'/admin/js/');
define('BACKEND_IMAGE_PATH',        DOMAIN.SITE_NAME.'/admin/images/');
define('FRONT_IMAGE_PATH',          DOMAIN.SITE_NAME.'/images/');
define('DEFAULT_CURRENCY','AUD');


// TABLE NAME

define('TABLE_PREFIX','tr_');

define('USERMASTER', TABLE_PREFIX.'usermaster');
define('ROLE_MASTER', TABLE_PREFIX.'role_master');
define('CMS', TABLE_PREFIX.'cms');
define('SITESETTINGS', TABLE_PREFIX.'sitesettings');
define('EMAILTEMPLATE', TABLE_PREFIX.'email_template');



/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',					'rb');
define('FOPEN_READ_WRITE',				'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	        'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',				'ab');
define('FOPEN_READ_WRITE_CREATE',			'a+b');
define('FOPEN_WRITE_CREATE_STRICT',			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */