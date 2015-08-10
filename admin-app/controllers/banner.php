<?php
class Banner extends CI_Controller{
    
    var $bannerTable 	= 'hw_banner_master';
    public function __construct(){
        parent:: __construct();
     
        $this->load->model("model_banner");
	$this->load->library('cdnupload');
	$this->load->library('image_lib');
    }
    
     public function index()
    {
        chk_login();
        $this->data='';
        
        //<!----------------------code------------------------->
        
	        $config['base_url'] 	= BACKEND_URL."banner/index/";
		$config['per_page'] 	= 20;
		$config['uri_segment']	= 3;
		$config['num_links'] 	= 5;
		$this->pagination->setCustomAdminPaginationStyle($config);
		
		$this->data['search_keyword']	= '';
		$this->data['per_page']	= '';
		$this->data['params']		= $this->nsession->userdata('BANNER_SEARCH');
		
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
		
		$start 				= 0;
		$page				= $this->uri->segment(3,0);
		$this->data['bannerList']	= $this->model_banner->getList($config,$start);
		$this->data['startRecord'] 	= $start;
               
		$this->data['totalRecord'] 	= $config['total_rows'];
		$this->data['per_page'] 	= $config['per_page'];
		$this->data['page']	 	= $page;
		$this->data['controller'] 	= 'banner';	
		$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";				
		$this->data['show_all']      	= BACKEND_URL.$this->data['controller']."/index/0/1/";
		$this->data['add_link']      	= BACKEND_URL.$this->data['controller']."/add_banner/0/".$page."/";
		$this->data['status_link']   	= BACKEND_URL.$this->data['controller']."/do_status/{{ID}}/".$page."/";
		$this->data['edit_link']      	= BACKEND_URL.$this->data['controller']."/edit_banner/{{ID}}/".$page."/";
		$this->data['delete_link']	= BACKEND_URL.$this->data['controller']."/delete_banner/{{ID}}/".$page."/";
		

        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        //<!----------------------code------------------------->
        //$this->data['brdLink']='';
	//For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Banner Listing';
	$this->data['brdLink'][1]['link']   =   'javascript:void(0)';
	
	//........................	
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='banner/list';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_exists()
    {
		
		$id 		= $this->uri->segment(3, 0);
		$banner_title	= strip_tags(addslashes(trim($this->input->get_post('banner_title'))));
		
		$whereArr	= array();
		if($id > 0){
			$whereArr	= array( 'banner_title' => $banner_title,
						 'banner_id != ' => $id						
						);
		}else{			
			$whereArr	= array( 'banner_title' => $banner_title );
		}
		$bool 	= $this->model_basic->checkRowExists(BANNER_MASTER, $whereArr );	
		if($bool == 0){
			$this->form_validation->set_message('is_name_exists', 'The %s name already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
    
    public function add_banner()
    {
        chk_login();
        $this->data='';
        
        //<!-----------code----------------->
        
                $banner_id	= $this->uri->segment(3, 0);
		$page	= $this->uri->segment(4, 0);
		$this->data['controller']	= "banner";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
                $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
		$action = $this->input->post('action',true);
		$this->form_validation->set_rules('banner_title', 'Alt Tag', 'trim|required|callback_is_name_exists');
		
		
		if($this->input->get_post('action') == 'Process'){
			
			if ($this->form_validation->run() != FALSE && $action != FALSE)
			{
				
				$user_image	= '';
				//if(file_exists($_FILES['banner_image']['tmp_name']) && $_FILES['banner_image']['name'] != "")
				//{
				//        $imageDim = getimagesize($_FILES['banner_image']['tmp_name']);
				//	if(($imageDim[0]<1680)||($imageDim[1]<773))
				//	{
				//		
				//		$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 1680x773.");
				//		redirect(base_url()."banner/index/".$page."/");
				//	}
				//}
				
			if ($_FILES['banner_image']['name'] != ""){
                                $upload_config['field_name']				= 'banner_image';
				$upload_config['file_upload_path'] 			= 'banner/';
				$upload_config['max_size']				= '';
				$upload_config['max_width']				= '1920';
				$upload_config['max_height']				= '580';
				$upload_config['allowed_types']				= '*';
                                
                                $thumb_config['thumb_create']                           = true;
                                $thumb_config['thumb_file_upload_path']                 = 'thumb/';
                                $thumb_config['thumb_width']                            = '';
                                $thumb_config['thumb_height']                           = '';
                                
                                $isUploaded = image_upload($upload_config,$thumb_config);
				
                                
				if($isUploaded == '')
				{
					$this->nsession->set_userdata('errmsg', $isUploaded);
					redirect(base_url()."banner/");
					return false;
				}
				else
				{
					$user_image = $isUploaded;
					$banner_title	        = addslashes($this->input->post('banner_title'));
					$banner_image	        = $user_image;
					$banner_order	        = addslashes($this->input->post('banner_order'));
					$banner_status	        = addslashes($this->input->post('banner_status'));
					$banner_updated_on	= date('Y-m-d H:i:s');
					
					
					$insertArr  =  array(
								'banner_title'	        => $banner_title,
								'banner_image'	        => $banner_image,
								'banner_order'          => ((!$banner_order) ? '-999' : $banner_order),
								'banner_status'         => $banner_status,
								'banner_updated_on'     => $banner_updated_on
							);
					$res = $this->model_basic->insertIntoTable(BANNER_MASTER,$insertArr);
					if($res)
					{
						$this->nsession->set_userdata('succmsg', "Banner Added Successfuly.");
						redirect(base_url()."banner/");
					}else{
						$this->nsession->set_userdata('errmsg', "Unable to Add Banner");
						redirect(base_url()."banner/");
					}
				       
					
				}
			}
			else{
					$this->nsession->set_userdata('errmsg', "Unable to Add Banner");
					redirect(base_url()."banner/");
			}
				
			}
		}
		
		$this->data['bannerid'] = 0;
        
        //<!-----------code----------------->
       // $this->data['brdLink']='';
         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Banner Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."banner/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Add New Banner';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
        $this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";	
        $this->data['add_url']      	= BACKEND_URL.$this->data['controller']."/add_banner/0/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='banner/add';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    public function edit_banner()
    {
        
	chk_login();
        $this->data='';
	//<!------------code------------------->
	$banner_id	= $this->uri->segment(3, 0);
        $page	= $this->uri->segment(4, 0);
		
		$this->data['controller']	= "banner";
		$this->data['return_link']  	= BACKEND_URL.$this->data['controller']."/index/".$page;
                $this->data['lastOrderLimit']   = $this->model_banner->lastOrderLimit();
		
		if($this->input->get_post('action') == 'Process')
		{			
			$this->form_validation->set_rules('banner_title', 'Alt Tag', 'trim|required|callback_is_name_exists');
			
			if ($this->form_validation->run() == FALSE){
                            
			}
			else
			{
				
				
				
				//if(file_exists($_FILES['banner_image']['tmp_name']))
				//{
				//       $imageDim = getimagesize($_FILES['banner_image']['tmp_name']);
				//       if(($imageDim[0]<1680)||($imageDim[1]<773))
				//       {
				//		
				//		$this->nsession->set_userdata('errmsg', "Image dimensions do not match please upload image with dimentions 1680x773.");
				//		redirect(base_url()."banner/index/".$page."/");
				//       }
				//}
				
                            $banner_image = '';
			if ($_FILES['banner_image']['name'] != ""){
                                $upload_config['field_name']				= 'banner_image';
				$upload_config['file_upload_path'] 			= 'banner/';
				$upload_config['max_size']				= '';
				$upload_config['max_width']				= '1920';
				$upload_config['max_height']				= '580';
				$upload_config['allowed_types']				= '*';
                                
                                $thumb_config['thumb_create']                           = true;
                                $thumb_config['thumb_file_upload_path']                 = 'thumb/';
                                $thumb_config['thumb_width']                            = '';
                                $thumb_config['thumb_height']                           = '';
                                
				
				$isUploaded = image_upload($upload_config, $thumb_config);
				$banner_image = $isUploaded;
				
                               
                                $currentFile	        = $this->input->post('currentFile');
								
				$arr_banner_image_old 	= $this->model_banner->get_single($banner_id);
				$banner_image_old     	= $arr_banner_image_old[0]['banner_image'];
				
				
				if($isUploaded == '')
				{
					$this->nsession->set_userdata('errmsg', $this->nsession->userdata('upload_err'));
					$this->nsession->set_userdata('upload_err', '');
					redirect(base_url()."banner/");
					return false;
				}
				else
				{
					if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'banner/'.stripslashes($banner_image_old)) && stripslashes($banner_image_old) != ""){
						unlink(FILE_UPLOAD_ABSOLUTE_PATH.'banner/'.stripslashes($banner_image_old));
						unlink(FILE_UPLOAD_ABSOLUTE_PATH.'banner/thumb/'.stripslashes($banner_image_old));
					}
					$banner_title	        = addslashes($this->input->post('banner_title'));
					$banner_image	        = ((!$isUploaded) ? $currentFile : $banner_image);
					$banner_order	        = addslashes($this->input->post('banner_order'));
					$banner_status	        = addslashes($this->input->post('banner_status'));
					$banner_updated_on	= date('Y-m-d H:i:s');
					
					
					$insertArr  =  array(
								'banner_title'	        => $banner_title,
								'banner_image'	        => $banner_image,
								'banner_order'          => ((!$banner_order) ? '-999' : $banner_order),
								'banner_status'         => $banner_status,
								'banner_updated_on'     => $banner_updated_on
							);
					
					$idArr		= array(
								'banner_id' => $banner_id
							       );
					$ret   = $this->model_basic->updateIntoTable(BANNER_MASTER,$idArr, $insertArr);
					if($ret)
					{
						$this->nsession->set_userdata('succmsg', "Banner updated successfully.");
					}
					else
					{
						$this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
					}
					redirect(BACKEND_URL."banner/index/".$page."/");
					return true;
				}
			}
			else
			{
			    $banner_title	        = addslashes($this->input->post('banner_title'));
			    $banner_order	        = addslashes($this->input->post('banner_order'));
			    $banner_status	        = addslashes($this->input->post('banner_status'));
			    $banner_updated_on	= date('Y-m-d H:i:s');
			    
			    
			    $insertArr  =  array(
						    'banner_title'	    => $banner_title,
						    'banner_order'          => ((!$banner_order) ? '-999' : $banner_order),
						    'banner_status'         => $banner_status,
						    'banner_updated_on'     => $banner_updated_on
					    );
			    
			    $idArr		= array(
						    'banner_id' => $banner_id
						   );
			    $ret   = $this->model_basic->updateIntoTable(BANNER_MASTER,$idArr, $insertArr);
			    if($ret)
			    {
				    $this->nsession->set_userdata('succmsg', "Banner updated successfully.");
			    }
			    else
			    {
				    $this->nsession->set_userdata('errmsg', "Unable to update. Please try again later.");
			    }
			    redirect(BACKEND_URL."banner/index/".$page."/");
			    return true;
			}
			
		}
		
		}
		
                $row = array();

		// Prepare Data
		$Condition = " banner_id = '".$banner_id."'";
		$rs = $this->model_basic->getValues_conditions(BANNER_MASTER, '', '', $Condition);
		
		$row = $rs[0];
                if($row){
                    $this->data['arr_banner'] = $row;
                } else {
                        $this->nsession->set_userdata('errmsg', "Record does not exist.");
                        redirect(BACKEND_URL.$this->data['controller']."/edit_banner/".$page."/");
                        return false;
                }
	
	         //For breadcrump..........
	$this->data['brdLink'][0]['logo']   =   'fa fa-file';
	$this->data['brdLink'][0]['name']   =   'CMS';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';	
		
	$this->data['brdLink'][1]['logo']   =   'fa fa-picture-o';
	$this->data['brdLink'][1]['name']   =   'Banner Listing';
	$this->data['brdLink'][1]['link']   =   BACKEND_URL."banner/index";
	
	$this->data['brdLink'][2]['logo']   =   '';
	$this->data['brdLink'][2]['name']   =   'Edit Banner';
	$this->data['brdLink'][2]['link']   =   'javascript:void(0)';
	
	//........................
	//<!------------code------------------->
	//$this->data['brdLink']='';
	$this->data['base_url'] 	= BACKEND_URL.$this->data['controller']."/index/0/1/";
        $this->data['edit_url']      = BACKEND_URL.$this->data['controller']."/edit_banner/".$banner_id."/".$page."/";
        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
        
        $this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
        $this->elements['middle']='banner/edit';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    public function delete_banner()
   {
		$id = $this->uri->segment(3, 0);
		
		if($id!=NULL)
		{
			$arr_banner_existing_image = $this->model_banner->get_single($id);
			$banner_existing_image    = $arr_banner_existing_image[0]['banner_image'];
			
			$delete_where	= "FIND_IN_SET(banner_id, '".$id."')";
			$res = $this->model_basic->deleteData(BANNER_MASTER, $delete_where);
			if($res)
			{
			      
			      
			//      if(isFileExist(CDN_TEAM_IMG.$banner_existing_image) && stripslashes($banner_existing_image) != "")
			//      {
			//		 @unlink(CDN_BANNER_IMG.stripslashes($banner_existing_image));
			//		 @unlink(CDN_BANNER_THUMB_IMG.stripslashes($banner_existing_image));
			//      }
			      
				if(file_exists(file_upload_absolute_path().'banner/'.stripslashes($banner_existing_image)) && stripslashes($banner_existing_image) != "")
				{
					unlink(file_upload_absolute_path().'banner/'.stripslashes($banner_existing_image));
					unlink(file_upload_absolute_path().'banner/thumb/'.stripslashes($banner_existing_image));
				}
				
				
				$this->nsession->set_userdata('succmsg', "Banner Deleted Successfuly.");
				redirect(base_url()."banner/");
			}
			else
			{
				
				$this->nsession->set_userdata('succmsg', "Unable to Delete Banner");
				redirect(base_url()."banner/");
			}
		}
   }
   public function change_status(){
		$banner_id 	= $this->input->post('id');
		$alias		= '';
		$condition	= "banner_id = '".$banner_id."'";
		$rec = $this->model_basic->getValues_conditions(BANNER_MASTER, '', $alias, $condition);
if(is_array($rec) and count($rec)>0){
		    $rec =$rec[0];
		   $status = $rec['banner_status'];
		   $new_status ='';
		   if($status=='active'){
		     $new_status = 'inactive';
		   }
		   else if($status=='inactive'){
		     $new_status = 'active';
		   }
		   
		    $updateArr  =  array('banner_status' => $new_status);
			     
		    $idArr      = array('banner_id' => $banner_id);
	     
		    $ret   = $this->model_basic->updateIntoTable(BANNER_MASTER,$idArr, $updateArr);
		}
	}
}
?>