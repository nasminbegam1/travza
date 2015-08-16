<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('model_users');
		$this->load->model('model_basic');
	}

	public function index(){
		/******************************************/
		$this->chk_not_login();
		$this->data='';
		$this->data['email']='';
		$this->data['password']='';
		if(isset($_COOKIE['remember_me'])){
			$this->data['email']=$_COOKIE['email'];
			$this->data['password']=$_COOKIE['password'];
		}
		/*****************************************/
		$this->data['errmsg']  = $this->nsession->userdata('errmsg');
		$this->data['succmsg']  = $this->nsession->userdata('succmsg');
		$this->nsession->unset_userdata('errmsg');
		$this->nsession->unset_userdata('succmsg');
                 
		if($this->input->get_post('action') == 'Process')
		{                                   
                    if($this->input->post('email') ){
                            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                            $this->form_validation->set_rules('password', 'Password', 'trim|required');			
                            if($this->form_validation->run()){
                                    $email 	=  $this->input->post('email');
                                    $where = "email='".$email."' AND password = '".md5($this->input->post('password'))."'";
                                    $record = $this->model_basic->getFromWhereSelect(SITEUSER,'',$where);
                                    
                                if(is_array($record))
				{
                                        if($record[0]['status']=='Active')
					{
						/*******************Remember Me*****************/
						$remember = $this->input->post('remember_me');
						if ($remember) {						
							setcookie('remember_me', '1', time()+60*60*24*100, "/");
							setcookie('email', $email, time()+60*60*24*100, "/");
							setcookie('password', $this->input->post('password'), time()+60*60*24*100, "/");
						}else {   // if user not check the remember me checkbox
							setcookie('remember_me', '', time()-60*60*24*100, "/");
							setcookie('email', '', time()-60*60*24*100, "/");
							setcookie('password', '', time()-60*60*24*100, "/");			
						}
						/**********************************************/
						$this->nsession->set_userdata('user_id', $record[0]['id']);
						$this->nsession->set_userdata('user_name', stripslashes($record[0]['first_name']));
						$this->nsession->set_userdata('last_name', stripslashes($record[0]['last_name']));
						if($this->nsession->userdata('PREV_LINK') != ''){
							$this->nsession->set_userdata('PREV_LINK','');
							$this->nsession->unset_userdata('PREV_LINK');
							redirect(FRONTEND_URL.'dashboard/');
						}else{
							if($record[0]['profile_complete'] == '0')
							{
								$this->model_basic->updateLastLoginTime($record[0]['id']);
								redirect(FRONTEND_URL.'dashboard/first_time_visitor_profile');
							}
							else
							{
							   $this->model_basic->updateLastLoginTime($record[0]['id']);
							   redirect(FRONTEND_URL.'dashboard/');
							}
						}
                                
					}else{
						    $errorArr[] = 'Your account is not Active.';
					}
                                }else{
                                        $errorArr[] = 'Wrong email address or password. Try again.';
                                    }
                                    
                                    if(count($errorArr)){
                                        $this->nsession->set_userdata('errmsg', $errorArr);
                                        redirect(FRONTEND_URL.'login');
                                    }
                            }
                    }elseif($this->is_logged()){
                            
                        redirect(FRONTEND_URL.'dashboard/');
                    }
                }
                
		
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']			= 'users/login';			
		$this->elements_data['middle'] 			= $this->data;	
		$this->layout->multiple_view($this->elements,$this->elements_data);
        }
        
	public function forgotpassword()
	{		
		$this->data = '';
		if($this->input->get_post('action') == 'Process')
		{  
		$email = $this->input->get_post('email');
            
			if(isset($email) && !empty($email))
			{
				$where = "email='".$email."'";
				$arrUser = $this->model_basic->getFromWhereSelect(SITEUSER,'',$where);
				
				if(is_array($arrUser) && count($arrUser) > 0){	
					
					$first_name 	= $arrUser[0]['first_name'];
					$last_name 	= $arrUser[0]['last_name'];	
					$password 	= $arrUser[0]['password'];					
					$settings 	= $this->model_basic->get_settings('1');
					//echo $settings['sitename']; echo $settings['webmaster_email'];
					//pr($settings);
					//$ConfigMail['mailtype'] 	= 'html';
					$pass_link = FRONTEND_URL."login/get_password/".md5($arrUser[0]['email']); 
					$ConfigMail['to'] 	= $arrUser[0]['email'];
					$ConfigMail['from']	= $settings['TravelDotz Webmaster'];
					$ConfigMail['from_name']= $settings['sitename'];
					$ConfigMail['subject']	= "TravelDotz Password Recovery";
					$ConfigMail['message'] = '<html><body>';
					$ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
					$ConfigMail['message'].= '</br>';
					$ConfigMail['message'].= '<p> Please Click here to change your password : '.$pass_link.'</p>';
					$ConfigMail['message'].= '</br>';
					$ConfigMail['message'].= '<p>If you did not request a password reset please contact us immediately. </p>';
					$ConfigMail['message'].= '</br>';
					$ConfigMail['message'].= '<p>Thanks, </p>';
					$ConfigMail['message'].= '</br>';
					$ConfigMail['message'].= '<a href="'.FRONTEND_URL.'"><b>The TravelDotz Team</b></a>';
					$ConfigMail['message'].= '</body></html>';
							
					$mail 		= send_html_email($ConfigMail);
					
					if($mail)	
					{	
						$msg = 'Password sent to your email address. Please check.';
						$this->nsession->set_userdata('succmsg', $msg);
					}
					}else{
						$msg = stripslashes($email) . ' was not found in our database';
						$this->nsession->set_userdata('errmsg', $msg);
					}
			}
		}
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg']	= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', '');
		$this->nsession->set_userdata('errmsg', '');
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']='users/forgotpassword';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function get_password()
	{		
		$this->data = '';
		if($this->input->get_post('action') == 'Process')
		{  
		$email = $this->uri->segment('3');
		$pwd = $this->input->get_post('pwd');
			if(isset($email) && !empty($email))
			{
				$where = "md5(email)='".$email."'";
				$arrUser = $this->model_basic->getFromWhereSelect(SITEUSER,'',$where);
				if(is_array($arrUser) && count($arrUser) > 0){	

				 $updateArr  =  array(
				   'password' 			=> md5($pwd)
				   );
				   $whereArr = array('md5(email)'=>$email);
				   $this->model_basic->updateIntoTable(SITEUSER, $whereArr, $updateArr);		
				$msg = 'Password Updated. Now you can login with your updated password.';
				$this->nsession->set_userdata('succmsg', $msg);
				}
				else{
						$msg = 'email was not found in our database';
						$this->nsession->set_userdata('errmsg', $msg);
				}
			}
		}
		$this->data['succmsg']	= $this->nsession->userdata('succmsg');
		$this->data['errmsg']	= $this->nsession->userdata('errmsg');
		$this->nsession->set_userdata('succmsg', '');
		$this->nsession->set_userdata('errmsg', '');
		$this->templatelayout->get_header();
		$this->templatelayout->get_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']='users/getpassword';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function logout(){
		//$this->nsession->unset_userdata('user_id');
		//$this->nsession->unset_userdata('user_name');
		$this->nsession->set_userdata('user_id','');
		$this->nsession->set_userdata('user_name','');
		//$this->nsession->destroy();
		redirect(base_url());
	}
	
	public function vendor_logout()
	{
		//$this->nsession->unset_userdata('vendor_id');
		//$this->nsession->unset_userdata('vendor_first_name');
		//$this->nsession->unset_userdata('vendor_last_name');
		$this->nsession->set_userdata('vendor_id','');
		$this->nsession->set_userdata('vendor_first_name','');
		$this->nsession->set_userdata('vendor_last_name','');
		//$this->nsession->destroy();
		redirect(base_url());
	}
}
?>