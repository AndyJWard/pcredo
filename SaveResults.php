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
<title>Save Results</title>
</header>

<?php
$pid = htmlspecialchars($_GET["Pid"]);
$id = htmlspecialchars($_GET["Question"]);

if (isset($_POST['cancel'])) {
	echo '<meta http-equiv="refresh" content="0;URL=Preferences.php?Pid=' . $pid . '">';	
}
if (isset($_POST['save'])){
		
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

//	$id = htmlspecialchars($_GET["Question"]);
	
	$query = 'INSERT INTO results ' . $id . ', 1, ' . $pid . ', ' . $_POST['check1'];
echo $query; 
	$query = 'INSERT INTO results ' . $id . ', 2, ' . $pid . ', ' . $_POST['check2'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 3, ' . $pid . ', ' . $_POST['check3'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 4, ' . $pid . ', ' . $_POST['check4'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 5, ' . $pid . ', ' . $_POST['check5'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 6, ' . $pid . ', ' . $_POST['check6'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 7, ' . $pid . ', ' . $_POST['check7'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 8, ' . $pid . ', ' . $_POST['check8'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 9, ' . $pid . ', ' . $_POST['check9'];
echo $query;
	$query = 'INSERT INTO results ' . $id . ', 10, ' . $pid . ', ' . $_POST['check10'];
echo $query;
	
//	mysql_query($query);
	mysql_close();

foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
}
?>
	
	
	