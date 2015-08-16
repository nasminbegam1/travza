<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * Constructor for CommonController
	 */
	public function __construct() {
            parent::__construct();
            $this->load->model('model_basic');
            $this->load->helper('common_helper');
	   
	}

	/**
	 *  Login Check function
	 *  @param Boolean $pbCheckLogin
	 */
	public function chk_login(){ 
	    $user_id = $this->nsession->userdata('user_id');
	    if( !$user_id || empty($user_id) ){
		redirect(base_url().'login/');
		return false;
	    }
	   return true;
	}
	public function chk_vendor_login()
	{
	    $vendor_id = $this->nsession->userdata('vendor_id');
	    if( !$vendor_id || empty($vendor_id) ){
		redirect(base_url().'vendor/sign_in/');
		return false;
	    }
	   return true;
	}
	public function chk_not_login(){
	    $user_id = $this->nsession->userdata('user_id');
	    if( $user_id && $user_id != '' ){
		redirect(base_url()."dashboard");
		return false;
	    }
	    return true;
	}
	
	public function chk_vendor_not_login(){
	    $vendor_id = $this->nsession->userdata('vendor_id');
	    if( $vendor_id && $vendor_id != '' ){
		redirect(base_url()."vendor_dashboard");
		return false;
	    }
	    return true;
	}
	
	//public function is_logged(){
	//	$this->current_user = $this->nsession->userdata('current_user');
	//	if( $this->current_user && $this->current_user['admin_id'] && $this->current_user['email_id'] )
	//	{
	//		return true;
	//	}else{
	//		return false;
	//	}
	//	
	//}	
		
//	public function getMailContent($to = '',$emailTemplate = '', $subject = array(), $content = array()){
//            $this->load->library('email');
//            //get the admin details like admin email and sitename
//            $siteEmail = $this->Model_basic->get_option('webmaster_email');
//            $siteName  = html_entity_decode($this->Model_basic->get_option('sitename'));
//
//            $mailContent = $this->Model_basic->getDataByWhere('uniqueReference = "'.$emailTemplate.'" ' , 'email_template_master');
//            $mailArray = array(
//                        'to' => '',
//                        'from' => '',
//                        'fromName' => '',
//                        'subject' => '',
//                        'content' => ''
//                    );
//            if($mailContent){
//            $templateSubject = $mailContent[0]['subject'];
//            if($templateSubject != ''){
//                if($subject && ($subject)>0){
//                    $subject = str_replace($subject['from'],$subject['to'],$templateSubject);
//                }
//            }
//
//            $templateContent = $mailContent[0]['tempContent'];
//            if($templateContent){
//                if($content && ($content)>0){
//                    $content = str_replace($content['from'],$content['to'],$templateContent);
//                }
//            }
//
//            $mailArray = array(
//                        'to' => $to,
//                        'from' => $siteEmail,
//                        'fromName' => $siteName,
//                        'subject' => $subject,
//                        'content' => $content
//                    );
//            
//            }
//            $mail = false;
//            $mail = $this->sendMail($mailArray);
//            return $mail;
//        }

        /**
	 * Pagination Configuratiuon
	 * @param Array $parrConfig
	 * @return Array
	 */

        public function configPagination (&$parrConfig) {

             $iLimit = $this->config->item('pagination_limit');
             $iTotalRows  = $parrConfig['totalRow'];
             $config['base_url'] = BACK_END_URL.$parrConfig['base_url'];
             $config['total_rows'] = $iTotalRows;
             $config['per_page'] = $iLimit;
             $config['num_links'] = $this->config->item('pagination_num_links');
             $arrData['pagination'] = '';

             if($iTotalRows > $iLimit) {
                $this->pagination->initialize($config);
                $sPaginationLink = $this->pagination->create_links();
                $arrData['pagination'] = $sPaginationLink;
             }

             $arrData['iLimit'] = $iLimit;
             $arrData['iTotalRows'] = $iTotalRows;

             return $arrData;

        }
	
	

	
	
}

/* End of file MY_CONTROLLER.php */
/* Location: ./admin-app/core/MY_CONTROLLER.php */