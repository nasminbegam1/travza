<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of templatelayout
 */
class templatelayout {
     
     var $obj;
    
     public function __construct()
     {
        $this->obj =& get_instance();
     }

   
     public function get_topbar()
     {
	  $this->topbar = '';
	  
	  $this->topbar['user_first_name'] = '';
	   $this->topbar['user_last_name'] = '';
	  $this->topbar['user_image'] = '';
	  //echo "aaaaa";pr($this->obj->nsession->userdata('admin_id') );
	  $logged_id = $this->obj->nsession->userdata("admin_id");
	  if($logged_id != '')
	  {
	       //$logged_id=$this->nsession->userdata('admin_id');
	       $this->obj->load->model("model_adminuser");
	       $logged_info = $this->obj->model_adminuser->get_single($logged_id);
			
			
	       $this->topbar['user_first_name']=$logged_info[0]['first_name'];
	       $this->topbar['user_last_name']=$logged_info[0]['last_name'];
	       $this->topbar['user_image']=$logged_info[0]['image'];
	       
	  }
	  $this->obj->elements['topbar']='layout/topbar';
	  $this->obj->elements_data['topbar'] = $this->topbar;	  
     }
     
     
     public function get_breadcrump($brdArr = array())
     {
	  $this->breadcrump = '';
	  $this->breadcrump['breadcrump'] = $brdArr;
	  $this->obj->elements['breadcrump']='includes/breadcrump';
	  $this->obj->elements_data['breadcrump'] = $this->breadcrump;
     }
     
     public function get_leftmenu($active = '')
     {
	  $this->leftmenu = '';
	  $this->sidebar['active'] = $active;
	  $this->obj->elements['leftmenu']='layout/leftmenu';
	  $this->obj->elements_data['leftmenu'] = $this->leftmenu;
     }       
 
     
     public  function get_footer()
     {
	  $this->footer = '';
	  $this->obj->elements['footer']='layout/footer';
	  $this->obj->elements_data['footer'] = $this->footer;
     }
     
	
}
?>