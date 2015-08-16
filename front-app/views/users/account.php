<?php 
require_once('inc/init.php');

$action = "";
$alert = "";

if(isset($_GET['action'])){
	$action = $_GET['action']; 
}

if(isset($_POST['submit'])){
	
	if($_POST['submit'] == "new" && intval($user->getAttr('level')) <= 1){
		$new_user = new User();
		$form = new Form();
		$new_user->buildFromForm();
        
        if($_POST['send_password'] == 1){
    			$password = PasswordGenerator::getAlphaNumericPassword(8);
				$message = "This password will get you into the dealer portal at <a href=\"http://www.footework.com/dealer-portal/\">www.footework.com/dealer-portal/</a>.". 
				"You can change it at any time under your account settings.<br /><br />".
                "Password:" . $password;
				sendNotification("Here is your password",$message, $new_user->getAttr('email'),$new_user->getAttr('name'));
				$new_user->setAttr('password', hash('sha256',$password));	
		}
		
		if($new_user->create()){
			
			$_SESSION['alert'] = "Your new user has succesfully been created.";
			$new_options = new Options();
			$new_options->setDefaults($new_user);
			$new_options->setAttr('user_id', $new_user->getAttr('id'));
			$new_options->create();
		}
		
		$b_user = $new_user;
		
		header('location:list-users.php');
		exit;
		
	}elseif($_POST['submit'] == "update"){
	
		$form = new Form();
		$b_user = User::getUserById($_POST['user']);
		
		$password = $b_user->getAttr('password');
		//print_r($field->getValue());
		foreach($form->getFields() as $field){
			if( $field->getName() != "id" && property_exists($b_user, $field->getName())){
				$b_user->setAttr($field->getName(), $field->getValue());
			}elseif($field->getName()=="change_password"){
				if(strlen($field->getValue())>=8){
					$b_user->setAttr('password', hash('sha256',$field->getValue()));
				}			
			}
		}
		
		$alert = $b_user->update();
		
	
	}
	
}elseif(isset($_GET['user']) && intval($user->getAttr('level')) <= 1 ){
	
	$b_user = User::getUserById($_GET['user']);
	
}

doHeader();

?>

<title>Footework</title>

</head>
<body <?php checkAdmin(true); ?>>
	<div id="page">
		<header id="main">
			<div id="main-logo">
				<img src="images/logo_large.png" />
			</div>
			
			<?php doMainNavigation(); ?>
			
		</header>
		<section id="main-content">
			<p style="color: green;"><?php echo $alert; ?></p>
			<?php getForm("account-info"); ?>
		</section>
	</div>
	
<?php require_once(SITE_ROOT . '/footer.php'); ?>
