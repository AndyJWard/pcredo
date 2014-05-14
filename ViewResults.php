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
<title>View Results</title>
</header>

<?php
$pid = htmlspecialchars($_GET["Pid"]);
$id = htmlspecialchars($_GET["Question"]);

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

//	$id = htmlspecialchars($_GET["Question"]);


	$query = 'SELECT * FROM persons WHERE Pid=' . $pid ;
		
	mysql_query($query);

	$per_row = mysql_fetch_assoc($query);

	mysql_close();

echo "<nav>";
echo "<table width=\"900\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";

$hid=' type="hidden" '; 
if($per_row['Password') {
	$hid = ' type="input" ';
}

echo '<td width="20%" class="bk90i">Enter your password <input ' . $hid . 'name="password"></td>';
echo '<td width="30%" class="bk90i"><a href="ViewResults.php?Pid=' . $pid . '&Question=' . $id . '">View the recorded results</a></td>';
echo '<td width="30%" class="bk90i"><a href="Preferences.php?Pid=' . $pid . '&Question=' . $id . '">Change your recording preferences</a></td>';
echo '<td width="10%" class="bk90i"><a href="index.php">Home</a></td>';
echo "<tr></tr></table>";
echo "</nav>";


//foreach ($_POST as $key => $value)
// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
		
?>
	
	
	