<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = "error/error";

$route['about-us']              = "cms/index/about-us";
$route['contact-us']            = "cms/index/contact-us";
$route['top-billing']           = "cms/index/top-billing";
$route['the-privacy-policy']    = "cms/index/the-privacy-policy";
$route['press']                      = "cms/index/press";
$route['blog']                      = "cms/index/blog";

$route['faq']                   = "cms/faq/faq";
$route['preferred-listing']     = "cms/index/preferred-listing";
$route['travel']                = "home/travel_index/";
$route['event']                 = "home/event_index/";
$route['restaurant']            = "home/restaurants_index/";

/************************16.6.2015**********************************/
$route['jobs']                      = "cms/index/jobs";
$route['investor-relations']        = "cms/index/investor-relations";
$route['leadership-team']           = "cms/index/leadership-team";
$route['partners']                  = "cms/index/partners";
$route['terms-of-use']              = "cms/index/terms-of-use";
/******************************************************************/
$route['friendlist']                        = "register/friendlist/";
$route['friend-bucketlist/(:any)']          = "userbucketlist/index/$1";
$route['userbucketlist/bucket_searchresult']= "userbucketlist/bucket_searchresult";
$route['userbucketlist/add_to_cart']        = "userbucketlist/add_to_cart";
$route['friendBucketlistMapView/(:any)']    = "userbucketlist/frindbucketlistmapview/$1";
//$route['userbucketlist/(:any)']= "userbucketlist/index/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */