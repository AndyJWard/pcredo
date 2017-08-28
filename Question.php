<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Question</title>

</head>

<body>

<?php

require('db.php');

// echo "Post select_db <br/>";

	$id = htmlspecialchars($_GET["question"]);
	$_SESSION["QuestionWeek"] = $id;

	$ans = htmlspecialchars($_GET["reveal"]);	// reveal=Y or reveal=N

	$wk_res = mysqli_query($con, "SELECT  DATE_FORMAT(wrelease, '%d %b %Y') as rdate, wsubject, wcomment FROM weeks WHERE wid = " . $id );
	
	$wk_row = mysqli_fetch_array($wk_res);

	echo "<table><tr><td class=\"bl\">" . $wk_row['rdate'] . " - " . $wk_row['wsubject'] . "</td>";

	echo "<tr><td class=\"bk90i\">" . $wk_row['wcomment'] . "</td></tr></table><table>";

	$res = mysqli_query($con, "SELECT * FROM questions WHERE qwid = " . $id . " ORDER BY qnum");

	while ($row = mysqli_fetch_array($res))
		{
		echo "<tr><td class=\"bk\" size=\"2\">" . $row['qnum'] . "</td>";
		echo "<td class=\"bk\" size=\"100\">" . $row['qquestion'] . "</td></tr>";
		}

	echo "</table>";

	echo "<p></p><a href=\"index.php\">Home</a>";

	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=Answer.php?question=" . $id . ">Answers</a>";
	
	mysqli_close($con);

?>
</body>

</html>


