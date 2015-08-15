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
	$this->obj->load->model("model_user");
     }

   
     public function get_topbar()
     {
	  $this->topbar = '';
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
     
     public function get_leftmenu()
     {
	  $this->leftmenu = '';
	  $user_detail 	= $this->obj->nsession->userdata("user_detail");
	  $role_id	= $user_detail['role_id'];
	  $this->leftmenu['role']  = $this->obj->model_user->get_role($role_id);
	  $this->obj->elements['leftmenu']	='layout/leftmenu';
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