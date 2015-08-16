<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_home extends CI_Model
{	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function get_home_user($home_table)
	{
		$sql = "SELECT U.id as userId, CONCAT(U.first_name,' ',U.last_name) AS username,U.profile_image,R.image_name FROM ".SITEUSER." AS U  JOIN ".$home_table." AS R ON R.user_id = U.id WHERE status='Active' ORDER BY RAND() LIMIT 0,3";
		
			
		$rs = $this->db->query($sql);
		$res =  "";
		if($rs->num_rows())
		{
			$res = $rs->result_array();
		}
		return $res;
		
	}
	
	public function getEventOfferList($category_id)
	{
		$rec = false;
		$sql = "SELECT * FROM ((SELECT D.deal_id AS ID, D.deal_title AS Title, D.offer_description AS Description, deal_image AS Image, 'deal' AS Type,custom_discount_amount AS discount, custom_discount_type AS dtype 
			FROM ".DEAL_MASTER." AS D
			WHERE D.category_id = '".$category_id."'
			AND D.show_in_home_page = 'Yes'
			)
			UNION
			(SELECT F.fl_id AS ID, F.flyer_title AS Title, F.description AS Description, profile_image AS Image, 'flyer' AS Type, '' AS  discount, '' AS dtype
			FROM ".FLYER_MASTER." AS F
			WHERE F.flyer_cat_id = '".$category_id."'
			AND F.show_in_home_page = 'Yes'
			)) AS Record ORDER BY RAND() LIMIT 0,3
			";
			
		$rs = $this->db->query($sql);
		
		$rec = $rs->result_array();

		return $rec;	
			
	}
	public function getOfferDetails($offer_id){
		$sql = "SELECT DM.*,DM.start_hours_of_operation as start_hour, DM.end_hours_of_operation as end_hour,VD.first_name,VD.last_name,VD.company_name,C.country_name FROM ".DEAL_MASTER." DM
		INNER JOIN ".VENDORDETAILS." VD ON DM.created_by = VD.vendor_id
		LEFT JOIN ".COUNTRY." C ON  C.id= DM.country_id
		WHERE DM.deal_id=".$offer_id."";
		
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec 			= $rs->row();
			if($rec->discount_master_id != ''){
			$sql 			= "SELECT type_name FROM ".DISCOUNT_TYPE." WHERE discount_type_id IN ($rec->discount_master_id)";
			$rs 			= $this->db->query($sql);
			if($rs->num_rows()){
			$rec->discount_details  = $rs->result_array();
			}else{
				$rec->discount_details = '';
			}
			}else{
				$rec->discount_details = '';
			}
			return $rec;
		}
		return false;
	}
	public function get_name_details($id, $type)
	{
		$sql="SELECT distinct(user_id) FROM ".BUCKET_LIST." WHERE privacy!='0' and deal_flyer_id=".$id." and deal_flyer_type='".$type."'";
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec 			= $rs->result_array();
			//pr($rec);
			//return $rec;
			for($i=0;$i<count($rec);$i++)
			{
				$sq2	= "SELECT first_name,last_name FROM ".SITEUSER." WHERE id = ". $rec[$i]['user_id']."";
//				$sql = "SELECT SU.first_name,SU.last_name,SU.profile_image,SU.id FROM ".SITEUSER." SU WHERE SU.id NOT IN (SELECT FR.`friend_user_id` FROM ".FRIEND." FR WHERE FR.`user_id` = ".$user_id." AND FR.request_status != 'Decline'
//UNION
//SELECT FR.`user_id` FROM ".FRIEND." FR WHERE FR.`friend_user_id` = ".$user_id." AND FR.request_status != 'Decline') AND SU.id != ".$user_id." AND (SU.email like '%".$search_val."%' OR SU.first_name like '%".$search_val."%' OR SU.last_name like '%".$search_val."%')";

				$rs2	= $this->db->query($sq2);
				$rec2	= $rs2->result_array();
				
				if(is_array($rec2) && count($rec2) > 0)
				{
					$rec[$i]['first_name'] = $rec2[0]['first_name'];
					$rec[$i]['last_name']  = $rec2[0]['last_name'];
				}
			}
		//pr($rec);
		return $rec;
		//echo $this->db->last_query();
		}
		return false;
	}
	public function getFlyerDetails($flyer_id)
	{
		$sql = "SELECT FM.*,VD.first_name,VD.last_name,VD.company_name,C.country_name FROM ".FLYER_MASTER." FM
		INNER JOIN ".VENDORDETAILS." VD ON FM.vendor_id = VD.vendor_id
		LEFT JOIN ".COUNTRY." C ON  C.id= FM.country_id
		WHERE FM.fl_id=".$flyer_id."";
		
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec 			= $rs->row();
			//pr($rec);
			return $rec;
		}
		return false;
	}
	/**************30.4.2015 Adding Friends Count in Home Page******************/
	public function get_friend_count($userID){
		//return $userID;
		//$this->db->cou(tr_friend);
		$this->db->select('*');
		$this->db->where(array('user_id'=>$userID, 'request_status'=>'Friend'));
		$this->db->from('tr_friend');
		$query = $this->db->get();
		//return $this->db->last_query();
		return $query->num_rows();
		
	}
	
	public function get_top_offers()
	{
		$rec	= false;
		$sql	= "SELECT COUNT(*) AS CNT, `deal_flyer_id` FROM ".BUCKET_LIST." WHERE `deal_flyer_type` = 'deal' GROUP BY deal_flyer_id ORDER BY CNT DESC LIMIT 0,6";
		$rs	= $this->db->query($sql);
		
		$rec	= $rs->result_array();
		
		$arr_result = array();
		$arr_new_result = array();
		$rec3 = array();
		$i=0;$j=0;
		
		foreach($rec as $val)
		{
			$sql1	= "SELECT deal_image,deal_id,created_by, deal_title, city, DATEDIFF(exp_date_of_deal,DATE_FORMAT(NOW(), '%Y-%m-%d')) AS date_diff, custom_discount_amount, custom_discount_type FROM ".DEAL_MASTER." WHERE deal_id = ".$val['deal_flyer_id']." AND exp_date_of_deal >= CURDATE()";
			
			$rs1	= $this->db->query($sql1);
		
			$arr_result[$i]	= $rs1->result_array();
			if(isset($arr_result[$i][0]))
			{
				$sql3 = "SELECT company_name FROM ".VENDORDETAILS." WHERE vendor_id=".$arr_result[$i][0]['created_by']."";
				$rv = $this->db->query($sql3);
				$rec3	= $rv->result_array();	
			}
			
			
			
			$i++;
		}
		
		
		foreach($arr_result as $val1)
		{
			if(is_array($val1) && count($val1) > 0)
			{
				$arr_new_result[$j] = $val1[0];
				$arr_new_result[$j]['CNT']=$rec[$j]['CNT'];
				if(isset($rec3[$j]['company_name']))
				{
					$arr_new_result[$j]['company_name']=$rec3[$j]['company_name'];
				}
				
				$j++;
			}
		}
		//pr($arr_new_result);
		return $arr_new_result;
	}
	
	public function get_gateway_offers($user_id)
	{
		$sql1	= "SELECT sitesettings_value FROM ".SITESETTINGS." WHERE sitesettings_id = '6'";
		$rs1	= $this->db->query($sql1);
	
		$rec1	= $rs1->result_array();
		$offer_price = $rec1[0]['sitesettings_value'];
		
		$sql	= "SELECT deal_image,deal_id,created_by, deal_title, city, DATEDIFF(exp_date_of_deal, DATE_FORMAT(NOW(), '%Y-%m-%d')) AS date_diff, custom_discount_amount, custom_discount_type FROM ".DEAL_MASTER." WHERE zip != (SELECT zip FROM ".SITEUSER." WHERE `id` = ".$user_id.") ";
			
		$rs	= $this->db->query($sql);
	
		$rec	= $rs->result_array();
		
		for($i=0;$i<count($rec);$i++)
		{
			$sq2	= "SELECT COUNT(*) AS CNT FROM ".BUCKET_LIST." WHERE `deal_flyer_type` = 'deal' AND deal_flyer_id = ". $rec[$i]['deal_id']."";
			
			$rs2	= $this->db->query($sq2);
			$rec2	= $rs2->result_array();
			
			$sql3 = "SELECT company_name FROM ".VENDORDETAILS." WHERE vendor_id=".$rec[$i]['created_by']."";
			$rv = $this->db->query($sql3);
			$rec3	= $rv->result_array();
			
			if(is_array($rec2) && count($rec2) > 0)
			{
				$rec[$i]['offer_price'] = $offer_price;
				$rec[$i]['CNT']		= $rec2[0]['CNT'];
				$rec[$i]['company_name'] = $rec3[0]['company_name'];
			}
		}
		
		return $rec;
	}
	
	public function get_categoryid($id,$type)
	{
		if($type == 'flyer')
		{
			$sql = "SELECT flyer_cat_id AS cat_id FROM ".FLYER_MASTER." WHERE fl_id=".$id;
		}
		if($type == 'deal')
		{
			$sql = "SELECT category_id AS cat_id FROM ".DEAL_MASTER." WHERE deal_id=".$id;
		}
		//echo $sql; die();
		$vendor = 0;
		$rs = $this->db->query($sql);
                if($rs->num_rows())
                {
                    $rec = $rs->row_array();
		    $vendor = $rec['cat_id'];
                }
                
                return $vendor;
	}
	public function getCompletedReviewUser(){
		$sql	= "SELECT BL.user_id,CONCAT(SU.first_name,' ',SU.last_name) AS username, BL.deal_flyer_id, SU.profile_image,BL.experince_tips,BL.deal_flyer_type,IF (BL.deal_flyer_type='deal',( SELECT deal_image AS image_name FROM ".DEAL_MASTER." WHERE deal_id=BL.deal_flyer_id),( SELECT profile_image AS image_name FROM ".FLYER_MASTER." WHERE fl_id=BL.deal_flyer_id)) AS images FROM ".BUCKET_LIST." BL INNER JOIN ".SITEUSER." SU ON SU.id=BL.user_id WHERE BL.status = 'Completed' GROUP BY BL.user_id ORDER BY RAND() LIMIT 0,3 ";
		$rs	= $this->db->query($sql);
		$rec 	= false;
		if($rs->num_rows())
                {
			$rec	= $rs->result_array();
		}
		return $rec;
	}
	public function get_total_review(){
		$sql 	= "SELECT COUNT(*) totalReview FROM ".BUCKET_LIST." WHERE status = 'Completed'";
		$rs	= $this->db->query($sql);
		$rec 	= $rs->row_array();
		return $rec['totalReview'];
	}
	
	
	public function deal_list()
	{
		 $sql = "SELECT DM.* FROM ".DEAL_MASTER." AS DM LEFT JOIN ".VENDORDETAILS." AS VD ON DM.created_by = VD.vendor_id WHERE DM.deal_status = 'Active' AND DM.exp_date_of_deal >= CURDATE() AND VD.status = 'Active' LIMIT 0,6";
		
		$rs	= $this->db->query($sql);
		$rec 	= false;
		if($rs->num_rows())
                {
			$rec	= $rs->result_array();
		}
		return $rec;
	}
	
	public function flyer_list()
	{
		$sql = "SELECT FM.* FROM ".FLYER_MASTER." AS FM LEFT JOIN ".VENDORDETAILS." AS VD ON FM. vendor_id = VD.vendor_id WHERE FM.status = 'Active' AND FM.exp_date_flyer >= CURDATE() AND VD.status = 'Active'";
		
		$rs	= $this->db->query($sql);
		$rec 	= false;
		if($rs->num_rows())
                {
			$rec	= $rs->result_array();
		}
		return $rec;
	}
	
}