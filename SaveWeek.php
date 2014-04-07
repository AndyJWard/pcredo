<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Save Week</title>

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

	for ($qno = 1; $qno <= 10; $qno++)
	{
		$qfld = "q" . $qno;
		$qval = $_POST[$qfld];
		$afld = "a" . $qno;
		$aval = $_POST[$afld];
		$qnfld = "qn" . $qno;
		$qnval = $_POST[$qnfld];
		$qidfld = "qid" . $qno;
		$qidval = $_POST[$qidfld];
	
		$query = "UPDATE questions SET qnum=\"" . $_POST[$qnfld] . "\", qquestion=\"" . $_POST[$qfld] . "\", qanswer=\"" . $_POST[$afld] . "\" WHERE qid = " . $_POST[$qidfld];

//echo "1 qnum: " . $qnval . "   q: " . $qval  . "   a: " . $aval  . "   qid: " . $qidval . "<br />";

//echo $query . "<br />";

		mysql_query($query);
	}

	mysql_close();
	echo "Updates done<br />";
	echo "<p></p><a href=\"DataChange.php\">More Changes</a><br />";
	echo "<p></p><a href=\"index.php\">Home</a>";


?>

</body>

</html>


