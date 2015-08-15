<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
	}

	public function index()
	{
		chk_not_login();
		$this->data = '';
		$this->data['msg'] = $this->nsession->userdata('msg');
		$this->nsession->set_userdata('msg', '');
		
		$this->elements['middle']='login/login';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout_login');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
	
	public function do_login()
	{
		//pr($_POST);
		$email		= mysql_real_escape_string( trim( $this->input->get_post('email') ) );
		$password	= mysql_real_escape_string( trim( $this->input->get_post('password') ) );
		$remember1	= mysql_real_escape_string($this->input->get_post('remember1'));
		if($remember1 == ''){
			$remember1 = 'No';
		}
		$role_id = '1,2';
		$arrUser = $this->model_user->getSingle($email, $password,$remember1,$role_id);
		//pr($arrUser);
		if(isset($arrUser['user_id']) && $arrUser['user_id'] != '')
		{
			redirect(BACKEND_URL."dashboard");
		}
                else
		{
			$this->nsession->set_userdata('msg', 'Invalid email id or password');
			redirect(BACKEND_URL);
                }
	}
	
        public function forgotpassword()
	{		
		$this->data = '';
		
		$this->data['msg'] = $this->nsession->userdata('msg');
		
		$this->nsession->set_userdata('msg', '');
		
		if($this->nsession->userdata('user_id') != '')
		{
			$url = BACKEND_URL."login/";
			redirect($url);
		}
		
		$this->elements['middle']='login/forgotpassword';			
		$this->elements_data['middle'] = $this->data;			    
		$this->layout->setLayout('layout_login');
		$this->layout->multiple_view($this->elements,$this->elements_data);
	}
        
        public function do_forgotpassword()
        {
            $this->load->library('email');
            if($this->nsession->userdata('user_id') != '')
	    {
			$url = BACKEND_URL."login/";
			redirect($url);
	    }
            
            $email = $this->input->get_post('email');
            
            	if(isset($email) && !empty($email))
		{
			 $arrUser 	= $this->model_user->getUserByEmail($email);			
		
			if(count($arrUser) > 0){	
				
				
				$first_name 	= $arrUser[0]['first_name'];
				$last_name 	= $arrUser[0]['last_name'];	
				$password 	= $arrUser[0]['password'];					
				$settings 	= $this->model_basic->get_settings('1,2');				
                                
				$ConfigMail['mailtype'] 	= 'html';
				//$ConfigMail['to'] 	= $arrUser[0]['email_id'];
				$ConfigMail['to'] 	= 'begam.nasmin91@gmail.com';
				$ConfigMail['from']	= $settings['webmaster_email'];
				$ConfigMail['from_name']= $settings['sitename'];
				
				$ConfigMail['subject']	= "Password Recovery at ".BACKEND_URL;
				$ConfigMail['message'] = '<html><body>';
                                $ConfigMail['message'].= 'Hello '.$first_name.' '.$last_name;
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<p> Please note down your password for admin panel : '.$password.'</p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Thanks, </p>';
                                $ConfigMail['message'].= '</br>';
				$ConfigMail['message'].= '<p>Team '.$settings['sitename'].'</p>';
                                $ConfigMail['message'].= '</br>';
                                $ConfigMail['message'].= '<a href="'.BACKEND_URL.'">'.BACKEND_URL.'</a>';
                                $ConfigMail['message'].= '</body></html>';
				//print_r($ConfigMail);exit;	
				$mail 		= send_email($ConfigMail);
				if($mail)	
				{	
					$msg = 'Password sent to your mail address. Please check.';	
				}
				}else{
					$msg = stripslashes($email) . ' was not found in our database';
				}
		}
		else
		{
			$msg = 'Please enter mail address';			
		}
		
		$this->nsession->set_userdata('msg', $msg);
		redirect('login/forgotpassword');
		return true;
		
            
        }
    
	
}