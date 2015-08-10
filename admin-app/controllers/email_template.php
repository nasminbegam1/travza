<?php

class Email_template extends CI_Controller{
    
    //var $emailTable 	= 'hw_email_template';
    public function __construct(){
        parent:: __construct();
       
        $this->load->model("model_emailtemplate");
        
    }
    
    public function index()
    {
	chk_login();
        $this->data='';
        $this->data['base_url'] = BACKEND_URL."email_template";
	
	
	        //<!----------------------code----------------------->
		$config['base_url'] 	= BACKEND_URL."email_template/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('EMAIL_SEARCH');
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			$this->data['search_keyword'] = $this->data['params']['search_keyword'];
			$this->data['per_page']	= $this->data['params']['per_page'];
		}
		else 
		{
			$this->data['search_keyword']	= $this->input->get_post('search_keyword',true);
			$this->data['per_page'] 	= $this->input->get_post('per_page',true);	
		}
		 //For breadcrump..........
			
		$this->data['brdLink'][0]['logo']   =   'fa fa-envelope-o';
		$this->data['brdLink'][0]['name']   =   'Email Template';
		$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
		
		$this->data['brdLink'][1]['logo']   =   'fa fa-list';
		$this->data['brdLink'][1]['name']   =   'Template Listing';
		$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
		//........................	
		$start 				= 0;
		$page				= $this->uri->segment(3,0);
		$this->data['emailList']		= $this->model_emailtemplate->getList($config,$start);
		$this->data['startRecord'] 	= $start;
                
              
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'email_template';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_template/0/".$page."/";
		//$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_template/{{ID}}/".$page."/";
		

		$this->pagination->initialize($config);
                $this->data['pagination'] = $this->pagination->create_links();
        
        //<!---------------------code------------------------->
	


        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='email/listing';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function change_status(){
	$template_id = $this->input->post('id');
	$field_name	= 'template_status';
	$alias		= '';
	$condition	= "template_id = '".$template_id."'";
	$rec = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '', $alias, $condition);
	if(is_array($rec) and count($rec)>0){
	    $rec =$rec[0];
	   $status = $rec['template_status'];
	   $new_status ='';
	   if($status=='1'){
	     $new_status = '0';
	   }
	   else if($status=='0'){
	     $new_status = '1';
	   }
	   
	    $updateArr  =  array('template_status' => $new_status);
		     
	    $idArr      = array('template_id' => $template_id);
     
	    $ret   = $this->model_basic->updateIntoTable(EMAILTEMPLATE,$idArr, $updateArr);
	}
    }
    
    function edit_status()
    {
	
		chk_login();
		if($this->uri->segment(3,0)!=''){
			$template_id	= $this->uri->segment(3,0);
		}else if($this->input->post('template_id')!=''){
			$template_id	= $this->input->post('template_id');
		}
		$page_num	= 0;
		
		$this->data['template_id']	= $template_id;
		$this->data['page_num']		= $page_num;
		
		$table_name	= EMAILTEMPLATE;
		$field_name	= 'template_status';
		$alias		= '';
		$condition	= "template_id = '".$template_id."'";
		
		$prev_status = $this->model_basic->getValue_condition(EMAILTEMPLATE, $field_name, $alias, $condition);
		
		if($prev_status == 1)
		{
			$new_status1 = 'Inactive';
			$new_status = '0';
		}
		else
		{
			$new_status = '1';
			
			$new_status1 = 'Active';
		}
		
		$updateArr	=  array(
					'template_status'	=> $new_status
					);
		
		$idArr		= array(
					'template_id' =>  $template_id
					);
				
		$update = $this->model_basic->updateIntoTable(EMAILTEMPLATE ,$idArr, $updateArr);
		
		//$update = $this->model_emailtemplate->updateStatus(EMAILTEMPLATE ,$idArr, $updateArr);
		
		echo  ucwords ( $new_status1);
    }
    
    
    
    public function add_template()
    {
        chk_login();
        $this->data='';
        $this->data['base_url'] = BACKEND_URL."email_template";
	
		$this->data['controller']	= "email_template";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/";
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('template_title', 'Template Title', 'trim|required');
		$this->form_validation->set_rules('responce_email', 'Responce Email', 'trim|required');
		$this->form_validation->set_rules('email_subject', 'Email Subject', 'trim|required');
		$this->form_validation->set_rules('email_content', 'Email Content', 'trim|required');
		
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				$template_title	= addslashes($this->input->post('template_title'));
				$from_email = addslashes($this->input->post('responce_email'));
				$email_content	= addslashes($this->input->post('email_content'));
				$email_subject	= addslashes($this->input->post('email_subject'));
				
				
				$insertArr  =  array(
							'template_name'		=> $template_title,
							'responce_email'   	=> $from_email,
							'email_subject'  	=> $email_subject,
							'email_content'  	=> $email_content,
							
						);
	
					$ret   = $this->model_basic->insertIntoTable(EMAILTEMPLATE,$insertArr);
						if($ret)
						{
							$this->nsession->set_userdata('succmsg', "Email template added successfully.");
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to add. Please try again later.");
						}						
						redirect(BACKEND_URL."email_template/index/");
						return true;
				
				
			}
		}
		
		
	
       //For breadcrump..........
	
	$this->data['brdLink'][0]['logo']   =   'fa fa-envelope-o';
	$this->data['brdLink'][0]['name']   =   'Email Template';
	$this->data['brdLink'][0]['link']   =   BACKEND_URL."email_template/index";
	
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-envelope-o';
	$this->data['brdLink'][1]['name']   =   'Add Email Template';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................

        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='email/email_template';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    
    public function edit_template()
    {
	chk_login();
        $this->data='';
	$this->data['base_url'] = BACKEND_URL."email_template";
	
	$this->data['controller']	= "email_template";
	$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/";
	$template_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
	
		if($this->input->get_post('action') == 'Process')
		{			
				$this->form_validation->set_rules('template_title', 'Template Title', 'trim|required');
				$this->form_validation->set_rules('responce_email', 'Responce Email', 'trim|required');
				$this->form_validation->set_rules('email_subject', 'Email Subject', 'trim|required');
				$this->form_validation->set_rules('email_content', 'Email Content', 'trim|required');
					
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else
			{
				
				$template_title	= addslashes($this->input->post('template_title'));
				$from_email = addslashes($this->input->post('responce_email'));
				$email_content	= addslashes($this->input->post('email_content'));
				$email_subject	= addslashes($this->input->post('email_subject'));
				$template_status = addslashes($this->input->post('template_status'));
				
				$updArr  	=  array(
							'template_name'		=> $template_title,
							'responce_email'   	=> $from_email,
							'email_subject'  	=> $email_subject,
							'email_content'  	=> $email_content,
							'template_status'       => $template_status,
						);
				//pr($updArr);
				$idArr		= array( 'template_id' => $template_id );
				
				
				$ret   = $this->model_basic->updateIntoTable(EMAILTEMPLATE,$idArr, $updArr);
				
					if(isset($ret))
					{
						$this->nsession->set_userdata('succmsg', "Template updated successfully.");
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.hhh");
					}						
					redirect(BACKEND_URL."email_template/index/".$page."/");
					return true;
				
			}
		}		
		
                $row = array();

		$Condition = " template_id = '".$template_id."'";
		$rs = $this->model_basic->getValues_conditions(EMAILTEMPLATE, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_template'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_template/".$page."/");
                        return false;
                }
        
	
	//For breadcrump..........
	
	$this->data['brdLink'][0]['logo']   =   'fa fa-envelope-o';
	$this->data['brdLink'][0]['name']   =   'Email Template';
	$this->data['brdLink'][0]['link']   =   BACKEND_URL."email_template/index";
	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-envelope-o';
	$this->data['brdLink'][1]['name']   =   'Edit Email Template';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................

        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='email/edit_email_template';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
}
?>