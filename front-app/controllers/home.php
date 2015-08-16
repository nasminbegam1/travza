<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	var $flyerMasterTable	= 'tr_flyer_master';
	var $bannerMasterTable	= 'tr_banner_master';
	var $dealMasterTable	= 'tr_deal_master';
	var $bucketMasterTable	= 'tr_bucket_list';
	var $settingsTable	= 'tr_sitesettings';
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('model_basic');
		$this->load->model('model_flyer');
		$this->load->model('model_home');
		$this->load->model('model_friend');
		$this->table_view	= 'tr_flyer_offer_view';
	}

	public function index()
	{
		 $this->data		= '';		
		 $this->data['errmsg']  = $this->nsession->userdata('errmsg');
		 $this->data['succmsg']  = $this->nsession->userdata('succmsg');
		 $this->nsession->unset_userdata('errmsg');
		 $this->nsession->unset_userdata('succmsg');
		
		 
		$this->data['banner_list'] = $this->model_basic->getValues_conditions($this->bannerMasterTable,'*',''," banner_status = 'active'");
		$this->data['sitesettings_list'] = $this->model_basic->getValues_conditions($this->settingsTable,'*',''," sitesettings_id in (5,6) AND status = 'active'");
		$rec = array();
		if (isset($this->data['sitesettings_list'])){
		    foreach ($this->data['sitesettings_list'] as $row){
			
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];	
			$this->data['offer_value'] = $rec;
		    }

		}
		$user_id =  $this->nsession->userdata('user_id');
		if($user_id>0)
		{
			$this->data['gateway_offers'] = $this->model_home->get_gateway_offers($user_id);
			//pr($this->data['gateway_offers']);
		}
		$this->data['top_offers'] = $this->model_home->get_top_offers();
		//pr($this->data['top_offers']);
		//$this->data['deal_list'] = $this->model_basic->getValues_conditions($this->dealMasterTable,'*',''," deal_status = 'Active' AND exp_date_of_deal >= CURDATE() LIMIT 0,6");
		
		$this->data['deal_list'] = $this->model_home->deal_list();
		//pr($this->data['deal_list']);
		if(isset($this->data['deal_list']) && $this->data['deal_list'] != '')
		{
			foreach($this->data['deal_list'] as $key => $deal_bucket)
			{
				$this->data['deal_list'][$key]['deal_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$deal_bucket['deal_id'] ." AND deal_flyer_type = 'deal' ");
				$companyName = $this->model_basic->getValues_conditions(VENDORDETAILS,array('company_name'),'',"vendor_id=".$deal_bucket['created_by']);
					
				$this->data['deal_list'][$key]['company_name'] = $companyName[0]['company_name'];
				
			}
		}
		
		//$this->data['flyer_list'] = $this->model_basic->getValues_conditions($this->flyerMasterTable,'*',''," status = 'Active' AND exp_date_flyer >= CURDATE()");
		
		$this->data['flyer_list'] = $this->model_home->flyer_list();
		
		//pr($this->data['flyer_list']);
		
		if(isset($this->data['flyer_list']) && $this->data['flyer_list'] != '')
		{
			foreach($this->data['flyer_list'] as $key => $flyer_bucket)
			{
				$this->data['flyer_list'][$key]['flyer_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$flyer_bucket['fl_id'] ." AND deal_flyer_type = 'flyer' ");
				$companyName = $this->model_basic->getValues_conditions(VENDORDETAILS,array('company_name'),'',"vendor_id=".$flyer_bucket['vendor_id']);
					
				$this->data['flyer_list'][$key]['company_name'] = $companyName[0]['company_name'];
				
			}
		}
		
		
		$this->data['total_review'] = $this->model_home->get_total_review();
		//$this->data['local_user'] = $this->model_home->get_home_user(LOCATION_USER);
		$this->data['local_user'] = $this->model_home->getCompletedReviewUser();
		//echo $this->db->last_query();
		$this->templatelayout->get_header();
		$this->templatelayout->get_homepage_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']	= 'home/index';			
		$this->elements_data['middle'] 	= $this->data;	
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	public function event_index()
	{
		
		 $this->data		= '';		
		 $this->data['errmsg']  = $this->nsession->userdata('errmsg');
		 $this->data['succmsg']  = $this->nsession->userdata('succmsg');
		 $this->nsession->unset_userdata('errmsg');
		 $this->nsession->unset_userdata('succmsg');
		 
		$this->data['banner_list'] = $this->model_basic->getValues_conditions($this->bannerMasterTable,'*',''," banner_status = 'active'");
		$this->data['sitesettings_list'] = $this->model_basic->getValues_conditions($this->settingsTable,'*',''," sitesettings_id in (5,6) AND status = 'active'");
		$rec = array();
		if (isset($this->data['sitesettings_list'])){
		    foreach ($this->data['sitesettings_list'] as $row){
			
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];	
			$this->data['offer_value'] = $rec;
		    }

		}
		
		$user_id =  $this->nsession->userdata('user_id');
		if($user_id>0)
		{
			$this->data['gateway_offers'] = $this->model_home->get_gateway_offers($user_id);
		}
		
		$this->data['top_offers'] = $this->model_home->get_top_offers();
		$this->data['deal_list'] = $this->model_basic->getValues_conditions($this->dealMasterTable,'*',''," deal_status = 'Active' AND exp_date_of_deal >= CURDATE() ");
		
		if(isset($this->data['deal_list']) && $this->data['deal_list'] != '')
		{
			foreach($this->data['deal_list'] as $key => $deal_bucket)
			{
				$this->data['deal_list'][$key]['deal_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$deal_bucket['deal_id'] ." AND deal_flyer_type = 'deal' ");
				
			}
		}
		
		$this->data['flyer_list'] = $this->model_basic->getValues_conditions($this->flyerMasterTable,'*',''," status = 'Active' AND exp_date_flyer >= CURDATE() AND flyer_cat_id = 4");
		
		if(isset($this->data['flyer_list']) && $this->data['flyer_list'] != '')
		{
			foreach($this->data['flyer_list'] as $key => $flyer_bucket)
			{
				$this->data['flyer_list'][$key]['flyer_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$flyer_bucket['fl_id'] ." AND deal_flyer_type = 'flyer' ");
				
			}
		}
		
		$this->data['event_user'] = $this->model_home->get_home_user(EVENT_USER);
		//pr($this->data);
		$this->templatelayout->get_header();
		$this->templatelayout->get_homepage_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']	= 'home/event_index';			
		$this->elements_data['middle'] 	= $this->data;	
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function restaurants_index()
	{
		 $this->data		= '';		
		 $this->data['errmsg']  = $this->nsession->userdata('errmsg');
		 $this->data['succmsg']  = $this->nsession->userdata('succmsg');
		 $this->nsession->unset_userdata('errmsg');
		 $this->nsession->unset_userdata('succmsg');
		 
		$this->data['banner_list'] = $this->model_basic->getValues_conditions($this->bannerMasterTable,'*',''," banner_status = 'active'");
		$this->data['sitesettings_list'] = $this->model_basic->getValues_conditions($this->settingsTable,'*',''," sitesettings_id in (5,6) AND status = 'active'");
		$rec = array();
		if (isset($this->data['sitesettings_list'])){
		    foreach ($this->data['sitesettings_list'] as $row){
			
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];	
			$this->data['offer_value'] = $rec;
		    }

		}
		
		$user_id =  $this->nsession->userdata('user_id');
		if($user_id>0)
		{
			$this->data['gateway_offers'] = $this->model_home->get_gateway_offers(3,$user_id);
		}
		$this->data['top_offers'] = $this->model_home->get_top_offers(3);
		$this->data['deal_list'] = $this->model_basic->getValues_conditions($this->dealMasterTable,'*',''," deal_status = 'Active' AND exp_date_of_deal >= CURDATE() AND category_id = 3");
		
		if(isset($this->data['deal_list']) && $this->data['deal_list'] != '')
		{
			foreach($this->data['deal_list'] as $key => $deal_bucket)
			{
				$this->data['deal_list'][$key]['deal_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$deal_bucket['deal_id'] ." AND deal_flyer_type = 'deal' ");
				
			}
		}
		
		$this->data['flyer_list'] = $this->model_basic->getValues_conditions($this->flyerMasterTable,'*',''," status = 'Active' AND exp_date_flyer >= CURDATE() AND flyer_cat_id = 3");
		
		if(isset($this->data['flyer_list']) && $this->data['flyer_list'] != '')
		{
			foreach($this->data['flyer_list'] as $key => $flyer_bucket)
			{
				$this->data['flyer_list'][$key]['flyer_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$flyer_bucket['fl_id'] ." AND deal_flyer_type = 'flyer' ");
				
			}
		}
		
		$this->data['restaurant_user'] = $this->model_home->get_home_user(RESTAURANT_USER);		

		$this->templatelayout->get_header();
		$this->templatelayout->get_homepage_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']	= 'home/restaurants_index';			
		$this->elements_data['middle'] 	= $this->data;	
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	public function travel_index()
	{
		 $this->data		= '';		
		 $this->data['errmsg']  = $this->nsession->userdata('errmsg');
		 $this->data['succmsg']  = $this->nsession->userdata('succmsg');
		 $this->nsession->unset_userdata('errmsg');
		 $this->nsession->unset_userdata('succmsg');
		 
		$this->data['banner_list'] = $this->model_basic->getValues_conditions($this->bannerMasterTable,'*',''," banner_status = 'active'");
		$this->data['sitesettings_list'] = $this->model_basic->getValues_conditions($this->settingsTable,'*',''," sitesettings_id in (5,6) AND status = 'active'");
		$rec = array();
		if (isset($this->data['sitesettings_list'])){
		    foreach ($this->data['sitesettings_list'] as $row){
			
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];	
			$this->data['offer_value'] = $rec;
		    }

		}
		
		$user_id =  $this->nsession->userdata('user_id');
		if($user_id>0)
		{
			$this->data['gateway_offers'] = $this->model_home->get_gateway_offers(1,$user_id);
		}
		$this->data['top_offers'] = $this->model_home->get_top_offers(1);
		$this->data['deal_list'] = $this->model_basic->getValues_conditions($this->dealMasterTable,'*',''," deal_status = 'Active' AND exp_date_of_deal >= CURDATE() AND category_id = 1");
		
		if(isset($this->data['deal_list']) && $this->data['deal_list'] != '')
		{
			foreach($this->data['deal_list'] as $key => $deal_bucket)
			{
				$this->data['deal_list'][$key]['deal_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$deal_bucket['deal_id'] ." AND deal_flyer_type = 'deal' ");
				
			}
		}
		
		$this->data['flyer_list'] = $this->model_basic->getValues_conditions($this->flyerMasterTable,'*',''," status = 'Active' AND exp_date_flyer >= CURDATE() AND flyer_cat_id = 1");
		
		if(isset($this->data['flyer_list']) && $this->data['flyer_list'] != '')
		{
			foreach($this->data['flyer_list'] as $key => $flyer_bucket)
			{
				$this->data['flyer_list'][$key]['flyer_count'] = $this->model_basic->isRecordExist($this->bucketMasterTable," deal_flyer_id = ".$flyer_bucket['fl_id'] ." AND deal_flyer_type = 'flyer' ");
				
			}
		}
		
		$this->data['travel_user'] = $this->model_home->get_home_user(TRAVEL_USER);

		$this->templatelayout->get_header();
		$this->templatelayout->get_homepage_footer();
		$this->layout->setLayout('layout_inner');
		$this->elements['middle']	= 'home/travel_index';			
		$this->elements_data['middle'] 	= $this->data;	
		$this->layout->multiple_view($this->elements,$this->elements_data);
		
	}
	
	
	
	public function add_to_cart()
	{
		$deal_flyer_id = $this->input->post('deal_flyer_id');
		$user_id = $this->input->post('user_id');
		$type	 = $this->input->post('type');
		$conditions	= "user_id = '".$user_id."' AND deal_flyer_type = '".$type."' AND deal_flyer_id = '".$deal_flyer_id."'";
		$this->data['bucket_cnt'] = $this->model_basic->isRecordExist($this->bucketMasterTable, $conditions);
		$vendo_id = $this->model_flyer->get_vendorid($deal_flyer_id,$type);
		$cat_id = $this->model_home->get_categoryid($deal_flyer_id,$type);
		
		if($this->data['bucket_cnt'] > 0)
		{
			echo "exist";
		}
		else
		{
			$dataArr= array("user_id"		=> $user_id,
					"vendor_id"		=> $vendo_id,
					"category_id"		=> $cat_id,
					"deal_flyer_type"	=> $type,
					"deal_flyer_id"		=> $deal_flyer_id,
					"added_date"		=> date("Y-m-d h:i:s")
					);
			$this->model_basic->insertIntoTable($this->bucketMasterTable, $dataArr);
			echo "not-exist";
		}
		
	}

	public function view_offer(){
		$user_id =  $this->nsession->userdata('user_id');
		$offer_id 		= $this->input->post('offer_id');
		
		$data['offer_details'] 	= $this->model_home->getOfferDetails($offer_id);
		if($user_id>0){
			//$sql = "UPDATE ".$this->dealMasterTable." SET view_count = view_count +1 WHERE deal_id =".$offer_id;
			//$sql = "Insert into ".$this->table_view."";
			//insertIntoTable($tableName,$insertArr)
			$dataArr= array("flyer_offer_type"	=> 'deal',
					"flyer_offer_id"	=> $offer_id,
					"user_id"		=> $user_id,
					"date_time"		=> date("Y-m-d h:i:s")
					);
			$this->model_basic->insertIntoTable($this->table_view, $dataArr);
		}
		//$this->db->query($sql);
		echo $this->load->view('home/view_offer_details',$data,true);
	}
	
	public function view_name(){
		$data['user_id'] =  $this->nsession->userdata('user_id');
		$id 		= $this->input->post('id');
		$type 		= $this->input->post('type');
		if($this->nsession->userdata('user_id')!=""){
		
		$data['friends_details'] 	= $this->model_friend->getFriendList();
		$data['pending_friends_details'] 	= $this->model_friend->getPendingFriendList();
		$data['decline_friends_details'] 	= $this->model_friend->getDeclineFriendList();
		$data['request_friends_details'] 	= $this->model_friend->getFriendRequestList();
		}
		$data['name_details'] 	= $this->model_home->get_name_details($id, $type);
		//echo $this->db->last_query();
		echo $this->load->view('home/view_name_details',$data,true);
	}
	
	
	public function view_flyer()
	{
		$user_id =  $this->nsession->userdata('user_id');
		$flyer_id = $this->input->post('flyer_id');
		//echo $flyer_id;exit();
		$this->data['flyer_details'] 	= $this->model_home->getFlyerDetails($flyer_id);
		if($user_id>0){
			$dataArr= array("flyer_offer_type"	=> 'flyer',
					"flyer_offer_id"	=> $flyer_id,
					"user_id"		=> $user_id,
					"date_time"		=> date("Y-m-d h:i:s")
					);
			$this->model_basic->insertIntoTable($this->table_view, $dataArr);
		}		
		echo $this->load->view('home/view_flyer_details',$this->data,true);
		
	}
	public function website_count_views(){
		$id = $this->input->post('id');
		$id = explode('_',$id);
		if($id[0] == 'flyer'){
			$fl_id = $id[1];
			mysql_query("UPDATE ".$this->flyerMasterTable." SET webstite_vw_count=webstite_vw_count+1 WHERE fl_id=".$fl_id."");
		}else if($id[0] == 'offer'){
			$offer_id = $id[1];
			mysql_query("UPDATE ".$this->dealMasterTable." SET webstite_vw_count=webstite_vw_count+1 WHERE deal_id=".$offer_id."");
		}
	}
	
	public function flyer_offer()
	{
		$flyer_id=$this->uri->segment(3);
		$this->data['flyer_details'] 	= $this->model_home->getFlyerDetails($flyer_id);
		echo $this->load->view('home/view_flyer_details',$this->data,true);
	}

}
?>