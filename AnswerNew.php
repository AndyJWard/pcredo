<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
?>
 
<head>
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<![endif]-->
</head>
<header>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Record</title>
</header>

<!-- onchange event for person selector - used to set default privacy choice to the recorded one -->

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$id = htmlspecialchars($_GET["question"]);
	$_SESSION["WeekId"] = $id;
	
	$query = "SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $id;

	$wk_res = mysql_query($query);

	$wk_row = mysql_fetch_array($wk_res);

echo "<table width=\"1200\"><tr align=\"left\" style=\"font-size: 15; color: blue;\">";

echo "<td>" .  $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";
// Top line on page -  left side is date and title ... right side is person selector;

//	$per_res = mysql_query("SELECT * FROM persons ORDER BY Fieldtype, Pname");
	$per_res = mysql_query("SELECT * FROM persons ORDER BY Pname");
	// find the names for the select field (to save results);


echo "</td></tr></table>";

echo "<table width=\"1200\">";

	$res = mysql_query("SELECT * FROM questions WHERE qwid = " . $id . " ORDER BY qnum");

	while ($row = mysql_fetch_array($res))
		{
		echo "<tr><td class=\"bk\" style=\"width:4%\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk\" style=\"width:80%\">" . $row['qquestion'] . "</td></tr>";
		echo "<tr><td></td><td class=\"bl\">" . $row['qanswer'] . "</td></tr>";
		}

	echo '</table>';

$test = htmlspecialchars($_GET["test"]);

if($test==1) {
echo '<nav>';
echo '<table width="800"><tr align="left" style="font-size: 12; color: black;">';
echo '<tr></tr>';
 echo "<td width=\"40%\" align=\"center\">";
 echo "<select style=\"width: 170px;\" id=\"WHO\" size=\"1\" onchange=\"who_change(" . $id . ")\">";
 echo "<option value=\"0\">Record Your Score";
 while ($per_row = mysql_fetch_array($per_res))
 		{			
 		echo "<option value=\"" . $per_row['Pid'] . "\">" . $per_row['Pname'] . "</option>";
 		}
echo '<td width="30%" class="bk90i"><a href="WhoAreYou.php?question=' . $id . '">Record Your Results</a></td>';
echo '<td width="30%" class="bk90i"><a href="ViewResults.php">View the recorded results</a></td>';
echo '<td width="15%" class="bk90i"><a href="Question.php?question=' . $id . '">Questions</a></td>';
echo '<td width="15%" class="bk90i"><a href="index.php">Home</a></td>';
echo '<tr></tr></table>';
echo '</nav>';
}
else {
echo "<nav>";
echo "<table width=\"200\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";
echo "<td width=\"50%\"><a href=\"index.php\">Home</a></td>";
echo "<td width=\"50%\"><a href=\"Question.php?question=" . $id . "\">Back</a></td>";
echo "<tr></tr></table>";
echo "</nav>";
}	
	
	mysql_close();

?>

<script type="text/javascript" >
function who_change(id) {
	var x=document.getElementById("WHO");
	var pid=x.value;
	var redirect = "Record.php?Question=" + id + "&Pid=" + pid;
	document.location.href = redirect;
}
</script>
