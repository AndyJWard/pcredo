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

$chk1="N";
if ($_POST['check1']) {
$chk1 = "Y";
}
	
$chk2="N";
if ($_POST['check2']) {
$chk2 = "Y";
}
	
	
	
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 1, ' . $pid . ', "' . $chk1 . '")';
echo $query . '<br>'; 
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 2, ' . $pid . ', "' . $chk2 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 3, ' . $pid . ', "' . $chk3 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 4, ' . $pid . ', "' . $chk4 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 5, ' . $pid . ', "' . $chk5 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 6, ' . $pid . ', "' . $chk6 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 7, ' . $pid . ', "' . $chk7 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 8, ' . $pid . ', "' . $chk8 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 9, ' . $pid . ', "' . $chk9 . '")';
echo $query . '<br>';
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 10, ' . $pid . ', "' . $chk10 . '")';
echo $query . '<br>';
	
//	mysql_query($query);
	mysql_close();

foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
}
?>
	
	
	