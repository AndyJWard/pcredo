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

foreach ($_POST as $key => $value)
	echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";

	$pid = $_POST["Pid"];
	$qid = $_POST["Qid"];
	$pwd = $_POST["Pwd"];
		
	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);

	$Who = $per_row['Pname'];
	
if ($per_row["Password"]==$pwd) {
	
	$query = "SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $qid . " limit 1";

	$wk_res = mysql_query($query);

	$wk_row = mysql_fetch_array($wk_res);
	
	echo '<form action="PostSubmit.php" method="post">';

	echo '<input type="hidden" name="Pid" value ="' . $pid . '">';
	echo '<input type="hidden" name="Qid" value ="' . $qid . '">';
//echo '<form action="SaveResults.php?Question=' . $id . '&Pid='. $pid . '" method="post" action="#">';
	echo "<table width=\"900\"><tr align=\"left\" style=\"font-size: 15; color: blue;\">";
	echo "<td width=\"70%\" align=\"left\">" .  $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";
	echo "<td class=\"r120\" width=\"30%\">Results for " . $Who . "</td></tr>";
	echo "<tr><td colspan=\"1\" style=\"font-family: arial, helvetica, sans-serif; font-size: 12; color: maroon; width:30%\" align=\"left\">" . $wk_row['wcomment'] . "</td></tr>";
	echo "</table>";

	echo "<table width=\"900\">";
	$res = mysql_query("SELECT * FROM questions WHERE qwid = " . $qid . " ORDER BY qnum");
	while ($row = mysql_fetch_array($res))
		{
		echo "<tr><td class=\"bk70\" style=\"width:4%\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk70\" style=\"width:96%\">" . $row['qquestion'] . "</td></tr>";
		$chkname = "check" . $row['qnum'];
		echo '<tr><td class="r70"><input type="checkbox" name="' . $chkname . '" checked></td>';
		echo '<td class="bl80" style="width:96%">' . $row['qanswer'] . '</td></tr>';
		}
	echo "</table>";

	echo "<nav>";
	echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
	echo "<tr></tr>";
	echo '<td width="20%" class="bk90i"><input type="submit" value="Save" name="save"></td>';
	echo '<td width="30%" class="bk90i"><a href="ViewResults.php">View the recorded results</a></td>';
//echo '<td width="30%" class="bk90i"><a href="Preferences.php?Pid=' . $pid . '&Question=' . $id . '">Change your recording preferences</a></td>';
	echo '<td width="30%" class="bk90i"><input type="submit" value="Change Recording Preferences" name="CRP">';
	echo '<td width="20%" class="bk90i"><a href="index.php">Home</a></td>';
	echo "<tr></tr></table>";
	echo "</nav>";
}

else {
	echo "<nav>";
	echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
	echo "<tr></tr>";
	echo '<td  width="30%" class="bk90i"> Sorry, wrong password.</td>';
	echo '<td width="20%" class="bk90i"><a href="index.php">Home</a></td>';
	echo "<tr></tr></table>";
	echo "</nav>";
}
	mysql_close();

?>
