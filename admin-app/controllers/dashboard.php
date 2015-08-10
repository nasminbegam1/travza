<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct(){
        parent:: __construct();
	$this->load->model("model_basic");
	
    }
	
	public function index()
	{
		chk_login();
		//$this->load->view('welcome_message');
		$this->data = '';
		//pr($this->nsession->all_userdata());
		
		$this->data['msg'] = $this->nsession->userdata('msg');
		$this->nsession->set_userdata('msg', '');
		$this->data['record']	= array();
		
		
		  //For breadcrump..........
		
		  $this->data['brdLink'][0]['logo']	=	'fa fa-tachometer fa-fw';
		  $this->data['brdLink'][0]['name']	=	'Dashboard';
		  $this->data['brdLink'][0]['link']	=	'javascript:void(0)';
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='dashboard/dashboard';
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function logout()
	{
		//$this->nsession->sess_destroy();
		
		session_destroy();
		redirect(BACKEND_URL);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */