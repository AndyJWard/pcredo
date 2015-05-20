<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();


	$pid = $_SESSION["PersonId"];

if (isset($_POST['cancel'])) {
	header("Location: Record1.php?");
	exit;	
}
if (isset($_POST['save'])){
		
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	
	$Who = $_POST['person'];
	$email = $_POST['email'];

	if (isset($_POST['secret'])) { 
		$secret= $_POST['secret']; 
	}

	if(isset($_POST['anon'])) {
		$Annony = $_POST['anon'];
	}
	
	if(isset($_POST['receive'])) {
		$receive = $_POST['receive'];
	}
	
	if(isset($_POST['publish'])) {
		$publish = $_POST['publish'];
	}
	
	$Pwd = $_POST['pwd'];
		
	$query= 'UPDATE persons SET Pname="' . $Who . '", Pemail="' . $email . '", Password="' . $Pwd . '", Annonymous="' . $Annony . '", Publish="' . $publish . '", Receive="' . $receive . '", Secret="' . $secret . '", Initial="N" WHERE pid=' . $pid . ' limit 1';

	mysql_query($query);
	mysql_close();
	
	header("Location: Record1.php?");
	exit;	

}
?>
	<head>
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<![endif]-->
</head>
<header>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Save Preferences</title>
</header>
	
	