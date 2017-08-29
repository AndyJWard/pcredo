<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Add Week</title>

</head>

<body>

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());
		
	$query = "INSERT INTO weeks (wrelease, wsubject, wcomment) VALUES ( \"" . $_POST["release_date"] . "\", \"" . $_POST["subject"] . "\", \"" . $_POST["comment"] . "\")";

	mysql_query($query);		// create new entry in table    weeks

	$week_id = mysql_query("SELECT wid FROM weeks ORDER BY wid DESC");	// find id of week just added (the last record in the set)

	$wid=mysql_fetch_array($week_id);

	for ($qno = 1; $qno <= 10; $qno++)
	{
		$query = "INSERT INTO questions (qnum, qwid) VALUES (" . $qno. "," . $wid['wid']. ")";

		mysql_query($query);	// insert 10 blank questions into table    Questions   for the new week id (wid)
	}

	echo "<form action=\"EditWeek.php?wid=" . $wid['wid'] . "\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Enter questions for: " . $_POST["subject"] . "\">";
	echo "</form>";

	mysql_close($db);
?>

</body>

</html>


