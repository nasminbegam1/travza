<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_Adminuser extends CI_Model
{
	var $adminUser = 'tr_adminuser'; 
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getSingle($email, $password, $remember1)
	{
		$rec = array();
		$sql = "SELECT u.*
			FROM ".ADMINUSER." AS u
			WHERE binary email_id = '".$email."'
			AND binary password = '".$password."' 
			";
		//echo $sql;exit;
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();		
		if($rs->num_rows())
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			  $ip_adr = $_SERVER['HTTP_CLIENT_IP'];
			}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			  $ip_adr = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
			  $ip_adr = $_SERVER['REMOTE_ADDR'];
			}
			
			$sql = "UPDATE ".ADMINUSER." SET last_login_ip_adr = '".$ip_adr."', last_login = NOW() WHERE admin_id = '".$rec['admin_id']."'";
			$rs2 = $this->db->query($sql);
			
			if($remember1 == 'Yes'){
				setcookie("ucookname", stripslashes($rec['email_id']), time()+60*60*24*100, "/");
				setcookie("ucookpass", stripslashes($rec['password']), time()+60*60*24*100, "/");
				setcookie("ucookfname", stripslashes($rec['first_name']), time()+60*60*24*100, "/");
				setcookie("ucooklname", stripslashes($rec['last_name']), time()+60*60*24*100, "/");
				setcookie("ucookimg", stripslashes($rec['image']), time()+60*60*24*100, "/");
				setcookie("ucookimg", stripslashes($rec['image']), time()+60*60*24*100, "/");
			}
			
			$this->nsession->set_userdata('admin_id', $rec['admin_id']);
			$this->nsession->set_userdata('admin_email', $rec['email_id']);
			$this->nsession->set_userdata('role', $rec['role']);
			$this->nsession->set_userdata('user_image', $rec['image']);
			$this->nsession->set_userdata('first_name', $rec['first_name']);
			$this->nsession->set_userdata('last_name', $rec['last_name']);
			$rec = $rs->result_array();
			//pr($this->nsession->all_userdata());
			//session_start();
			//$_SESSION['session_id'] = session_id();
		}
				
		return $rec;
	}
	
	public function getUserByEmail($email='') // get user details by email
	{
		$rec = array();
		$sql = "SELECT * FROM ".ADMINUSER." WHERE email_id = '".$email."'";
		$rs  = $this->db->query($sql);
		$rec = $rs->row_array();
		if($rs->num_rows())
		{
			$rec = $rs->result_array();
		}
		return $rec;
	}

	
	public function get_email_existence($email, $id, $type='admin'){
		if($id > 0){
			
			$this->db->where('email_id',$email);
			$this->db->where('admin_id <> ',$id);
		}else{
			$this->db->where('email_id',$email);
		}	
		$this->db->where('role',$type);	
		$query = $this->db->get($this->adminUser);
		
		if ($query->num_rows() > 0){
		    return false;
		}else{
			
		    return true;
		}
	}
	
	public function checkNamePairExists($lname, $id, $type = 'admin'){
		$fname 	= strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		if($id > 0){
			$this->db->where('first_name',$fname);
			$this->db->where('last_name',$lname);
			$this->db->where('admin_id <> ',$id);
		}else{			
			$this->db->where('first_name',$fname);
			$this->db->where('last_name',$lname);
		}
		$this->db->where('role',$type);
		$query = $this->db->get($this->adminUser);		
		if ($query->num_rows() > 0){
		    return false;
		}else{
		    return true;
		}
	}
	
	public function get_list(&$config,&$start, $type = 'admin'){
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
				$param			= $this->nsession->userdata('ADMIN_USER');
			else if($type == 'agent')
				$param = $this->nsession->userdata('AGENT');
			//else if($type == 'rental')
			//	$param			= $this->nsession->userdata('RENTAL_USER');
			else
				$param			= $this->nsession->userdata('VA_USER');
				
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 		= $page;		
		$sessionDataArray['per_page'] 			= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
			$this->nsession->set_userdata('ADMIN_USER', $sessionDataArray);
		else if($type == 'agent')
			$this->nsession->set_userdata('AGENT', $sessionDataArray);
			//else if($type == 'rental')
			//	$this->nsession->set_userdata('RENTAL_USER', $sessionDataArray);	
		else
			$this->nsession->set_userdata('VA_USER', $sessionDataArray);
		
		$start 			= 0;
		$where 			= ' WHERE role = "'.$type.'" ';
				
		if($search_keyword != ''){
			$where.= " AND (first_name like '%".$search_keyword."%'
					 	OR last_name like '%".$search_keyword."%' 
						OR email_id like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".ADMINUSER." ".$where." ";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT u.* FROM ".ADMINUSER." AS u  ".$where."  LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	
        public function get_siteuserlist(&$config,&$start, $type = 'admin')
	{
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
			{
				$param			= $this->nsession->userdata('SITE_USER');
			}
			
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 		= $page;		
		$sessionDataArray['per_page'] 			= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
		{
			$this->nsession->set_userdata('SITE_USER', $sessionDataArray);
		}
		
		$start 			= 0;
		$where	= ' WHERE 1 ';
				
		if($search_keyword != ''){
			$where.= " AND (su.first_name like '%".$search_keyword."%'
					 	OR su.last_name like '%".$search_keyword."%' 
						OR su.email like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITEUSER." AS su ".$where." ";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT su.*,c.country_name FROM ".SITEUSER." AS su  LEFT JOIN ".COUNTRY." AS c ON su.country = c.id".$where."  LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function addAdminUsers($user_image='', $type = 'admin') {
		$image_name = '';    
		if($user_image != '')
		{
		    $image_name = $user_image;
		}
            
		$first_name     = strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		$last_name      = strip_tags(addslashes(trim($this->input->get_post('last_name'))));
		$email_address  = strip_tags(addslashes(trim($this->input->get_post('email_address'))));
		$password       = strip_tags(addslashes(trim($this->input->get_post('password'))));
		$role_id        = $type;
		
		$phone_no 	= strip_tags(addslashes(trim($this->input->get_post('phone_no'))));
		$skype_id 	= strip_tags(addslashes(trim($this->input->get_post('skype_id'))));
		if(isset($phone_no) && $phone_no!= '')
			$phone_no = $phone_no;
		else
			$phone_no = '';
			
		if(isset($skype_id) && $skype_id!= '')
			$skype_id = $skype_id;
		else
			$skype_id = '';

		$sql = "INSERT INTO `".ADMINUSER."` 
			SET
			first_name = '".$first_name."', 
			last_name = '".$last_name."',
			phone_no = '".$phone_no."', 
			skype_id = '".$skype_id."',
			email_id = '".$email_address."', 
			password = '".$password."', 
			image    = '".$image_name."',
			role = '".$role_id."'";
		
		
		$this->db->query($sql);
		return true;
	}
	
	public function get_single($id){
		$sql = "SELECT * FROM ".ADMINUSER." WHERE admin_id = '" . $id . "'";
		//echo $sql;exit;
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		//pr($rec);	          
		return $rec;
	}
	
	public function get_site_user_single($id){
		
		$sql = "SELECT su.*,c.country_name FROM ".SITEUSER." AS su  LEFT JOIN ".COUNTRY." AS c ON su.country = c.id WHERE su.id = '".$id."'";
		
		//echo $sql;exit;
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
		//pr($rec);	          
		return $rec;
	}
	
	public function updateAdminUsers($id, $user_image='', $type = 'admin') {
		$sql_image          = '';
		$first_name 	= strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		$last_name 	= strip_tags(addslashes(trim($this->input->get_post('last_name'))));
		$email_address 	= strip_tags(addslashes(trim($this->input->get_post('email_address'))));
		$password 	= strip_tags(addslashes(trim($this->input->get_post('password'))));
		
		$phone_no 	= strip_tags(addslashes(trim($this->input->get_post('phone_no'))));
		$skype_id 	= strip_tags(addslashes(trim($this->input->get_post('skype_id'))));
		if(isset($phone_no) && $phone_no!= '')
			$phone_no = $phone_no;
		else
			$phone_no = '';
			
		if(isset($skype_id) && $skype_id!= '')
			$skype_id = $skype_id;
		else
			$skype_id = '';
		
		$role_id        = $type;
    
		$sql_image = '';
		if($user_image != "")
		{
			$sql_image .= " ,image = '".addslashes(trim($user_image))."'";
		}
		
		$sql = "UPDATE ".ADMINUSER." 
			SET
			first_name = '".$first_name."', 
			last_name = '".$last_name."',
			phone_no = '".$phone_no."', 
			skype_id = '".$skype_id."',
			role = '".$role_id."',
			email_id = '".$email_address."',
			password = '".$password."'".$sql_image.",
			updated_on = '".date('Y-m-d H:i:s')."'
			WHERE admin_id = '".$id."'";
		
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
	
	public function deleteAdminUser($id){
		$sql = "DELETE FROM ".ADMINUSER." WHERE admin_id = '".$id."'";
		$this->db->query($sql);
		return true;
	}
	
	public function deleteBatchAdminUsers(){
		$error		= false;
		$apply_action	= $this->input->get_post('group_mode');
		$pagearray	= $this->input->get_post('page');
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($apply_action)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){
			if($apply_action == 'Delete'){
				$sql = "DELETE FROM ".ADMINUSER." WHERE FIND_IN_SET(admin_id, '".implode(",", $pagearray)."')";
				$this->db->query($sql);
				return 'delsuccess';
			}
		}
	}	
	
	public function statusBatchAdminUsers($status){
		$error			= false;
		$apply_action	= $this->input->get_post('group_mode',true);
		$pagearray		= $this->input->get_post('page',true);		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($apply_action)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){
			if($apply_action == 'Activate'){
				$sql = "UPDATE ".ADMINUSER." 
						SET status = 'active',
						updated_on = NOW()
						WHERE FIND_IN_SET(admin_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'active';
			}
			
			if($apply_action == 'Inactivate'){
				$sql = "UPDATE ".ADMINUSER." 
						SET status = 'inactive',
						updated_on = NOW()
						WHERE FIND_IN_SET(admin_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'inactive';
			}
		}
	}
	
	public function checkAccessPage($access_page_id){
		$mId = explode(',',$this->nsession->userdata('menu_ids'));
		
		if($this->nsession->userdata('menu_ids') == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
	
	public function get_social_list(&$config,&$start){
	
	$type			= '';
	$page 			= $this->uri->segment(3,0); //page
	$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
	
	$start = 0;
	
	$search_keyword	= '';//$this->input->get_post('search_keyword',true);
	$per_page 		= '';//$this->input->get_post('per_page',true);		
	
	if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
	{	
		if($type == 'sales')
			$param			= $this->nsession->userdata('SALES_USER');
		else if($type == 'rental')
			$param			= $this->nsession->userdata('RENTAL_USER');
		else
			$param			= $this->nsession->userdata('ADMIN_USER');
			
		$search_keyword 	= trim( $param['search_keyword']);
		$per_page 		= $param['per_page'];
	}
	else {
		$search_keyword		= trim( $this->input->get_post('search_keyword',true));
		$per_page 		= $this->input->get_post('per_page',true);	
	}
	
	$sessionDataArray = array();
	$sessionDataArray['search_keyword'] 		= $search_keyword;
	$sessionDataArray['page']	 		= $page;		
	$sessionDataArray['per_page'] 			= $per_page;
	
	$search_keyword	= mysql_real_escape_string($search_keyword);
	
	if($per_page)
		$config['per_page'] = $per_page;
	$config['page'] = $page;
	
	if($type == 'sales')
			$this->nsession->set_userdata('SALES_USER', $sessionDataArray);	
		else if($type == 'rental')
			$this->nsession->set_userdata('RENTAL_USER', $sessionDataArray);	
		else
			$this->nsession->set_userdata('ADMIN_USER', $sessionDataArray);
	
	$start 			= 0;
	//$where 			= ' WHERE role = "'.$type.'" ';
	
	$where	=	'';		
	if($search_keyword != ''){
		$where.= " WHERE `provider` LIKE '%".$search_keyword."%' OR `email` LIKE '%".$search_keyword."%' OR `first_name` LIKE '%".$search_keyword."%' OR `last_name` LIKE '%".$search_keyword."%' ";
	}
	
	$sql=" SELECT COUNT(*) as TotalrecordCount FROM lp_social_members ".$where;
	//echo $sql; //exit;
	$rs = $this->db->query($sql);		
	$config['total_rows'] = 0;
	
	$rec = $rs->row_array();
	$config['total_rows'] = $rec['TotalrecordCount'];
	
	if($page > 0 && $page < $config['total_rows'] )
		$start = $page;
	
	$config['start'] = $start;
	$sql = "SELECT u.* FROM lp_social_members AS u ".$where." ORDER BY `db_add_date` DESC LIMIT ".$start.",".$config['per_page'];
	//echo $sql; exit;
	$rs = $this->db->query($sql);
	//echo $this->db->last_query(); die;
	$rec = false;
	
	if($rs->num_rows())
		$rec = $rs->result_array();
			  
	return $rec;
}


	public function getEnquiryByDate($table,$field,$condition)
	{
		//echo $table."----".$field."-----".$condition;
		$sql = "SELECT COUNT(*) as total_enquiry,".$field." FROM ".$table." WHERE ".$condition." GROUP BY DATE(added_on)";
		$rs  = $this->db->query($sql);
		$rec = $rs->result_array();
		
		return $rec;
	}
	
	public function get_siteemail_existence($email, $id){
		if($id > 0){
			
			$this->db->where('email',$email);
			$this->db->where('id <> ',$id);
		}else{
			$this->db->where('email',$email);
		}	
		
		$query = $this->db->get(SITEUSER);
		
		if ($query->num_rows() > 0){
		    return false;
		}else{
			
		    return true;
		}
	}
	
	public function checkSiteNamePairExists($lname, $id){
		$fname 	= strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		if($id > 0){
			$this->db->where('first_name',$fname);
			$this->db->where('last_name',$lname);
			$this->db->where('id <> ',$id);
		}else{			
			$this->db->where('first_name',$fname);
			$this->db->where('last_name',$lname);
		}
		
		$query = $this->db->get(SITEUSER);		
		if ($query->num_rows() > 0){
		    return false;
		}else{
		    return true;
		}
	}
	
	public function get_country_list()
	{
		$rec = false;
		$sql = "SELECT c.* FROM ".COUNTRY." AS c ORDER BY country_name ASC";
		$rs  = $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec;
	}
	
	public function get_vendor_list()
	{
		$rec = false;
		$sql = "SELECT * FROM ".VENDORDETAILS;
		$rs  = $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec;
	}
	
	
	public function deleteSiteUser($siteUserId)
	{
		$sql = "DELETE FROM ".SITEUSER." WHERE id = '".$siteUserId."'";
		$this->db->query($sql);
		return true;
	}
	
	public function get_event_user_list(&$config,&$start, $type = 'admin')
	{
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
			{
				$param			= $this->nsession->userdata('SITE_USER');
			}
			
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 	= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
		{
			$this->nsession->set_userdata('SITE_USER', $sessionDataArray);
		}
		
		$start 			= 0;
		$where	= ' WHERE 1 AND B.category_id = 4 ';
				
		if($search_keyword != ''){
			$where.= " AND (SU.first_name like '%".$search_keyword."%'
					 	OR SU.last_name like '%".$search_keyword."%' 
						OR SU.email like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".HOME_USER." AS HU ON B.user_id = HU.user_id
			".$where." GROUP BY B.user_id";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT SU.*, HU.image_name FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".HOME_USER." AS HU ON B.user_id = HU.user_id
			".$where."
			GROUP BY B.user_id
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function get_travel_user_list(&$config,&$start, $type = 'admin')
	{
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
			{
				$param			= $this->nsession->userdata('SITE_USER');
			}
			
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 	= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
		{
			$this->nsession->set_userdata('SITE_USER', $sessionDataArray);
		}
		
		$start 			= 0;
		$where	= ' WHERE 1 AND B.category_id = 1 ';
				
		if($search_keyword != ''){
			$where.= " AND (SU.first_name like '%".$search_keyword."%'
					 	OR SU.last_name like '%".$search_keyword."%' 
						OR SU.email like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".HOME_USER." AS HU ON B.user_id = HU.user_id
			".$where." GROUP BY B.user_id";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT SU.*, HU.image_name FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".HOME_USER." AS HU ON B.user_id = HU.user_id
			".$where."
			GROUP BY B.user_id
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	/*************************23.4.2015********************************/
	public function get_home_user_list(&$config,&$start, $type = 'admin', $category_id)
	{
		
		$page 			= $this->uri->segment(3,0); //page
		$isSession 		= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start = 0;
		
		$search_keyword	= '';//$this->input->get_post('search_keyword',true);
		$per_page 		= '';//$this->input->get_post('per_page',true);		
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	
			if($type == 'admin')
			{
				$param			= $this->nsession->userdata('SITE_USER');
			}
			
			$search_keyword = trim( $param['search_keyword']);
			$per_page 		= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 		= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray = array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']	 	= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		if($type == 'admin')
		{
			$this->nsession->set_userdata('SITE_USER', $sessionDataArray);
		}
		
		$start 			= 0;
		$where	= ' WHERE 1 AND B.category_id = 3 ';
		//$where.=" AND HU.category_flag='Restaurants' ";		
		if($search_keyword != ''){
			$where.= " AND (SU.first_name like '%".$search_keyword."%'
					 	OR SU.last_name like '%".$search_keyword."%' 
						OR SU.email like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".$this->imageTable." AS HU ON B.user_id = HU.user_id
			".$where." GROUP BY B.user_id";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		if(isset($rec['TotalrecordCount'])){
		$config['total_rows'] = $rec['TotalrecordCount'];
		}
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT SU.*, HU.image_name FROM ".SITEUSER." AS SU
			LEFT JOIN ".BUCKET_LIST." AS B ON SU.id = B.user_id
			LEFT JOIN ".$this->imageTable." AS HU ON B.user_id = HU.user_id
			".$where."
			GROUP BY B.user_id
			LIMIT ".$start.",".$config['per_page'];
		//echo $sql; exit;
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); die;
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	/*****************************************************************/

}