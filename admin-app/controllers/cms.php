<?php
class Cms extends CI_Controller{
    
    var $cmsTable 	= 'hw_cms';
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_cms");
    }
    
    public function index()
    {
        chk_login();
        $this->data='';
        //<!----------------------code----------------------->
        $config['base_url'] 	= BACKEND_URL."cms/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('CMS_SEARCH');
		
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
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'CMS Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
		$start 				= 0;
		$page				= $this->uri->segment(3,0);
		$this->data['cmsList']		= $this->model_cms->getList($config,$start);
		$this->data['startRecord'] 	= $start;
                
               // $this->data['brdLink']='';
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'cms';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_cms/{{ID}}/".$page."/";
		

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
        $this->elements['middle']='cms/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        
    }
    
    function is_name_exists()
    {
		
		$id 		= $this->uri->segment(3, 0);
		$cms_title	= strip_tags(addslashes(trim($this->input->get_post('cms_title'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'cms_title' => $cms_title,
						 'cms_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'cms_title' => $cms_title );
		}
		$bool 	= $this->model_basic->checkRowExists(CMS, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function add_cms()
    {
        chk_login();
        $this->data='';
        //<!----------code------------------------->
        
        $cms_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "cms";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('cms_title', 'CMS Title', 'trim|required|callback_is_name_exists');
		//$this->form_validation->set_rules('cms_content', 'CMS Content', 'trim|required');
		$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
		$this->form_validation->set_rules('meta_keys', 'Meta keys', 'trim|required');
		$this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				$cms_title	= addslashes($this->input->post('cms_title'));
				$cms_slug	= url_title(strtolower($cms_title));
				$cms_content	= addslashes($this->input->post('cms_content'));
				$cms_meta_title = addslashes($this->input->post('meta_title'));
				$cms_meta_key 	= addslashes($this->input->post('meta_keys'));
				$cms_meta_description = addslashes($this->input->post('meta_description'));
				
				$cms_added_on	= date('Y-m-d H:i:s');
				
				$insertArr  =  array(
							'cms_title'		=> $cms_title,
							'cms_slug'		=> $cms_slug,
							'cms_content'   	=> $cms_content,
							'cms_meta_title'  	=> $cms_meta_title,
							'cms_meta_key'  	=> $cms_meta_key,
							'cms_meta_desc' 	=>$cms_meta_description,
							'cms_added_on'  	=> $cms_added_on
						);
				
				//$cms_image = '';
				//if ($_FILES['cms_image']['name'] != "")
				//{
				//	
				//	$upload_config['field_name']		= 'cms_image';
				//	$upload_config['file_upload_path'] 	= 'cms/';
				//	$upload_config['max_size']		= '';
				//	$upload_config['max_width']		= '';
				//	$upload_config['max_height']		= '';
				//	$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
				//	$thumb_config['thumb_create']		= true;
				//	$thumb_config['thumb_file_upload_path']	= 'thumb/';
				//	$thumb_config['thumb_marker']		= '';
				//	$thumb_config['thumb_width']		= '304';
				//	$thumb_config['thumb_height']		= '138';					
				//	$sUploaded = image_upload($upload_config, $thumb_config);
				//	
				//	if($sUploaded == '')
				//	{
				//		$this->nsession->set_userdata('errmsg', $sUploaded);
				//		redirect(BACKEND_URL."cms/index/".$page."/");
				//		return false;
				//	}
				//	else
				//	{
				//		$cms_image = $sUploaded;						
				//		$insertArr  	=  array(
				//			'cms_title'	=> $cms_title,
				//			'cms_slug'	=> $cms_slug,
				//			'cms_content'   => $cms_content,
				//			'cms_meta_key'  =>$cms_meta_key,
				//			'cms_meta_desc' =>$cms_meta_description,
				//			'cms_added_on'  => $cms_added_on,
				//			'cms_image'	=> $cms_image
				//		);
				//		
				//		$ret   = $this->model_basic->insertIntoTable(CMS,$insertArr);
				//		if($ret)
				//		{
				//			$this->nsession->set_userdata('succmsg', "CMS Page created successfully.");
				//		}
				//		else
				//		{
				//			$this->nsession->set_userdata('errmsg', "Unable to create. Please try again later.");
				//		}						
				//		redirect(BACKEND_URL."cms/index/".$page."/");
				//		return true;
				//	}
				//}
				//else
				//{
					$ret   = $this->model_basic->insertIntoTable(CMS,$insertArr);
						if($ret)
						{
							$this->nsession->set_userdata('succmsg', "CMS updated successfully.");
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
						}						
						redirect(BACKEND_URL."cms/index/".$page."/");
						return true;
				//}
				
			}
		}
		
		$this->data['cmsid'] = 0;
      
        //<!----------code------------------------->
        //$this->data['brdLink']='';
	 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'CMS Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."cms/index";
	
	$this->data['brdLink'][2]['logo']   =   'fa fa-file';
	$this->data['brdLink'][2]['name']   =   'Add New CMS Page';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['controller']='cms';
        $this->data['base_url'] = BACKEND_URL."cms/index";
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='cms/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_cms()
    {
        chk_login();
        $this->data='';
        
        //<!-------------------code---------------->
        
        $cms_id	= $this->uri->segment(3, 0);
	$page	= $this->uri->segment(4, 0);
		
		
		
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('cms_title', 'CMS Title', 'trim|required|callback_is_name_exists');
			//$this->form_validation->set_rules('cms_content', 'CMS Content', 'trim|required');
			$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
			$this->form_validation->set_rules('meta_keys', 'Meta keys', 'trim|required');
			$this->form_validation->set_rules('meta_description', 'Meta description', 'trim|required');
					
			if ($this->form_validation->run() == FALSE)
			{
                            
			}
			else
			{
				
				$cms_title	= addslashes(trim($this->input->get_post('cms_title')));
				$cms_slug	= url_title(strtolower($cms_title));
				$cms_content	= addslashes($this->input->post('cms_content'));
				$cms_meta_title = addslashes($this->input->post('meta_title'));
				$cms_meta_key 	= addslashes($this->input->post('meta_keys'));
				$cms_meta_description = addslashes($this->input->post('meta_description'));
				$updArr  	=  array(
							'cms_title' 		=> $cms_title,
							'cms_slug' 		=> $cms_slug,
							'cms_content' 		=> $cms_content,
							'cms_meta_title'	=>$cms_meta_title,
							'cms_meta_key'  	=>$cms_meta_key,
							'cms_meta_desc' 	=>$cms_meta_description
							
							
						);
				
				$idArr		= array( 'cms_id' => $cms_id );
				
				//$cms_image = '';
				//if ($_FILES['cms_image']['name'] != "")
				//{
				//	
				//	$upload_config['field_name']		= 'cms_image';
				//	$upload_config['file_upload_path'] 	= 'cms/';
				//	$upload_config['max_size']		= '';
				//	$upload_config['max_width']		= '';
				//	$upload_config['max_height']		= '';
				//	$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
				//	$thumb_config['thumb_create']		= true;
				//	$thumb_config['thumb_file_upload_path']	= 'thumb/';
				//	$thumb_config['thumb_marker']		= '';
				//	$thumb_config['thumb_width']		= '304';
				//	$thumb_config['thumb_height']		= '138';					
				//	$sUploaded = image_upload($upload_config, $thumb_config);
				//	
				//	$arr_user_image_old = $this->model_cms->get_single($cms_id);
				//	$user_image_old     = $arr_user_image_old[0]['cms_image'];
				//	
				//	if($sUploaded == '')
				//	{
				//		$this->nsession->set_userdata('errmsg', $sUploaded);
				//		redirect(BACKEND_URL."cms/index/".$page."/");
				//		return false;
				//	}
				//	else
				//	{
				//		$cms_image = $sUploaded;
				//		
				//		$updArr  	=  array(
				//			'cms_title' 	=> $cms_title,
				//			'cms_slug' 	=> $cms_slug,
				//			'cms_content' 	=> $cms_content,
				//			'cms_meta_key'  =>$cms_meta_key,
				//			'cms_meta_desc' =>$cms_meta_description,
				//			'cms_image'	=> $cms_image
				//		);
				//		
				//		if(file_exists(file_upload_absolute_path().'cms/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != "")
				//		{
				//			unlink(file_upload_absolute_path().'cms/'.stripslashes($user_image_old));
				//			unlink(file_upload_absolute_path().'cms/thumb/'.stripslashes($user_image_old));
				//		}
				//		
				//		$ret   = $this->model_basic->updateIntoTable(CMS,$idArr, $updArr);
				//		if($ret)
				//		{
				//			$this->nsession->set_userdata('succmsg', "CMS updated successfully.");
				//		}
				//		else
				//		{
				//			$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
				//		}						
				//		redirect(BACKEND_URL."cms/index/".$page."/");
				//		return true;
				//	}
				//}
				//else {
					$ret   = $this->model_basic->updateIntoTable(CMS,$idArr, $updArr);
					
						if(isset($ret))
						{
							$this->nsession->set_userdata('succmsg', "CMS updated successfully.");
						}
						else
						{
							$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
						}						
						redirect(BACKEND_URL."cms/index/".$page."/");
						return true;
				//}
				
			}
		}		
		
                $row = array();

		$Condition = " cms_id = '".$cms_id."'";
		$rs = $this->model_basic->getValues_conditions(CMS, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_cms'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_cms/".$page."/");
                        return false;
                }
        
        
        
        
        //<!------------------code----------------->
        
        //$this->data['brdLink']='';
	 //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-file';
	$this->data['brdLink'][1]['name']   =   'CMS Listing';
	$this->data['brdLink'][1]['link']   =    BACKEND_URL."cms/index";
	
	$this->data['brdLink'][2]['logo']   =   'fa fa-file';
	$this->data['brdLink'][2]['name']   =   'Edit CMS Page';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['controller']='cms';
        $this->data['edit_link'] = BACKEND_URL."cms/edit_cms/".$cms_id."/".$page."/";
        $this->data['base_url'] = BACKEND_URL."cms/index";
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_cms/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='cms/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
        
        
    }
}
?>