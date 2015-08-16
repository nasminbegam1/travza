<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * This function is used for output of the array
 * @param array
 * @param print option optional
 * @return String
 */
if ( ! function_exists('pr'))
{
	function pr($arr,$e=1)
	{
		if(is_array($arr))
		{
			echo "<pre>";
			print_r($arr);
			echo "</pre>";
		}
		else
		{
			echo "<br>Not an array...<br>";
			echo "<pre>";
			var_dump($arr);
			echo "</pre>";
	
		}
		if($e==1)
		    exit();
		else
		    echo "<br>";
	}
}

/*
 * This function is used for output a string with certain limit
 * @param strings : input_string, limit
 * @return String
 */

if ( ! function_exists('sub_word'))
{
    function sub_word($str, $limit)
    {
            $text = explode(' ', $str, $limit);
            if (count($text)>=$limit)
            {
                    array_pop($text);
                    $text = implode(" ",$text).'...';
            }
            else
            {
                    $text = implode(" ",$text);
            }
            $text = preg_replace('`\[[^\]]*\]`','',$text);
            return strip_tags($text);
    }
}

/*
 * This function is used for sending mail
 * @param arrays : mail_array and attachment_array
 * @param strings : cc and bcc optional
 * @return Boolean TRUE||FALSE
 */

if (!function_exists('send_email'))
{
	function send_email(&$mail_config, $attachment_file='', $cc='', $bcc='') //$to, $from, $from_name, $subject, $message,
	{
		$CI = & get_instance();
		$CI->load->library('email');
		$CI->email->clear();
		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
		
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
		
		if(is_array($attachment_file)) {
			$attach_file_path = '';
			for($a=0;$a<count($attachment_file);$a++)
			{
				$attach_file_path = $attachment_file[$a];
				$CI->email->attach($attach_file_path);
			}
		}
		
		$i_email = $CI->email->send();
		
		return $i_email;
	}
}


if (!function_exists('sendHtmlEmail'))
{
	function sendHtmlEmail($mail_config, $cc='', $bcc='') //$to, $from, $from_name, $subject, $message,
	{
		$config['mailtype']	= 'html';
		$config['charset']	= 'utf-8';
		$config['newline'] 	= "\r\n";
		
		$CI = & get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear();		
		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
			
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if(isset($mail_config['attach'])){
			$CI->email->attach($mail_config['attach']);
		}		
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
				
		$i_email = $CI->email->send();
		
		return $i_email;
	}
}

//if (!function_exists('send_html_email'))
//{
//	function send_html_email($mail_config, $cc='', $bcc='') //$to, cc email id, bcc email id
//	{
//		$config['protocol']	= 'smtp';
//		$config['smtp_host']	= $mail_config['smtp_host'];
//		$config['smtp_port']	= $mail_config['smtp_port'];
//		$config['smtp_user']	= $mail_config['smtp_user'];
//		$config['smtp_pass']	= $mail_config['smtp_pass'];
//		$config['mailtype']	= 'html';
//		$config['charset']	= 'utf-8';
//		$config['newline'] 	= "\r\n";
//		
//		$CI = & get_instance();
//		$CI->load->library('email', $config);
//		$CI->email->clear();
//
//		
//		$to		= $mail_config['to'];
//		$from		= $mail_config['from'];
//		$from_name	= $mail_config['from_name'];
//		$subject	= $mail_config['subject'];
//		$message	= $mail_config['message'];
//		
//		$CI->email->to($to);
//		$CI->email->from($from, $from_name);
//		$CI->email->subject($subject);
//		$CI->email->message($message);
//		
//		if($cc != '') {
//			$CI->email->cc($cc);
//		}
//		
//		if($bcc != '') {
//			$CI->email->bcc($bcc);
//		}
//		return $CI->email->send();
//		echo "<><>".$this->email->print_debugger();
//		return mail($to,$subject,$message,$headers);
//
//	}
//}
if (!function_exists('send_html_email'))
{
	function send_html_email($mail_config, $cc='', $bcc='') //$to, cc email id, bcc email id
	{
		
		$config['mailtype']	= 'html';
		$config['charset']	= 'utf-8';
		$config['newline'] 	= "\r\n";
		
		$CI = & get_instance();
		$CI->load->library('email', $config);
		$CI->email->clear();

		
		
		$to		= $mail_config['to'];
		$from		= $mail_config['from'];
		$from_name	= $mail_config['from_name'];
		$subject	= $mail_config['subject'];
		$message	= $mail_config['message'];
		
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($cc != '') {
			$CI->email->cc($cc);
		}
		
		if($bcc != '') {
			$CI->email->bcc($bcc);
		}
		
		return $CI->email->send();
		
		

	}
}


/*
 * This function is used for file upload
 * @param array : upload_array
 * @return String 
 */
if (!function_exists('file_upload'))
{
	function file_upload(&$file_upload_config)
	{
		$CI = & get_instance();
		$CI->load->library('Upload');
		
		$field_name 		= $file_upload_config['field_name'];
		$file_upload_path 	= $file_upload_config['file_upload_path'];
		$max_size 		= $file_upload_config['max_size'];
		$allowed_types 		= $file_upload_config['allowed_types'];
		
		$config['upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path;
		
		if($allowed_types != '')
		{
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '')
		{
			$config['max_size']		= $max_size;
		}
		
		if(isset($file_upload_config['encrypt_name']))
		{
			$config['encrypt_name']		= $file_upload_config['encrypt_name'];
		}
		else
		{
			$config['encrypt_name']		= true;
		}
		
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		
		$data['upload_err'] = $CI->upload->display_errors();
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			
		}
		
		return $uploaded_file_name;
	}
}

/*
 * This function is used for image upload
 * @param arrays : upload_array and thumb_array
 * allowed_types, encrypt_name
 * @return String 
 */
if (!function_exists('image_upload'))
{
	function image_upload(&$upload_config, &$thumb_config,$diff_url='')
	{
		$CI = & get_instance();
		
		$CI->load->library('Upload');
		
		$field_name 		= $upload_config['field_name'];
		$file_upload_path 	= $upload_config['file_upload_path'];
		if(isset($upload_config['max_size']))
			$max_size 		= $upload_config['max_size'];
		else
			$max_size 		= '';
		if(isset($upload_config['max_width']))
			$max_width 		= $upload_config['max_width'];
		else
			$max_width 		= '';
		if(isset($upload_config['max_height']))
			$max_height 		= $upload_config['max_height'];
		else
			$max_height 		= '';
		
		
		$allowed_types 		= $upload_config['allowed_types'];
		$thumb_create 		= $thumb_config['thumb_create'];
		$thumb_file_upload_path = $thumb_config['thumb_file_upload_path'];
		$thumb_width 		= $thumb_config['thumb_width'];
		$thumb_height 		= $thumb_config['thumb_height'];
		
		if($diff_url != '')
			$config['upload_path'] 	= $diff_url.$file_upload_path;
		else	
			$config['upload_path'] 	= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path;
		
		
		if($allowed_types != '') {
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '') {
			$config['max_size']		= $max_size;
		} else {
			$config['max_size']		= '';
		}
		
		if($max_width != '') {
			$config['max_width']		= $max_width;
		} else {
			$config['max_width']		= '';
		}
		
		if($max_height != '') {
			$config['max_height']		= $max_height;
		} else {
			$config['max_height']		= '';
		}
		
		if(isset($upload_config['encrypt_name'])) {
			$config['encrypt_name']		= $upload_config['encrypt_name'];
		} else {
			$config['encrypt_name']		= true;
		}
                
		if(isset($upload_config['thumb_marker'])){
			$config['thumb_marker'] = $upload_config['thumb_marker'];
		} else {
			$config['thumb_marker'] = '';
		}
		
		$uploaded_file_name = '';
		$CI->upload->initialize($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		$CI->nsession->set_userdata('upload_err',$CI->upload->display_errors());
		
		$data['upload_err'] = $CI->upload->display_errors();
		//echo $CI->upload->display_errors();exit;
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			if($thumb_create) {
				if($diff_url != '')
				{
					$config['source_image'] 	= $diff_url.$file_upload_path.$uploaded_file_name;
				}
				else
				{
					$config['source_image']		= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path.$uploaded_file_name;
				}
				
				if($diff_url != '')
				{
					$config['new_image'] 		= $diff_url.$file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				}
				else
				{
					$config['new_image'] 		= FILE_UPLOAD_ABSOLUTE_PATH.$file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				}
				
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio']	= isset($thumb_config['maintain_ratio']) ? $thumb_config['maintain_ratio'] : TRUE;
				$config['width']	 	= $thumb_width;
				$config['height']		= $thumb_height;
				
				$CI->load->library('image_lib');
				$CI->image_lib->initialize($config);
				$res = $CI->image_lib->resize();
				//echo $CI->upload->display_errors();exit;
			}
			else {
				//return true;
			}
		} else {
			return false;
		}
		return $uploaded_file_name;
	}
}

/* This function is used for Download File
 * @param strings : file_name_path, original_file_name
 * @return NULL
*/
if (!function_exists('file_download'))
{
	function file_download($file_name_path, $original_file_name='') 
	{
		if(isset($original_file_name)) {
			$file_name = $original_file_name;
		} else {
			$file_name = $file_name_path;
		}
		$mime = 'application/force-download';
		header('Pragma: public');    
		header('Expires: 0');        
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name_path);
		return true;
		
	}
}

/* This function is used for creation of PDF
 * @param  strings : view_file_name, output_file_name_path, output_option,
 * landscape_portrait and paper_size
 * @return NULL
 */
if (!function_exists('generate_pdf'))
{
	function generate_pdf($view_file_name, $output_file_name_path='', $output_option, $landscape_portrait='', $paper_size='')
	{
		$CI = & get_instance();
		$CI->load->library('pdf');
		
		// set document information
		$CI->pdf->SetAuthor('Author');
		$CI->pdf->SetTitle('Title');
		$CI->pdf->SetSubject('Subject');
		$CI->pdf->SetKeywords('keywords');
		
		// set font
		$CI->pdf->SetFont('helvetica', 'N', 6);
		
                $CI->pdf->setPrintHeader(false);
		$CI->pdf->setPrintFooter(false);
                
                // add a page
                if($landscape_portrait != '' && $paper_size != '')
                {
			// set default monospaced font
			$CI->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			//$CI->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$CI->pdf->SetMargins(10, 10, 10);
			// set auto page breaks
			$CI->pdf->SetAutoPageBreak(TRUE, 0);
			$CI->pdf->AddPage($landscape_portrait, $paper_size);
                }
                else
                {
                    $CI->pdf->AddPage();
                }
		
		// write html on PDF
		$CI->pdf->writeHTML($view_file_name, true, false, true, false, '');
		ob_clean();
		
		//Close and output PDF document
		$CI->pdf->Output($output_file_name_path, $output_option);
	}
}

/* This function is used for removing special character
 * @param  String
 * @return String
 */
if (!function_exists('removeSpecialChar'))
{
	function removeSpecialChar($psString)
	{
            return preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%-]/s', '', $psString);
	}
}

/* This function is used for creating thumbnail
 * @param  String
 * @return String
 */
if (!function_exists('image_thumbnail'))
{
	function image_thumbnail($source_image, $new_image, $width, $height, $maintain_ratio = TRUE)
	{
		$config['image_library']	= 'gd2';
		$config['source_image']		= $source_image;
		$config['new_image'] 		= $new_image;
		$config['create_thumb'] 	= FALSE;
		$config['maintain_ratio']	= $maintain_ratio;
		$config['width']	 	= $width;
		$config['height']		= $height;
		
		$CI = & get_instance();
		$CI->load->library('image_lib');
		
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
		$CI->image_lib->clear();
    
		return true;
	}
}


if(!function_exists('array_sort_by_column')){
	function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
		$sort_col[$key] = $row[$col];
	    }	
	    array_multisort($sort_col, $dir, $arr);
	}
}

if(!function_exists('array_key_value_exist')){
function array_key_value_exist($array, $key, $val) {
    foreach ($array as $item)
        if (isset($item[$key]) && $item[$key] == $val)
            return true;
    return false;
}
}

if(!function_exists('db_date_format')){
function db_date_format($date){ // dd/mm/yyyy to Y-m-d
		$date = explode('/',$date);
		if(count($date)>2){
			$d = $date[0];
			$m = $date[1];
			$y = $date[2];
			return $date = $y."-".$m.'-'.$d;
		}
		return false;
}
}

if(!function_exists('BuildEmailMessageSalonUser')){
	function BuildEmailMessageSalonUser($message, $UserId) {
		$CI        = & get_instance();
		$salonuser =$CI->model_basic->getFromWhereSelect('bs_salon_users','','users_id='.$UserId);
		$salon     =$CI->model_basic->getFromWhereSelect('bs_salons','','salon_id='.$salonuser[0]['salon_id']);
		$salonOwner=$CI->model_basic->getFromWhereSelect('bs_salon_users','','salon_id='.$salonuser[0]['salon_id'].' AND users_type=5');
		$sitename  =$CI->model_basic->getFromWhereSelect('bs_sitesettings','','sitesettings_id=6');
		$message   = stripslashes($message);
		$RplVeriables =	array(
			      'SALON_USER_NAME'=>$salonuser[0]['users_first_name'].' '.$salonuser[0]['users_last_name'],
			      'SITE_NAME'=>$sitename[0]['sitesettings_value'],
			      'SITE_URL'=>FRONTEND_URL,
			      'SALON_OWNER_ADMIN_URL'=>SALON_OWNER_ADMIN_URL,
			      'SALON_USER_EMAIL'=>$salonuser[0]['users_email'],
			      'SALON_USER_PASSWORD'=>$salonuser[0]['users_password'],
			      'SALON_OWNER_NAME'   => $salonOwner[0]['users_first_name'].' '.$salonOwner[0]['users_last_name'],
			      'SALON_OWNER_EMAIL'  => $salonOwner[0]['users_email'],
			      'SALON_OWNER_PASSWORD' => $salonOwner[0]['users_password'],
			      );
		$message = ReplaceMessageConstants($RplVeriables, $message);
		return $message;
	}
}

if(!function_exists('ReplaceMessageConstants')){
	function ReplaceMessageConstants($veriablesArr, $message) {
		foreach($veriablesArr as $key=>$value){
			$message = str_replace('{{'.$key.'}}',$value, $message);
		}
		return $message;
	}
}

if(!function_exists('userDetails')){
	function userDetails($uid) {
		$CI = & get_instance();
		$salonuser =$CI->model_basic->getFromWhereSelect('bs_salon_users','','users_id='.$uid);
		return $salonuser;
	}
}

if(!function_exists('serviceDetails')){
	function serviceDetails($sid) {
		$CI = & get_instance();
		$service =$CI->model_basic->getFromWhereSelect('bs_services','','service_id='.$sid);
		return $service;
	}
}

if(!function_exists('array_msort')){
	function array_msort($array, $cols)
	{
	    $colarr = array();
	    foreach ($cols as $col => $order) {
		$colarr[$col] = array();
		foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
	    }
	    $eval = 'array_multisort(';
	    foreach ($cols as $col => $order) {
		$eval .= '$colarr[\''.$col.'\'],'.$order.',';
	    }
	    $eval = substr($eval,0,-1).');';
	    eval($eval);
	    $ret = array();
	    foreach ($colarr as $col => $arr) {
		foreach ($arr as $k => $v) {
		    $k = substr($k,1);
		    if (!isset($ret[$k])) $ret[$k] = $array[$k];
		    $ret[$k][$col] = $array[$k][$col];
		}
	    }
	    return $ret;
	}	
}

if(!function_exists('currentClass')){
	function currentClass(){
		$CI = & get_instance();
		$class = $CI->router->class;
		return  $class;
	}
}

if(!function_exists('currentMethod')){
	function currentMethod(){
		$CI = & get_instance();
		$method = $CI->router->method;
		return  $method;
	}
}

if(!function_exists('ccNcrypt'))
{
	function ccNcrypt($ccno)
	{
		$base_en_cc = base64_encode($ccno);
		return $new_cc = substr($base_en_cc,5,6).base64_encode($ccno);
	}
}

if(!function_exists('ccDcrypt'))
{
	function ccDcrypt($ccno)
	{
		$new_ccn = base64_encode($ccno);
		return base64_decode(substr(base64_decode($new_ccn), 6));
	}
}

if(!function_exists('getLatLong'))
{
	function getLatLong($address)
	{
		$address = str_replace(" ", "+", $address);
	    
		$json = @file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		$json = json_decode($json);
		
		$arr_lat_long = array();
	    
		if(@$json->{'status'} == 'OK'){
	    
		$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		}else{
			$lat 	= 0;
			$long 	= 0;
		}
		
		$arr_lat_long[0] = $lat;
		$arr_lat_long[1] = $long;
		
		return $arr_lat_long;
	}
}

if(!function_exists('imageCrop'))
{
	function imageCrop($config)
	{
		$file_path  	= $config['file_path'];
		$x  		= $config['x'];
		$y  		= $config['y'];
		$w  		= $config['w'];
		$h  		= $config['h'];
		$targ_w  	= $config['targ_w'];
		$targ_h  	= $config['targ_h'];//exit();
		$quality  	= $config['quality'];
		$uploaded_path	= $config['uploaded_path'];
		$image_type	= $config['image_type'];
		
		if($image_type == 'image/jpeg'|| strtolower($image_ext) == 'image/jpg')
		{
			$img_r 		= imagecreatefromjpeg($file_path);
		}
		else if($image_type == 'image/png')
		{
			$img_r 		= imagecreatefrompng($file_path);
		}
		else if($image_type == 'image/gif')
		{
			$img_r 		= imagecreatefromgif($file_path);
		}
		
		
		$dst_r 		= ImageCreateTrueColor( $targ_w, $targ_h );			
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
		
		if($image_type == 'image/jpeg' || strtolower($image_ext) == 'image/jpg')
		{
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,$uploaded_path,$quality);
		}
		else if($image_type == 'image/png')
		{
			header('Content-type: image/png');
			imagepng($dst_r,$uploaded_path,9);
		}
		else if($image_type == 'image/gif')
		{
			header('Content-type: image/gif');
			imagegif($dst_r,$uploaded_path,$quality);
		}
			
		return true;
	}
}

/* End of file common_helper.php */
/* Location: ./admin-app/helpers/common_helper.php */