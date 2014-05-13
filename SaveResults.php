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
	
$chk3="N";
if ($_POST['check3']) {
$chk3 = "Y";
}
	
$chk4="N";
if ($_POST['check4']) {
$chk4 = "Y";
}	
	
$chk5="N";
if ($_POST['check5']) {
$chk5 = "Y";
}
	
$chk6="N";
if ($_POST['check6']) {
$chk6 = "Y";
}

$chk7="N";
if ($_POST['check7']) {
$chk7 = "Y";
}
	
$chk8="N";
if ($_POST['check8']) {
$chk8 = "Y";
}

$chk9="N";
if ($_POST['check9']) {
$chk9 = "Y";
}
	
$chk10="N";
if ($_POST['check10']) {
$chk10 = "Y";
}

	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 1, ' . $pid . ', "' . $chk1 . '")';
mysql_query($query); 
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 2, ' . $pid . ', "' . $chk2 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 3, ' . $pid . ', "' . $chk3 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 4, ' . $pid . ', "' . $chk4 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 5, ' . $pid . ', "' . $chk5 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 6, ' . $pid . ', "' . $chk6 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 7, ' . $pid . ', "' . $chk7 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 8, ' . $pid . ', "' . $chk8 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 9, ' . $pid . ', "' . $chk9 . '")';
mysql_query($query);
	$query = 'INSERT INTO results (Wid, Qid, Pid, Result) VALUES (' . $id . ', 10, ' . $pid . ', "' . $chk10 . '")';
mysql_query($query);

	mysql_close();

echo "<nav>";
echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";
echo '<td width="20%" class="bk90i">Results saved - where to now?</td>';
echo '<td width="30%" class="bk90i"><a href="ViewResults.php?Pid=' . $pid . '&Question=' . $id . '">View the recorded results</a></td>';
echo '<td width="30%" class="bk90i"><a href="Preferences.php?Pid=' . $pid . '&Question=' . $id . '">Change your recording preferences</a></td>';
echo '<td width="20%" class="bk90i"><a href="index.php">Home</a></td>';
echo "<tr></tr></table>";
echo "</nav>";


//foreach ($_POST as $key => $value)
// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
		
		
		
}
?>
	
	
	