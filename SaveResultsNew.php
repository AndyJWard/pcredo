<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();

$pid = $_SESSION["PersonId"];
$id = $_SESSION["WeekId"];

//if (isset($_POST['cancel'])) {
//	echo '<meta http-equiv="refresh" content="0;URL=Preferences.php?Pid=' . $pid . '">';	
//}
		
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());


$chk1=$_SESSION["chk1"];
$chk2=$_SESSION["chk2"];
$chk3=$_SESSION["chk3"];
$chk4=$_SESSION["chk4"];
$chk5=$_SESSION["chk5"];
$chk6=$_SESSION["chk6"];
$chk7=$_SESSION["chk7"];
$chk8=$_SESSION["chk8"];
$chk9=$_SESSION["chk9"];
$chk10=$_SESSION["chk10"];

echo "week id " . $id . "<br>";
echo "person " . $pid . "  -  " . $_SESSION["PersonName"] . "<br>";
echo "Q1 " . $chk1 . "<br>";
echo "Q2 " . $chk2 . "<br>";
echo "Q3 " . $chk3 . "<br>";
echo "Q4 " . $chk4 . "<br>";
echo "Q5 " . $chk5 . "<br>";
echo "Q6 " . $chk6 . "<br>";
echo "Q7 " . $chk7 . "<br>";
echo "Q8 " . $chk8 . "<br>";
echo "Q9 " . $chk9 . "<br>";
echo "Q10 " . $chk10 . "<br>";


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
echo "<table width=\"900\"><tr align=\"left\" style=\"font-size: 12; color: black;\"></tr>";
echo "<tr></tr>";
echo '<td width="30%" class="bk90i">Results saved - where to now?</td>';
echo '<td width="30%" class="bk90i"><a href="ViewResults.php?Pid=' . $pid . '&Question=' . $id . '">View the recorded results</a></td>';
echo '<td width="30%" class="bk90i"><a href="Preferences.php?Pid=' . $pid . '&Question=' . $id . '">Change your recording preferences</a></td>';
echo '<td width="10%" class="bk90i"><a href="index.php">Home</a></td>';
echo "<tr></tr></table>";
echo "</nav>";

		

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
	
	