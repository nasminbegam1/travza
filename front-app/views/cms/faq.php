  <!--<div class="main-container">-->
  	<div class="content">
            <center><h1>USER</h1></center><br/>
            <?php if(is_array($result_user) && count($result_user) > 0)
            {
            foreach($result_user as $rec)
            {
            
            ?>
    	<div class="page-title">
    		<h3><?php echo stripslashes($rec['faq_question']);?></h3>
        </div>
        <div class="textCenter">
           <?php echo stripslashes($rec['faq_answer']);?>
        </div>
        <?php }}?>
        
        
        <center><h1>VENDOR</h1></center><br/>
            <?php if(is_array($result_vendor) && count($result_vendor) > 0)
            {
            foreach($result_vendor as $rec1)
            {
            
            ?>
    	<div class="page-title">
    		<h3><?php echo stripslashes($rec1['faq_question']);?></h3>
        </div>
        <div class="textCenter">
           <?php echo stripslashes($rec1['faq_answer']);?>
        </div>
        <?php }}?>
    </div>
  <!--</div>-->