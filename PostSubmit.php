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

foreach ($_POST as $key => $value)
  echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

foreach ($_POST as $key => $value)
	$pars = $pars . htmlspecialchars($key) . '=' . htmlspecialchars($value);
	
foreach($_POST as $name => $value) {
  $encoded .= urlencode($name) . '=' . urlencode($value) . '&';
}

	echo $pars;

if (isset($_POST["save"])) {
$url = "SaveResults.php" ;
}		

if (isset($_POST["CRP"])) {
$url = "Preferences.php" ;
}		

	$ch = curl_init($url);
	$encoded = substr($encoded, 0, strlen($encoded)-1);	// chop off trailing &
	curl_setopt($ch, CURLOPT_POSTFIELDS,  $encoded);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_exec($ch);
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
	
	
	