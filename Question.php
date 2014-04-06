<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Question</title>

</head>

<body>

<?php
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

// echo "Post defines <br/>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

// echo "Post connect server:" . DB_SERVER . "  user:" . DB_USER . "<br/>";
	
	mysql_select_db(DB_DATABASE) or die(mysql_error());

// echo "Post select_db <br/>";

	$id = htmlspecialchars($_GET["question"]);

	$ans = htmlspecialchars($_GET["reveal"]);	// reveal=Y or reveal=N

	$wk_res = mysql_query("SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $id );

	$wk_row = mysql_fetch_array($wk_res);


	echo "<table><tr><td class=\"bl\">" . $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";

	echo "<tr><td class=\"bk90i\">" . $wk_row['wcomment'] . "</td></tr></table><table>";

	$res = mysql_query("SELECT * FROM questions WHERE qwid = " . $id . " ORDER BY qnum");

	while ($row = mysql_fetch_array($res))
		{
		echo "<tr><td class=\"bk\" size=\"2\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk\" size=\"100\">" . $row['qquestion'] . "</td></tr>";
		}

	echo "</table>";

	echo "<p></p><a href=\"index.php\">Home</a>";

	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=Answer.php?question=" . $id . ">Answers</a>";

?>
</body>

</html>


