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

	require('db.php');
		
	$query = "INSERT INTO weeks (wrelease, wsubject, wcomment) VALUES ( \"" . $_POST["release_date"] . "\", \"" . $_POST["subject"] . "\", \"" . $_POST["comment"] . "\")";

	mysqli_query($con, $query);		// create new entry in table    weeks

	$week_id = mysqli_query($con, "SELECT wid FROM weeks ORDER BY wid DESC");	// find id of week just added (the last record in the set)

	$wid=mysqli_fetch_array($week_id);

	for ($qno = 1; $qno <= 10; $qno++)
	{
		$query = "INSERT INTO questions (qnum, qwid) VALUES (" . $qno. "," . $wid['wid']. ")";

		mysqli_query($con, $query);	// insert 10 blank questions into table    Questions   for the new week id (wid)
	}

	echo "<form action=\"EditWeek.php?wid=" . $wid['wid'] . "\" method=\"post\">";
	echo "<input type=\"submit\" value=\"Enter questions for: " . $_POST["subject"] . "\">";
	echo "</form>";

	mysqli_close($con);
?>

</body>

</html>


