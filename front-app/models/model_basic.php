<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_basic extends CI_Model
{
		
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
				
		$sql = "SELECT ".$FieldName." FROM ".$TableName.$Condition;
		//echo $sql;
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec = $rs->row();
			
			if(is_numeric($rec->$getField))
			{
				if($rec->$getField > 0)
					return $rec->$getField;
				else
					return "0";
			}
			else{
				return $rec->$getField;
			}
		}else{
			return false;
		}
	}
	
	
	public function isRecordExist($tableName = '', $condition = '', $idField = '', $idValue = ''){
		if($condition == '') $condition = 1;
		
		$sql = "SELECT COUNT(*) as CNT FROM ".$tableName." WHERE ".$condition."";
		
		if($idValue > 0 && $idValue <> '')
		{
			$sql .=" AND ".$idField." <> '".$idValue."'";
		}
		
		$rs = $this->db->query($sql);
		$this->db->last_query();// exit;
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
				$slug .= '-'. ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			$params [$field] = $slug;
		}
		return $slug;
	}
	
	
	public function getValues_conditions($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0)
	{
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
		
		
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
	
	    if($OrderBy != '')
	    {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 )
	    {
		$sql .= " LIMIT 0, $Limit";
	    }
	   
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

	public function getValues_conditionsCount($TableName, $FieldNames='', $AliasFieldName = '', $Condition='', $OrderBy='', $OrderType='', $Limit=0)
	{
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    if($FieldNames && is_array($FieldNames))
		$select = implode(",", $FieldNames);
	    
		
		
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition;
	
	    if($OrderBy != '')
	    {
		$sql .= " ORDER BY ".$OrderBy." ".$OrderType;
	    }
	    if($Limit > 0 )
	    {
		$sql .= " LIMIT 0, $Limit";
	    }
	    $rs = $this->db->query($sql);
	    if($rs->num_rows() > 0){
		$rec=$rs->num_rows();
	    }else{
		$rec=0;
	    }
	    //echo $sql;exit();
	    /*$rec = 0;
	    $rs = $this->db->query($sql);
	    if($rs->num_rows())
	    {
			    $rec = $rs->num_rows();
	    }
	    else
	    {
		$rec = 0;
	    }*/
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
			$rec['sitename'] = $row['sitesettings_name'];
		    }
		    //pr($rec);
		    return $rec;
		}
		return false;
 	}
	
	
	public function deleteData($table, $where) {
		$sql	= "DELETE FROM ".$table." WHERE ".$where;
		$rec 	= $this->db->query($sql);
		return $rec;
	}


	public function insertIntoTable($tableName,$insertArr){
		
		$ret = false;
		if($tableName == '')
			return $ret;
		
		if( $insertArr && is_array($insertArr) ){
			$this->db->insert($tableName, $insertArr);
			$ret = $this->db->insert_id(); 
		}
		//echo $this->db->last_query();
		return $ret;
	}
	
	public function updateMail($tableName,$mail){
		$id=$this->nsession->userdata('confirm_user_id');
		$sql="update `$tableName` set `email`='$mail' where `id`='$id'";
		$query= $this->db->query($sql);
		$ret = $this->nsession->userdata('confirm_user_id');
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
			$ret = $this->db->affected_rows();
		}
		//echo $this->db->last_query();
		return $ret;
	}	


	public function checkRowExists($tableName, $whereArr){ // WhereArr = array('fieldname1'=>'fieldvalue1','fieldname2'=>'fieldvalue2');		
		$this->db->where($whereArr);
		$query = $this->db->get($tableName);
		//echo $this->db->last_query();//exit();
		if ($query->num_rows() > 0){
		    return 0;
		}else{
		    return 1;
		}
	}

	public function changeStatus($tableName, $pagearray, $setfieldName, $fieldStatus, $updateFieldName){ 
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
	


	public function getFromWhereSelect($TableName, $FieldNames='', $Condition='')
	{
	    if($Condition=="")
		$Condition="";
	    else
		$Condition=" WHERE ".$Condition;
		
	    $select = '*';
	    if($FieldNames && $FieldNames!= '')
		$select = $FieldNames;
	    
	    $sql = "SELECT ".$select." FROM ".$TableName.$Condition; 
	    //echo $sql; exit;
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
	
	public function updateLastLoginTime($id)
	{
		$sql = "UPDATE ".SITEUSER." SET last_login = NOW() WHERE id = '".$id."'";
		$rs = $this->db->query($sql);
	}
	
	public function getTravelerType()
	{
		$rec = false;
		$sql = "SELECT * FROM ".TRAVELERTYPES." ORDER BY id ASC";
		$rs  = $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec;
	}
	
	public function getProfessionType()
	{
		$rec = false;
		$sql = "SELECT * FROM ".PROFESSIONMASTER." ORDER BY id ASC";
		$rs  = $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec;
	}
	public function getValueCondition($TableName, $FieldName, $AliasFieldName='', $Condition=''){	
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
				
		$sql = "SELECT ".$FieldName." FROM ".$TableName.$Condition;
		//echo $sql;
		$rs = $this->db->query($sql);
		
		if($rs->num_rows())
		{
			$rec = $rs->row();
			return $rec;
			
		}else{
			return false;
		}
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
	
	public function getPreviousDate($date_interval, $current_date='')
	{
		$rec	= array();
		
		if($current_date == '')
		{
			$sql	= "SELECT DATE_FORMAT(DATE_SUB(NOW(), INTERVAL ".$date_interval." DAY), '%Y-%m-%d') AS date_diff";
		}
		else
		{
			$sql	= "SELECT DATE_FORMAT(DATE_SUB('".$current_date."', INTERVAL ".$date_interval." DAY), '%Y-%m-%d') AS date_diff";
		}
		
		$rs	= $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec[0]['date_diff'];
	}
	
	public function checkDateDiff($date)
	{
		$rec	= array();
		$sql	= "SELECT DATEDIFF('".$date."', NOW()) AS date_diff";
		$rs	= $this->db->query($sql);
		
		if($rs->num_rows() > 0)
		{
		   $rec = $rs->result_array();	
		}
		
		return $rec[0];
	}
}