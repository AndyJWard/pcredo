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
<title>Save Preferences</title>
</header>

<?php

//foreach ($_POST as $key => $value)
//  echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

if (isset($_POST["save"])) {
	$url = "http://pcredo-fridayquiz.rhcloud.com/SaveResults.php" ;
	}		

if (isset($_POST["CRP"])) {
	$url = "http://pcredo-fridayquiz.rhcloud.com/Preferences.php" ;
	}		

if ($_SESSION["Initial"] == "Y") {
	$url = "http://pcredo-fridayquiz.rhcloud.com/Preferences.php" ;
	}

//echo $url;

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($_POST));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$response = curl_exec($ch);
	if(curl_errno($ch)) {
		echo 'Curl error: ' .curl_error($ch);
		}

// $response will contain the output of the OTHER website processing the form submission
// you can echo it to the screen or do your own processing if you want.
	echo $response;

//	$ch = curl_init($url);
//	curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
//	curl_setopt($ch, CURLOPT_HEADER, 0);
//	curl_setopt($ch, CURLOPT_POST, 1);
//	if(curl_errno($ch)) {
//		echo 'curl error:' . curl_error($ch);	
//		}
	curl_close($ch);


//$pid = htmlspecialchars($_GET["Pid"]);

//if (isset($_POST['cancel'])) {
//	echo '<meta http-equiv="refresh" content="0;URL=Preferences.php?Pid=' . $pid . '">';	
//}
//if (isset($_POST['save'])){
		
//	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
//	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
//	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
//	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

//	$id = htmlspecialchars($_GET["Question"]);
	


 
//}
?>
	
	
	