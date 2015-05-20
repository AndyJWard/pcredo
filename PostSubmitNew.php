<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();

if (isset($_POST["save"])) {
	if ($_POST['check1']) {
		$_SESSION["chk1"] = "Y";
	} else {
		$_SESSION["chk1"] = "N";
	}
	if ($_POST['check2']) {
		$_SESSION["chk2"] = "Y";
	} else {
		$_SESSION["chk2"] = "N";
	}	
	if ($_POST['check3']) {
		$_SESSION["chk3"] = "Y";
	} else {
		$_SESSION["chk3"] = "N";
	}
	if ($_POST['check4']) {
		$_SESSION["chk4"] = "Y";
	} else {
		$_SESSION["chk4"] = "N";
	}
	if ($_POST['check5']) {
		$_SESSION["chk5"] = "Y";
	} else {
		$_SESSION["chk5"] = "N";
	}
	if ($_POST['check6']) {
		$_SESSION["chk6"] = "Y";
	} else {
		$_SESSION["chk6"] = "N";
	}
	if ($_POST['check7']) {
		$_SESSION["chk7"] = "Y";
	} else {
		$_SESSION["chk7"] = "N";
	}
	if ($_POST['check8']) {
		$_SESSION["chk8"] = "Y";
	} else {
		$_SESSION["chk8"] = "N";
	}
	if ($_POST['check9']) {
		$_SESSION["chk9"] = "Y";
	} else {
		$_SESSION["chk9"] = "N";
	}
	if ($_POST['check10']) {
		$_SESSION["chk10"] = "Y";
	} else {
		$_SESSION["chk10"] = "N";
	}
	
	header("Location: SaveResultsNew.php?");
	exit;	
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
	
	