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
<title>Post Credo Answer</title>
</header>
<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

// echo "Post defines <br/>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

// echo "Post connect server:" . DB_SERVER . "  user:" . DB_USER . "<br/>";
	
// echo "Post select_db <br/>

	$id = htmlspecialchars($_GET["question"]);
	
	$query = "SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $id;

	$wk_res = mysql_query($query);

	$wk_row = mysql_fetch_array($wk_res);

echo "<table width=\"1000\"><tr align=\"left\" style=\"font-size: 15; color: blue;\">";
echo "<td colspan=\"1\" width=\"70%\" align=\"left\">" .  $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";

	$per_res = mysql_query("SELECT * FROM persons ORDER BY pname");

echo "<td colspan=\"1\" style=\"font-family: arial, helvetica, sans-serif; font-size: 12; color:maroon; width:30%;\" align=\"left\">";
echo "<select style=\"width: 200px;\" name=\"WhoRU\" size=\"1\">";


	while ($per_row = mysql_fetch_array($per_res))
		{
		echo "<option value=\"" . $per_row['pname'] . "\">" . $per_row['pname'] . "</option>";
		}

echo "</td></tr>";
echo "<tr><td colspan=\"1\" style=\"font-family: arial, helvetica, sans-serif; font-size: 12; color: maroon; width:30%\" align=\"left\">" . $wk_row['wcomment'] . "</td></tr>";
echo "</table>";

echo "<table>";

	$res = mysql_query("SELECT * FROM questions WHERE qwid = " . $id . " ORDER BY qnum");

	while ($row = mysql_fetch_array($res))
		{
		echo "<tr><td class=\"bk\" style=\"width:4%\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk\" style=\"width:96%\">" . $row['qquestion'] . "</td></tr>";
		echo "<tr><td></td><td class=\"bl\">" . $row['qanswer'] . "</td></tr>";
		}

	echo "</table>";

echo "<nav>";
echo "<table width=\"200\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";
echo "<td width=\"50%\"><a href=\"index.php\">Home</a></td>";
echo "<td width=\"50%\"><a href=\"Question.php?question=" . $id . "\">Back</a></td>";
echo "<tr></tr></table>";
echo "</nav>";

mysql_close();

?>

