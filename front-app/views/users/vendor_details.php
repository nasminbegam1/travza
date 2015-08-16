<?php
$link = $link1 = '';
//$useragent = $_SERVER['HTTP_USER_AGENT'];
//echo $useragent;exit; 
$iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android= stripos($_SERVER['HTTP_USER_AGENT'],"Android");
//$webOS= stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
	     
	    //if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            if($iPod || $iPhone || $iPad || $Android)
	    {
                $link = '<a href="http://maps.google.com/?daddr='.stripslashes($info[0]['address1']).'">'.stripslashes($info[0]['address1']).'"</a>';
                $link1 = '<a href="http://maps.google.com/?daddr='.stripslashes($info[0]['address2']).'">'.stripslashes($info[0]['address2']).'"</a>';
                
                //$link = '<a href="">'.stripslashes($info[0]['address1']).'</a>';
                //$link1 = '<a href="">'.stripslashes($info[0]['address2']).'</a>';
                
            }
            else
            {
                $link = stripslashes($info[0]['address1']);
                $link1 = stripslashes($info[0]['address2']);
            }



?>

<?php if(is_array($info)){?>
<table class="vendor_details" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr class="even-row">
        <td width='50%'><strong class="detailsTitle">Company Name : </strong> <?php if($info[0]['company_name']!=''){echo stripslashes($info[0]['company_name']);}else{ echo 'N/A';} ?></td>
        <td width='50%'><strong class="detailsTitle">Email : </strong><?php if($info[0]['email']!=''){echo stripslashes($info[0]['email']);}else{echo 'N/A';} ?></td>
        
    </tr>

    <tr class="odd-row">
      
        
        <td><strong class="detailsTitle">Address1 : </strong><?php if($info[0]['address2'] != ''){echo $link;}else{echo 'N/A';}?></td>
        
         <td><strong class="detailsTitle">Address2 : </strong><?php if($info[0]['address2'] != ''){echo $link1;}else{echo 'N/A';}?></td>
    </tr>

    <tr class="even-row">
       
       <td><strong class="detailsTitle">Country : </strong> <?php if($info[0]['country'] != ''){echo stripslashes($info[0]['country']);}else{echo 'N/A';}?></td>
        
        <td><strong class="detailsTitle">City : </strong><?php  if($info[0]['city'] != ''){echo stripslashes($info[0]['city']);}else{echo 'N/A';}?></td>
        
        
    </tr>

    
    <tr class="odd-row">

        <td><strong class="detailsTitle">State : </strong><?php if($info[0]['state'] != ''){echo stripslashes($info[0]['state']);}else{echo 'N/A';}?></td>
        
        <td><strong class="detailsTitle">Zip : </strong><?php if($info[0]['zip'] != ''){echo $info[0]['zip'];}else{echo 'N/A';}?></td>
        
        
    </tr>
    
    <tr class="even-row">
        <td><strong class="detailsTitle">Website : </strong><a href="<?php if($info[0]['website'] != ''){echo $info[0]['website'];}else{ echo "javascript:void(0)";}?>" target="_blank"><?php if($info[0]['website'] != ''){echo stripslashes($info[0]['website']);}else{echo 'N/A';}?></a></td>
    </tr> 

    
    <tr class="odd-row">
        <td><strong class="detailsTitle"> Company Discount Amount :</strong> </td>
<td>        
        <?php
		  if($info[0]['discount_amount'] != ''){
			   $discount_amount = explode(',',$info[0]['discount_amount']);
			   $discount_type = explode(',',$info[0]['discount_type']);
		  }
		  
		  if(is_array($info[0]['discount_details']) && count($info[0]['discount_details']) > 0){
			  for($i = 0;$i<count($info[0]['discount_details']);$i++){
			   echo stripslashes($info[0]['discount_details'][$i]['type_name']).' : ';
			   if($discount_type[$i] == '$'){echo '$';}
			   echo stripslashes($discount_amount[$i]);
			   if($discount_type[$i] == '%'){echo '%';}
			   echo '<br>';
			  }
		  }
                  else
                  {
                    echo 'N/A';
                  }
		  ?>
        
</td>
       
    </tr> 
    
    
  <?php } else echo "No Record";?>  
    
</table>