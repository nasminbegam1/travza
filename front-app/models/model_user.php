<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_user extends CI_Model
{
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function getUserDetails($user_id){
		
		//$sql 	= "SELECT SU.*,TT.type_name FROM ".SITEUSER." SU LEFT JOIN ".TRAVELERTYPES." TT ON SU.traveler_type = TT.id WHERE SU.id=".$user_id."";
		$sql 	= "SELECT SU.* FROM ".SITEUSER." SU WHERE SU.id=".$user_id."";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		    $row = $query->row();
		    return $row;
		}else{
			
		    return true;
		}
	}
	
	public function getTypeDetails($type)
	{
		$sql 	= "SELECT type_name FROM ".TRAVELERTYPES."  WHERE id IN (".$type.")";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0){
		    $row = $query->result_array();
		    return $row;
		}else{
			
		    return true;
		}
		
	}
	
}

