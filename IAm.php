<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
?>
 
<head>
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<![endif]-->
</head>
<header>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Iam</title>
</header>


<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$pid = $_POST['Pid'];
	$_SESSION["PersonId"] = $pid;

	$wid = htmlspecialchars($_GET["question"]);
	$wid = $_SESSION["WeekId"];
	
	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);
	if($per_row['Initial']=="Y") {
		header("Location: SetPreferences.php");	
	}

	echo '<nav>';
	echo "Person Id " . $pid ."<br>";
 	echo "Week Id " . $wid ."<br>";
 	
	echo '</nav>'; 	

?>
