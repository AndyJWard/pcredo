<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
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

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$pid = htmlspecialchars($_GET["Pid"]);
	
//	$id = htmlspecialchars($_GET["Question"]);
	
	$Who = $_POST['person'];
	$email = $_POST['email'];
//	if(isset($_POST['secret']) && $_POST['secret'] == "Yes") {	
//		$Secret = "Y";
//		}
//		else { $Secret = "N";
//	}

if (isset($_POST['secret'])) { 
echo "secret checked </br>"; 
}


	if(isset($_POST['anon'])) {
		$Annony = "Y";
		}
	$Recy = $_POST['receive'];
	$Pub = $_POST['publish'];
	$Pwd = $_POST['pwd'];
		
//	$per_res = mysql_query("SELECT * FROM persons WHERE pid =" . $pid . " limit 1");
//	$per_row = mysql_fetch_assoc($per_res);

foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

	if (isset($_POST['cancel'])) {
		echo "Cancellled person " . $Who . " / email " . $email . " / pwd " . $Pwd . " / anon " . $Annony . " / receive " . $Recy . " / publish " . $Pub . " / secret " . $Secret ;
	}
	if (isset($_POST['save'])){
		echo "Saved person " . $Who . " / email " . $email . " / pwd " . $Pwd . " / anon " . $Annony . " / receive " . $Recy . " / publish " . $Pub . " / secret " . $Secret ;
	}
?>
	
	
	