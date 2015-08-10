<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	public function __construct() {	
            parent::__construct();
            
	}

	/**
	 *  Login Check function
	 */
	public function chk_login(){
		$user_id = $this->nsession->userdata('admin_id');
		if( $user_id == '' || $user_id < 0 )
		{
			redirect(BACKEND_URL);
			return false;
		}
		return true;
	}
	
	
	public function chk_not_login(){
		$user_id = $this->nsession->userdata('admin_id');
		if( $user_id && $user_id != '' )
		{
			redirect(BACKEND_URL."dashboard/");
			return false;
		}
		return true;
	}
		

	
}