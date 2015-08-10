<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_sitesettings extends CI_Model
{
	var $settingTable = 'hw_sitesettings';
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}

	public function getListEmails(&$config,&$start,&$tabId){
			
		$page 		= $this->uri->segment(4,0); //page
		$isSession	= $this->uri->segment(5); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('SITESETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('SITESETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		//if($tabId=='contact')
		//{
		//	
		//   $where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(5,6,12,14)";
		//}
		//elseif($tabId=='seo')
		//{
		//	$where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(2,3,4,24,25,26)";
		//}
		if($tabId=='social')
		{
			$where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(3,4,18,19)";
		}
		elseif($tabId=='site')
		{
			$where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(5,6,8,10,12,13,15,17,7,9,14,16,11)";
		}
		//elseif($tabId=='email')
		//{
		//	$where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(1,13,17,18)";
		//}
		else
		{
		  $where	= " WHERE 1 AND status = 'active' AND sitesettings_id IN(1,2)";
		}
		
		
		
		if($search_keyword != ''){
			$where.= " AND (sitesettings_lebel like '%".$search_keyword."%' OR sitesettings_value like '%".$search_keyword."%' )  ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITESETTINGS." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ".SITESETTINGS.$where."  LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	
	
	
	
	
	
	
	
	
	public function getSingle($id)
	{
		$sql = "SELECT * FROM ".SITESETTINGS." WHERE sitesettings_id = '".$id."'";
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			
		return $rec;		
	}
	
	public function updateOption($id)
	{
		//$sitesettings_lebel 	= $this->input->get_post('sitesettings_lebel');
		$sitesettings_value 	= $this->input->get_post('sitesettings_value');
		
		$sql = "UPDATE ".SITESETTINGS." SET sitesettings_value = '".addslashes(trim($sitesettings_value))."',last_updated_on = CURRENT_TIMESTAMP() WHERE sitesettings_id = '".$id."'";
		
		$this->db->query($sql);
		
		if(!$this->db->affected_rows())
		{
			log_message('error',"Mysql Error on banner insert: ".$sql);
			return false;
		}
		
		return true;
	}
	
	
	public function getList(&$config,&$start){
			
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('SITESETTINGS');
			$search_keyword = trim( $param['search_keyword']);
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= trim( $this->input->get_post('search_keyword',true));
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('SITESETTINGS', $sessionDataArray);		
		
		$start 	= 0;
		$where	= " WHERE 1 AND status = 'active'";
		
		if($search_keyword != ''){
			$where.= " AND (sitesettings_lebel like '%".$search_keyword."%' OR sitesettings_value like '%".$search_keyword."%' )  ";
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".SITESETTINGS." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT * FROM ".SITESETTINGS.$where."  LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
		
	}
	
	
	
}