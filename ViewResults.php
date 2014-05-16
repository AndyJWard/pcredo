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

	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");
	
	$per_row = mysql_fetch_assoc($per_res);

echo "<nav>";
echo '<form action="MyResults.php?Pid=' . $pid . '" method="post">';
echo "<table width=\"900\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";

 
if($per_row['Password']>'') {
	$pwdtxt1 = '<tr><td width="20%" class="bk90i">Enter your password <input type="text" name="password" size="40"></td><input type="submit" value="Look at my results">';
}
else {
	$pwdtxt1 = '<tr><td width="20%" class="bk90i"><a href="MyResults.php?Pid='. $pid . '"></td>';	
}

echo $pwdtxt1;
echo '<td width="30%" class="bk90i"><a href="ViewResults.php?Pid=' . $pid . '&Question=' . $id . '">View all results</a></td>';
echo '<td width="30%" class="bk90i"><a href="Preferences.php?Pid=' . $pid . '&Question=' . $id . '">Change your recording preferences</a></td>';
echo '<td width="10%" class="bk90i"><a href="index.php">Home</a></td></tr>';
echo "<tr></tr></table>";
echo "</nav>";


//foreach ($_POST as $key => $value)
// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
	mysql_close();		
		
?>
	
	
	