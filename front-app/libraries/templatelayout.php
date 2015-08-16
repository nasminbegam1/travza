<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of templatelayout
 */
class templatelayout {
     
     var $obj;
    
     public function __construct(){
        $this->obj =& get_instance();
     }
     
     public  function get_header(){
	  $this->header = '';
	  $videoLinks	=	$this->obj->model_basic->getValues_conditions('tr_video_master', array('video_link'));

	//  $headerLinks	=	$this->obj->model_basic->getValues_conditions('bs_cms', array('cms_id','cms_title','cms_content'), '', 'cms_id in (16)', 'cms_id', 'ASC');
	//  
	//  if($headerLinks){
	//       foreach($headerLinks as $links){
	//		 $header[$links['cms_id']] =	$links;
	//	    }
	//	    $this->header['headerLinks'] = $header;
	//  }
	
	 $sitesettings	=	$this->obj->model_basic->getValues_conditions('tr_sitesettings','*',''," status = 'active'");
	  $settings_value = array();
	  if($sitesettings){
	       foreach($sitesettings as $settings){
			 $settings_value[$settings['sitesettings_name']] =	$settings['sitesettings_value'];
		    }
		    $this->header['settings'] = $settings_value;
	  }
	
	
	  $this->header['videoLinks'] 		= $videoLinks[0];
	  $this->obj->elements['header']	='layout/header';
	  $this->obj->elements_data['header'] 	= $this->header;
     }
       

     public  function get_footer(){
	  $this->footer = '';
	  
	  $sitesettings	=	$this->obj->model_basic->getValues_conditions('tr_sitesettings','*',''," status = 'active'");
	  $settings_value = array();
	  if($sitesettings){
	       foreach($sitesettings as $settings){
			 $settings_value[$settings['sitesettings_name']] =	$settings['sitesettings_value'];
		    }
		    $this->footer['settings'] = $settings_value;
	  }
	  
	  
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }
     
     public  function get_homepage_footer(){
	  $this->footer = '';
	  
	  $sitesettings	=	$this->obj->model_basic->getValues_conditions('tr_sitesettings','*',''," status = 'active'");
	  $this->footer['event_home_list'] = $this->obj->model_home->getEventOfferList(4);
	  $settings_value = array();
	  if($sitesettings){
	       foreach($sitesettings as $settings){
			 $settings_value[$settings['sitesettings_name']] =	$settings['sitesettings_value'];
		    }
		    $this->footer['settings'] = $settings_value;
	  }
	  
	  
	  $this->obj->elements['footer']='layout/homepage_footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }
}
?>