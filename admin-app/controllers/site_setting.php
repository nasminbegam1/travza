<?php
class Site_setting extends CI_Controller{  
    
    public function __construct(){
        parent:: __construct();
        $this->load->model('model_sitesettings');
    }
    
    public function index()
    {
        chk_login();
        $this->data='';
        $tabId = $this->uri->segment(3);
        $this->data['tab'] = $tabId;
        //echo $tabId;
      // die();
        $config['base_url'] 	= BACKEND_URL."site_setting/index/".$tabId;
        $config['per_page'] 	= 20;
        $config['uri_segment']	= 4;
        $config['num_links'] 	= 20;
        $this->pagination->setCustomAdminPaginationStyle($config);
        
	
	
        $this->data['search_keyword']	= '';
        $this->data['per_page']	= '';
        $this->data['params']		= $this->nsession->userdata('SITESETTINGS');
        
	//print_r($this->data['params']);
	//die();
        if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
        {	
                $this->data['search_keyword'] 	= $this->data['params']['search_keyword'];
                $this->data['per_page']		= $this->data['params']['per_page'];
        }
        else 
        {
                $this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
                $this->data['per_page'] 	= $this->input->get_post('per_page',true);	
        }
        
        $start 				= 0;
        $page 				= $this->uri->segment(4,0);
        
        $this->data['settingList']	= $this->model_sitesettings->getListEmails($config,$start,$tabId);
        $this->data['startRecord'] 	= $start;
        $this->data['totalRecord'] 	= $config['total_rows'];
        $this->data['per_page'] 	= $config['per_page'];
        $this->data['page']	 	= $page;
        $this->data['controller'] 	= 'site_setting';	
        //$this->data['base_url'] 	= BACKEND_URL."site_new/index/0/1/";				
        $this->data['show_all']      	= BACKEND_URL."site_setting/index/".$tabId;
        $this->data['edit_link']      	= BACKEND_URL."site_setting/edit/{{ID}}/".$page."/".$tabId;
	
	
	
	
        $this->pagination->initialize($config);
        
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
        $this->data['errmsg'] = $this->nsession->userdata('errmsg');			
        $this->nsession->set_userdata('succmsg', "");		
        $this->nsession->set_userdata('errmsg', "");
        
        
        
        
        //$brdArr	= array( "Site setting" => 'javascript:void(0)',  "Listing"=>BACKEND_URL."site_setting/index");
	
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']	=	'fa fa-cogs';
	$this->data['brdLink'][0]['name']	=	'Site Setting';
	$this->data['brdLink'][0]['link']	=	BACKEND_URL.'site_setting/index/';
	
	$this->data['brdLink'][1]['logo']	=	'';
	if($tabId!='')
	    $this->data['brdLink'][1]['name']	=	ucfirst($tabId);
	else
	    $this->data['brdLink'][1]['name']	=	'Emails';
	    
	$this->data['brdLink'][1]['link']	=	'javascript:void(0)';
	
	//........................
	
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='sitesettings/newlist';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    public function edit()
    {
		chk_login();
		$tabId = $this->uri->segment(5);
		$sitesettingsId = $this->uri->segment(3, 0);
		$page 		= $this->uri->segment(4, 0);
		
		$this->data['controller'] = "site_setting";
		//$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page."/";

		
		//$this->data['do_cancel_link']   = BACKEND_URL.$this->data['controller']."/index/".$page."/";
		//$this->data['action'] = "Edit";
		
		if($this->input->get_post('action') == 'Process'){
		    if($tabId == '')
		    {
			$this->form_validation->set_rules('sitesettings_value', 'Sitesettings Value', 'trim|required|valid_email');
		    }
		    else
		    {
			$this->form_validation->set_rules('sitesettings_value', 'Sitesettings Value', 'trim|required');
		    }
			
			if ($this->form_validation->run() == FALSE){
                            $this->nsession->set_userdata('errmsg', "Mandatory fields can not be blank or wrong.");			
                            redirect(BACKEND_URL."site_setting/edit/".$sitesettingsId."/".$page."/".$tabId);
                            return true;
			}
                        else
                        {
                            $this->model_sitesettings->updateOption($sitesettingsId);
                            $this->nsession->set_userdata('succmsg', "Settings Updated successfully.");			
                            redirect(BACKEND_URL."site_setting/index/".$tabId);
                            return true;
                            
                        }
		}		
		
                $row = array();
		$rs = $this->model_sitesettings->getSingle($sitesettingsId);
		$row = $rs[0];
                if($row){
		    
		    //$this->data['setting_info'] = $row;
                    foreach($row as $key => $val)
                    {
                            if(!is_numeric($key))
                            {
                                    $this->data[$key] = $val;
                            }
                    }
                }
		else{
		    $this->nsession->set_userdata('errmsg', "Record does not exist.");
		    redirect(BACKEND_URL.$this->data['controller']."/index/".$tabId."/".$page."/");
		    return false;
		}
		$this->data['base_url'] 	= BACKEND_URL."site_setting/index/".$tabId;
		$this->data['succmsg'] 		= $this->nsession->userdata('succmsg');
		$this->data['errmsg'] 		= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', "");
		$this->nsession->set_userdata('errmsg', "");
		
		$this->data['edit_link']      	= BACKEND_URL."site_setting/edit/".$sitesettingsId."/".$page."/";
		
		//For breadcrump..........
		
		$this->data['brdLink'][0]['logo']   =   'fa fa-cogs';
		$this->data['brdLink'][0]['name']   =   'Site Setting';
		$this->data['brdLink'][0]['link']   =   BACKEND_URL."site_setting/index/";
		
		$this->data['brdLink'][1]['logo']   =   '';
		$this->data['brdLink'][1]['name']   =   'Edit Site Settings';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
		
		//........................
				
		
		
		$this->templatelayout->get_topbar();
		$this->templatelayout->get_leftmenu();
		$this->templatelayout->get_footer();
		$this->elements['middle']='sitesettings/edit';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout');
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
    }
}