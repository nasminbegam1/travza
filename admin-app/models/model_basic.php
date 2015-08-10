<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
	var $settingstable = 'hw_sitesettings';
	
	public function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function getValue_condition($TableName, $FieldName, $AliasFieldName='', $Condition=''){	
		if($Condition == "") {
			$Condition = "";
		} else {
			$Condition = " WHERE ".$Condition;
		}
		
		if($AliasFieldName == ''){
			$getField = $FieldName;
		}
		else{
			$getField = $AliasFieldName;
			$FieldName = $FieldName ." AS ".$AliasFieldName;
		}
				
		$sql = "SELECT ".$FieldName."  FROM ".$TableName.$Condition;
		
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec = $rs->row();
			
			//if(is_numeric($rec->$getField))
			//{
			//	if($rec->$getField > 0)
			//		return $rec->$getField;
			//	else
			//		return "0";
			//}
			//else{
			//	return $rec->$getField;
			//}
			return $rec;
		}else{
			return false;
		}
	}
	
	
	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = ''){
		
		$cnt = 0;
		if($condition == '') $condition = 1;
		
		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
		
		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." <> '".$idValue."'";
		}
		
		$rs = $this->db->query($sql);
		//echo $this->db->last_query(); exit;
		$rec = $rs->row();
		$cnt = $rec->CNT;

		return $cnt;
	}
	
	
	public function populateDropdown($idField, $nameField, $tableName, $condition='', $orderField, $orderBy)
	{
		$conditionWhere = '';
		if($condition != '') {
			$conditionWhere = " AND ".$condition;
		}
		$sql = "SELECT ".$idField.", ".$nameField." FROM ".$tableName." WHERE 1 ".$conditionWhere." ORDER BY ".$orderField." ".$orderBy."";
		//echo $sql; die;
		$rs = $this->db->query($sql);

		if($rs->num_rows())
		{
			$rec = $rs->result_array();
			return $rec;			
		}
			
		return false;
	}
	
	
	public function create_unique_slug($string,$table,$field='slug',$key=NULL,$value=NULL) {
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;

		if($key)$params["$key !="] = $value;
		while ($t->db->where($params)->get($table)->num_rows()) {
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}
		return $slug;
	}
	
	
	public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0) {
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
		
	    if($OrderBy != '') {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 ) {
		$sql .= " LIMIT 0, $Limit";
	    }
	    //echo $sql;exit;
	    $rec = FALSE;
	    $rs = $this->db->query($sql);
	    if($rs->num_rows()) {
			    $rec = $rs->result_array();
	    }else{
		$rec = FALSE;
	    }
	    return $rec;
	}	

    
    	
	public function get_settings( $id = '' ){
		$sql = "SELECT sitesettings_id, sitesettings_name, sitesettings_value FROM tr_sitesettings WHERE sitesettings_id in (".$id.") ";
		//echo $sql; exit;
		$query = $this->db->query($sql);
		$rec = false;
		if ($query->num_rows() > 0){
		    foreach ($query->result_array() as $row){
			$rec[$row['sitesettings_name']] = $row['sitesettings_value'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}
	
	
	public function deleteData($table, $where) {
		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		//echo $sql;exit();
		$rec 	= $this->db->query($sql);
		return $rec;
	}


	public function insertIntoTable($tableName,$insertArr)
	{
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if($insertArr && is_array($insertArr))
		{
			$this->db->insert($tableName, $insertArr);
			$ret = $this->db->insert_id(); 
		}
		
		return $ret;
	}
	
	public function updateIntoTable($tableName, $idArr, $updateArr)
	{
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if(!$idArr && !is_array($idArr) )
			return $ret;
		
		if( $updateArr && is_array($updateArr) )
		{
			$this->db->update($tableName, $updateArr, $idArr);
			//echo $this->db->last_query(); die;
			$ret = $this->db->affected_rows();
			
		}
		//echo $this->db->last_query();
		return $ret;
	}	


	public function checkRowExists($tableName, $whereArr)
	{ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');		
		$this->db->where($whereArr);
		$query = $this->db->get($tableName);
		//echo $this->db->last_query();exit();
		if ($query->num_rows() > 0){
		    return 0;
		}else{
		    return 1;
		}
	}

	public function changeStatus($tableName, $pagearray, $setfieldName, $fieldStatus, $updateFieldName)
	{ 
		$error		= false;		
		if(!is_array($pagearray)){
			$error	= true;
			return 'noitem';
		}
		if(empty($pagearray)){
			$error	= true;
			return 'noact';
		}
		
		if(!$error){			
			$sql = "UPDATE ".$tableName."
				SET ".$setfieldName." = '".$fieldStatus."'
				WHERE FIND_IN_SET(".$updateFieldName.", '".implode(",", $pagearray)."')";
			$this->db->query($sql);
		}
		if($fieldStatus == 'active') {
			return 'deactive';	
		} else {
			return 'active';	
		}
	}
	
	public function deletePropertyEnquiry($property_id)
	{
		/*** Check property id present in the enquiry master ***/
		$sql_chk1	= "SELECT enquiry_id
				   FROM hw_enquiry_master
				   WHERE property_id = '".$property_id."' ";
			     
		$query1 	= $this->db->query($sql_chk1);
		
		if ($query1->num_rows() > 0)
		{
			foreach ($query1->result_array() as $row1)
			{
				$enquiry_id = $row1['enquiry_id'];
				
				/*** DELETE from lp_enquiry_lead  ***/
				$sql_del1 	= "DELETE FROM hw_enquiry_lead WHERE enquiry_id = '".$enquiry_id."'";
				$rs_del1  	= $this->db->query($sql_del1);
				
				/*** Delete from lp_calendar_event ***/
				$sql_del2	= "DELETE FROM hw_calendar_event WHERE enquiry_id = '".$enquiry_id."'";
				$rs_del2  	= $this->db->query($sql_del2);
			}
		}
		
		$sql_del4	= "DELETE FROM hw_calendar_event WHERE property_id = '".$property_id."' ";
		$rs_del4  	= $this->db->query($sql_del4);
		
		/*** Delete from lp_enquiry_master ***/
		$sql_del3	= "DELETE FROM hw_enquiry_master WHERE property_id = '".$property_id."'";
		$rs_del3  	= $this->db->query($sql_del3);
		
		return true;
	}
	
	//public function get_property_availibility_dates($property_id){
	//	$sql	= "SELECT DATE_FORMAT(avail_date_format, '%e/%c/%Y') AS avail_date FROM lp_property_availibility WHERE property_id = '".$property_id."'";
	//	$query	= $this->db->query($sql);
	//	if($query->num_rows() > 0){
	//		$result	= $query->result_array();
	//	}else{
	//		$result	= '';
	//	}
	//	return $result;
	//}
	
	public function get_property_availibility_dates($property_id){
		$record	= array();
		
		$sql	= "SELECT price_id, DATE_FORMAT(season_start_date, '%Y-%m-%d') AS start_date, DATE_FORMAT(season_end_date, '%Y-%m-%d') AS end_date, daily_price FROM hw_property_season_price WHERE property_id = '".$property_id."' ORDER BY season_start_date";
		
		$query	= $this->db->query($sql);
		if($query->num_rows() > 0){
			$i	= 0;
			foreach($query->result() AS $row){
				$start_date	= $row->start_date;
				$end_date	= $row->end_date;
				$daily_price	= $row->daily_price;
				$price_id	= $row->price_id;
				
				$record[$i]['date'] 	= date("j/n/Y", strtotime($start_date));
				$record[$i]['price'] 	= $daily_price;
				$sCurrentDate 		= $start_date;
				
				while($sCurrentDate <= $end_date){
					$i++;
					// Add a day to the current date  
					$sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
					if($sCurrentDate <= $end_date){				      
						// Add this new day to the aDays array
						$record[$i]['date'] 	= date("j/n/Y", strtotime($sCurrentDate));
						$record[$i]['price'] 	= $daily_price;
					}
				}  
			}
		}
		
		$avail_record	= array();
		$sql	= "SELECT DATE_FORMAT(avail_date_format, '%e/%c/%Y') AS avail_date FROM hw_property_availibility WHERE property_id = '".$property_id."'";
		
		$query	= $this->db->query($sql);
		if($query->num_rows() > 0){
			$i	= 0;
			foreach($query->result() AS $row){
				$avail_record[]	= $row->avail_date;
			}
		}
		//pr($avail_record); exit;
		if(is_array($record) && count($record) > 0){
			for($i=0; $i<count($record); $i++){
				if(in_array($record[$i]['date'], $avail_record)){
					$record[$i]['avail']	= 0;
				}else{
					$record[$i]['avail']	= 1;
				}
			}
		}
		//pr($record);
		return $record;
	}

	public function getNextDate($date='', $date_interval)
	{
		$rec	= array();
		if($date == '')
		{
			$sql	= "SELECT DATE_FORMAT(DATE_ADD(NOW(), INTERVAL ".$date_interval." DAY), '%Y-%m-%d') AS date_diff";
		}
		else
		{
			$sql	= "SELECT DATE_FORMAT(DATE_ADD('".$date."', INTERVAL ".$date_interval." DAY), '%Y-%m-%d') AS date_diff";
		}
		$rs	= $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec[0]['date_diff'];
	}
	
	
}