<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_User extends CI_Model
{ 
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getSingle($email, $password, $remember1,$role_id = '')
	{
		$where = '';
		if($role_id != ''){$where = " AND FIND_IN_SET( `role_id` , '".$role_id."') "; }
		$rec = array();
		$sql = "SELECT u.*
			FROM ".USERMASTER." AS u
			WHERE binary email_id = '".$email."'
			AND binary password = '".$password."' ".$where."
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
			
			$sql = "UPDATE ".USERMASTER." SET last_login_ip_adr = '".$ip_adr."', last_login = NOW() WHERE user_id = '".$rec['user_id']."'";
			$rs2 = $this->db->query($sql);
			
			if($remember1 == 'Yes'){
				setcookie("ucookname", stripslashes($rec['email_id']), time()+60*60*24*100, "/");
				setcookie("ucookpass", stripslashes($rec['password']), time()+60*60*24*100, "/");
				setcookie("ucookfname", stripslashes($rec['first_name']), time()+60*60*24*100, "/");
				setcookie("ucooklname", stripslashes($rec['last_name']), time()+60*60*24*100, "/");
				setcookie("ucookimg", stripslashes($rec['image']), time()+60*60*24*100, "/");
			}
			
			$this->nsession->set_userdata('user_detail', $rec);
			$this->nsession->set_userdata('admin_id', $rec['user_id']);
		}
		//pr($rec);
		return $rec;
	}
	
	public function getUserByEmail($email='') // get user details by email
	{
		$rec = array();
		$sql = "SELECT * FROM ".USERMASTER." WHERE email_id = '".$email."'";
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
			$this->db->where('user_id <> ',$id);
		}else{
			$this->db->where('email_id',$email);
		}	
		$this->db->where('role_id',$type);	
		$query = $this->db->get(USERMASTER);
		
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
			$this->db->where('user_id <> ',$id);
		}else{			
			$this->db->where('first_name',$fname);
			$this->db->where('last_name',$lname);
		}
		$this->db->where('role_id',$type);
		$query = $this->db->get(USERMASTER);		
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
		$where 			= ' WHERE role_id = "'.$type.'" ';
				
		if($search_keyword != ''){
			$where.= " AND (first_name like '%".$search_keyword."%'
					 	OR last_name like '%".$search_keyword."%' 
						OR email_id like '%".$search_keyword."%' 
					   )";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".USERMASTER." ".$where." ";
		//echo $sql; //exit;
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT u.* FROM ".USERMASTER." AS u  ".$where."  LIMIT ".$start.",".$config['per_page'];
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
	
	public function get_single($id){
		$sql = "SELECT * FROM ".USERMASTER." WHERE user_id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();	          
		return $rec;
	}
	public function get_role($id){
		$sql = "SELECT * FROM ".ROLE_MASTER." WHERE role_id = '" . $id . "'";
		$rs = $this->db->query($sql);
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->row_array();
		return $rec;
	}
	
	
	
	public function delete($id){
		$sql = "DELETE FROM ".USERMASTER." WHERE user_id = '".$id."'";
		$this->db->query($sql);
		return true;
	}
	
	public function deleteBatchs(){
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
				$sql = "DELETE FROM ".USERMASTER." WHERE FIND_IN_SET(user_id, '".implode(",", $pagearray)."')";
				$this->db->query($sql);
				return 'delsuccess';
			}
		}
	}	
	
	public function statusBatchs($status){
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
				$sql = "UPDATE ".USERMASTER." 
						SET status = 'active',
						updated_on = NOW()
						WHERE FIND_IN_SET(user_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'active';
			}
			
			if($apply_action == 'Inactivate'){
				$sql = "UPDATE ".USERMASTER." 
						SET status = 'inactive',
						updated_on = NOW()
						WHERE FIND_IN_SET(user_id, '".implode(",", $pagearray)."')";
				//echo $sql; exit;
				$this->db->query($sql);
				return 'inactive';
			}
		}
	}

	
	public function updateUsersProfile($id,$user_image='') {
		$sql_image          = '';
		$first_name 	= strip_tags(addslashes(trim($this->input->get_post('first_name'))));
		$last_name 	= strip_tags(addslashes(trim($this->input->get_post('last_name'))));
    
		$sql_image = '';
                $sql_image = '';
		if($user_image != "")
		{
			$sql_image .= " ,image = '".addslashes(trim($user_image))."'";
		}
		$sql = "UPDATE ".USERMASTER." 
			SET
			first_name = '".$first_name."', 
			last_name = '".$last_name."',
			updated_on = '".date('Y-m-d H:i:s')."'".$sql_image."
			WHERE user_id = '".$id."'";
		
		$this->db->query($sql);
		$sql = "SELECT u.*
			FROM ".USERMASTER." AS u
			WHERE user_id = '".$id."'";
		$rs = $this->db->query($sql);		
		$rec = $rs->row_array();
		$this->nsession->set_userdata('user_detail', $rec);
		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}
        
        public function updateUsersAccount($id) {
		
		
		$email_address 	= strip_tags(addslashes(trim($this->input->get_post('email_address'))));
		$password 	= strip_tags(addslashes(trim($this->input->get_post('password'))));
                
		$sql = "UPDATE ".USERMASTER." 
			SET
			email_id = '".$email_address."',
			password = '".$password."',
			updated_on = '".date('Y-m-d H:i:s')."'
			WHERE user_id = '".$id."'";
		
		$this->db->query($sql);

		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on ws_user insert: ".$sql);
			return false;
		}
		
		return true;
	}

}