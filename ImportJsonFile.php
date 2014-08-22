<?php 
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/London'); 
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

  <!-- Site details -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="language" content="en">

  <!-- Character encoding -->

  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="post-credo.css">

  <!-- Document title -->

  <title>Json File Import</title>

</head>
<body>

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());


	$post_wid = htmlspecialchars($_GET["wid"]);		// only set after we have added the blanks in first pass



	$string = file_get_contents("QDataR.js");

//	$json=json_decode($string,true);

//	$jsonIterator = new RecursiveIteratorIterator(
//    new RecursiveArrayIterator(json_decode($json, TRUE)),
//    RecursiveIteratorIterator::SELF_FIRST);

//	foreach ($jsonIterator as $key => $val) {
//    if(is_array($val)) {
        echo "$key:\n";
//    } else {
        echo "$key => $val\n";
//    }
//	}

	mysql_close();


?>

</body>

</html>


