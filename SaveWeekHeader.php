<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Save Week Header</title>

</head>

<body>

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());


	$post_wid = htmlspecialchars($_GET["wid"]);

	if($_POST["wrelease"] <> "")
		{
		$week_bit = ", wrelease='" . $_POST["wrelease"] . "'";
		}
	else
		{
		$week_bit = "";
		}

$query = "UPDATE weeks SET wsubject=\"" . $_POST["wsubject"] . "\", wcomment=\"" . $_POST["wcomment"] . "\"" . $week_bit . " WHERE wid = " . $post_wid;

//echo $week_bit . "<br />";
//echo $query . "<br />";


		mysql_query($query);
	

	mysql_close();

	echo "Updates done<br />";
	echo '<p></p><a href="DataChange.php?encore=1">More Changes</a><br />';
	echo "<p></p><a href=\"index.php\">Home</a>";


?>

</body>

</html>


