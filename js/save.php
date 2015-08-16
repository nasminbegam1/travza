<?php
//This application is developed by www.webinfopedia.com
//Visit www.webinfopedia.com for more examples and demos


//Now get the encoded image form flash through HTTP_RAW_POST_DATA
if(isset($GLOBALS["HTTP_RAW_POST_DATA"])){
	$jpg = $GLOBALS["HTTP_RAW_POST_DATA"];
	$img = $_GET["img"];
	
	//image Directory
	$filename = "../upload/siteuser/". mktime(). ".jpg";
	file_put_contents($filename, $jpg);
} else{
	//show error if image is not recived 
	echo "Encoded JPEG information not received.";
}
?>