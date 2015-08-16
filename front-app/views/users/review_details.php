<?php //pr($info)?>

<?php if(is_array($info)){?>
<table class="vendor_details" cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr class="even-row">
        <td width='100%'><strong class="detailsTitle">Experince tips : </strong> <?php echo stripslashes($info[0]['experince_tips']); ?></td>
        
        
    </tr>
    <tr class="even-row">
        <td width='100%'><strong class="detailsTitle">Tell other members : </strong><?php echo stripslashes($info[0]['tell_other_members']); ?></td>
    </tr>

  <?php } else echo "No Record";?>  
    
</table>