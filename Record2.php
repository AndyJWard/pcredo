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
<title>Post Credo Record(2)</title>
</header>

<!-- onchange event for person selector - used to set default privacy choice to the recorded one -->

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$pid = htmlspecialchars($_GET["Pid"]);
	
	$id = htmlspecialchars($_GET["Question"]);
	
	$per_res = mysql_query("SELECT * FROM persons WHERE pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);
	$Who = $per_row['pname'];
	
	$query = "SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $id . " limit 1";

	$wk_res = mysql_query($query);

	$wk_row = mysql_fetch_array($wk_res);

echo "<table width=\"900\"><tr align=\"left\" style=\"font-size: 15; color: blue;\">";
echo "<td width=\"70%\" align=\"left\">" .  $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";
echo "<td class=\"r120\" width=\"30%\">Results for " . $Who . "</td></tr>";
echo "<tr><td colspan=\"1\" style=\"font-family: arial, helvetica, sans-serif; font-size: 12; color: maroon; width:30%\" align=\"left\">" . $wk_row['wcomment'] . "</td></tr>";
echo "</table>";

echo "<table width=\"900\">";
	$res = mysql_query("SELECT * FROM questions WHERE qwid = " . $id . " ORDER BY qnum");

	while ($row = mysql_fetch_array($res))
		{
		echo "<tr><td class=\"bk70\" style=\"width:4%\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk70\" style=\"width:96%\">" . $row['qquestion'] . "</td></tr>";
		$chkname = "check" . $row['qnum'];
		echo "<tr><td class=\"r70\"><input type=\"checkbox\" id=\"" . $chkname . "\" checked></td>";
		echo "<td class=\"bl80\" style=\"width:96%\">" . $row['qanswer'] . "</td></tr>";
		}

	echo "</table>";

echo "<nav>";
echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";

echo "<td width=\"30%\" class=\"bk90i\"><a href=\"Results.php\">View the recorded results</a></td>";
echo "<td width=\"15%\" class=\"bk90i\"><a href=\"Question.php?question=" . $id . "\">Questions</a></td>";
echo "<td width=\"15%\" class=\"bk90i\"><a href=\"index.php\">Home</a></td>";
echo "<tr></tr></table>";
echo "</nav>";

	mysql_close();

?>
