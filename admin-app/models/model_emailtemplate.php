<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_emailtemplate extends CI_Model
{
	 //var $emailTable 	= 'hw_email_template';
	
	public function __construct()
	{
	    // Call the Model constructor
	    parent::__construct();
	}
	
	public function getList(&$config,&$start)
	{		
		$page 		= $this->uri->segment(3,0); //page
		$isSession	= $this->uri->segment(4); // read data from SESSION or POST     (1 == POST , 0 = SESSION )
		
		$start 		= 0;
		$search_keyword	= '';
		$per_page	= '';
		
		if($this->input->get_post('search_keyword') == '' && $this->input->get_post('per_page') == '')
		{	$param		= $this->nsession->userdata('EMAIL_SEARCH');
			$search_keyword = $param['search_keyword'];
			$per_page 	= $param['per_page'];
		}
		else {
			$search_keyword	= $this->input->get_post('search_keyword',true);
			$per_page 	= $this->input->get_post('per_page',true);	
		}
		$search_keyword = trim($search_keyword);
		$sessionDataArray 			= array();
		$sessionDataArray['search_keyword'] 	= $search_keyword;
		$sessionDataArray['page']		= $page;		
		$sessionDataArray['per_page'] 		= $per_page;
		
		$search_keyword	= mysql_real_escape_string($search_keyword);
		
		if($per_page)
			$config['per_page'] = $per_page;
		$config['page'] = $page;
		
		$this->nsession->set_userdata('EMAIL_SEARCH', $sessionDataArray);		
		
		$start 	= 0;
		$where	= ' WHERE 1 ';
		
		if($search_keyword != ''){
			$where.= " AND template_name like '%".$search_keyword."%' OR email_subject like '%".$search_keyword."%'";
                        
		}
		
		$sql=" SELECT COUNT(*) as TotalrecordCount FROM ".EMAILTEMPLATE." ".$where." ";
		
		$rs = $this->db->query($sql);		
		$config['total_rows'] = 0;
		
		$rec = $rs->row_array();
		$config['total_rows'] = $rec['TotalrecordCount'];
		
		if($page > 0 && $page < $config['total_rows'] )
			$start = $page;
		
		$config['start'] = $start;
		$sql = "SELECT template_id, template_name, responce_email, email_subject,template_status
			FROM ".EMAILTEMPLATE.$where."
			LIMIT ".$start.",".$config['per_page'];
		
		$rs = $this->db->query($sql);
		
		$rec = false;
		
		if($rs->num_rows())
			$rec = $rs->result_array();
			          
		return $rec;
	}
	
	public function updateStatus($tableName, $idArr, $updateArr)
	{
	 
	 
	        $ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{
		      $this->db->update($tableName, $updateArr, $idArr);
		      $rs = $this->db->query($sql);
			
			$ret = $this->db->affected_rows();
		}
		return $ret;
	 
	 
	}
}
?>