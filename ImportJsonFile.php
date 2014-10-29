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
	
	
	$FileHome = $_ENV["OPENSHIFT_DATA_DIR"];


	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());


//	$post_wid = htmlspecialchars($_GET["wid"]);		// only set after we have added the blanks in first pass


	// Read the file contents into a string variable,
// and parse the string into a data structure
//$str_data = file_get_contents($FileHome . "/QDataR.js");
//$data = json_decode($str_data,true);
// echo $data."<br>";
//echo "Question 1 week 1?: ".$data["weeks"]["week"]["questions"]["q"][0]."<br>";
//echo "Question 1 week 1?: ".$data["weeks"]["week"]["questions"]["q"][1]."<br>";
echo "hello";
//echo "Weeks 0: " . $data["weeks"][0] . "<br>";
//echo "Weeks 1: " . $data["weeks"][1] . "<br>"; 
//echo var_dump(json_decode($data, $assoc = null);)

//	mysql_close();


?>

</body>

</html>


