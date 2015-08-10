<?php

class Profile extends CI_Controller{
    
    
    public function __construct(){
        parent:: __construct();
       
        $this->load->model("model_adminuser");
        $this->load->model("user_model");
    }
    
    public function index()
    {
        chk_login();
        $this->data='';
	$profile_type = $this->uri->segment(3);
        //$page_type	= $this->uri->segment(3, 0);
        //$this->data['result']=$page_type;
        $logged_id=$this->nsession->userdata('admin_id');
        $type=$this->nsession->userdata('role');
       
        
        if($this->input->get_post('profile') == 'editprofile'){
            
                         
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|callback_is_name_pair_exists');
			if ($this->form_validation->run() == FALSE)
                        {
				
			}
                        else
                        {
                            
                            $user_image = '';
                            
				if ($_FILES['user_image']['name'] != ""){
					
					$upload_config['field_name']		= 'user_image';
					$upload_config['file_upload_path'] 	= 'admin/';
					$upload_config['max_size']		= '';
					$upload_config['max_width']		= '1200';
					$upload_config['max_height']		= '800';
					$upload_config['allowed_types']		= 'jpg|jpeg|gif|png';
					$thumb_config['thumb_create']		= true;
					$thumb_config['thumb_file_upload_path']	= 'thumb/';
					$thumb_config['thumb_width']		= '';
					$thumb_config['thumb_height']		= '';
					
					$user_image = '';
					$sUploaded = image_upload($upload_config, $thumb_config);
					$user_image = $sUploaded;
					
                                        
					$arr_user_image_old = $this->model_adminuser->get_single($logged_id);
					$user_image_old     = $arr_user_image_old[0]['image'];
					
					if($sUploaded == '')
					{
						$this->nsession->set_userdata('errmsg', $this->nsession->userdata('upload_err'));
						$this->nsession->set_userdata('upload_err', '');
						redirect(base_url()."profile/index");
						return false;
					}
					else
					{
						if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.stripslashes($user_image_old)) && stripslashes($user_image_old) != ""){
							unlink(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.stripslashes($user_image_old));
							unlink(FILE_UPLOAD_ABSOLUTE_PATH.'admin/thumb/'.stripslashes($user_image_old));
						}
						$this->user_model->updateAdminUsersProfile($logged_id, $user_image,$type);
						$this->nsession->set_userdata('succmsg', "Admin user profile details updated successfully.");			
                                                redirect(base_url()."profile/index/");
                                                return true;
					}
				}
				else {
					
                                        $this->user_model->updateAdminUsersProfile($logged_id,'',$type);
                                        $this->nsession->set_userdata('succmsg', "Admin user profile details updated successfully.");			
                                        redirect(base_url()."profile/index");
                                        return true;
                            
                            
				}
                            
                            
                        }
        }
        if($this->input->get_post('account') == 'editaccount'){
            
                         
			$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email|callback_is_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE)
                        {
				
			}
                        else
                        {
                            $this->user_model->updateAdminUsersAccount($logged_id,$type);
			    $this->nsession->set_userdata('succmsg', "Admin user account details updated successfully.");			
			    redirect(base_url()."profile/index/account");
			    return true;
                            
                            
                        }
        }
        if($this->input->get_post('contact') == 'editcontact'){
            
                            $this->user_model->updateAdminUsersContact($logged_id,$type);
			    $this->nsession->set_userdata('succmsg', "Admin user contact details updated successfully.");			
			    redirect(base_url()."profile/index/contact");
			    return true;
                        
        }
        
        $this->data['base_url'] = BACKEND_URL."dashboard";
	$this->data['profile_url'] = BACKEND_URL."profile/index";
        $this->data['user_info'] = $this->model_adminuser->get_single($logged_id);
	//$this->data['logged_info'] = $this->model_adminuser->get_single($logged_id);
	
       //For breadcrump..........
		
	$this->data['brdLink'][0]['logo']   =   'fa fa-user';
	$this->data['brdLink'][0]['name']   =   'User Profile';
	$this->data['brdLink'][0]['link']   =   'javascript:void(0)';
	
	//........................

        $this->data['succmsg'] = $this->nsession->userdata('succmsg');
	$this->data['errmsg'] = $this->nsession->userdata('errmsg');		
	$this->nsession->set_userdata('succmsg', "");		
	$this->nsession->set_userdata('errmsg', "");
	
	$this->templatelayout->get_topbar();
	$this->templatelayout->get_leftmenu();
	$this->templatelayout->get_footer();
	
        $this->elements['middle']='users/profile';			
        $this->elements_data['middle'] = $this->data;			    
        $this->layout->setLayout('layout');
        $this->layout->multiple_view($this->elements,$this->elements_data);
    }
    
    function is_name_pair_exists($lastname)
    {
		chk_login();
		$logged_id=$this->nsession->userdata('admin_id');
                $type=$this->nsession->userdata('role');
		$bool = $this->model_adminuser->checkNamePairExists($lastname, $logged_id, $type);
		if(!$bool){
			$this->form_validation->set_message('is_name_pair_exists', 'The first name & last name pair already exits');
			return FALSE;
		}else{
			return TRUE;
		}		
    }
    function is_email_exists($email)
    {
		chk_login();
		$logged_id=$this->nsession->userdata('admin_id');
                $type=$this->nsession->userdata('role');
		$bool = $this->model_adminuser->get_email_existence($email, $logged_id, $type);
		if(!$bool){
			$this->form_validation->set_message('is_email_exists', 'The %s already exists');
			return FALSE;
		}else{
			return TRUE;
		}
    }
}
?>