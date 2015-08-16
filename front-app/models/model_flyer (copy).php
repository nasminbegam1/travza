<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_flyer extends CI_Model
{
	
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function getFlyerDetails($logged_vendor_id,$flyer_slug){
		
		$sql = "SELECT fl.*,flc.name,flc.id as flyer_cat_id,c.country_name,c.id FROM ".FLYER_MASTER." AS fl
		       LEFT JOIN ".CATEGORY_MASTER." AS flc ON fl.flyer_cat_id = flc.id LEFT JOIN ".COUNTRY." AS c ON fl.country_id = c.id
                       WHERE fl.flyer_slug='".$flyer_slug."' AND fl.vendor_id=".$logged_vendor_id;
                $rec = FALSE;
                $rs = $this->db->query($sql);
                if($rs->num_rows())
                {
                    $rec = $rs->result_array();
                }
                else
                {
                    $rec = FALSE;
                }
                return $rec;
                    
	}
	
	public function get_vendorid($id,$type)
	{
		if($type == 'flyer')
		{
			$sql = "SELECT vendor_id AS vendor FROM ".FLYER_MASTER." WHERE fl_id=".$id;
		}
		if($type == 'deal')
		{
			$sql = "SELECT created_by AS vendor FROM ".DEAL_MASTER." WHERE deal_id=".$id;
		}
		//echo $sql; die();
		$vendor = 0;
		$rs = $this->db->query($sql);
                if($rs->num_rows())
                {
                    $rec = $rs->row_array();
		    $vendor = $rec['vendor'];
                }
                
                return $vendor;
	}
	
}
