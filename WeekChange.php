<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Edit Week Header</title>

</head>

<body>

<?php

	$post_wid = htmlspecialchars($_GET["wid"]);

	require('db.php');

	$week = mysqli_query($con, "SELECT wcomment, wsubject, DATE_FORMAT(wrelease, '%d %b %Y %T') AS rdat, wid from weeks WHERE wid = ".$post_wid);
	
	$wk = mysqli_fetch_array($week);

	echo "<table>";

	echo "<form action=\"SaveWeekHeader.php?wid=" . $post_wid . "\" method=\"post\">";		// Form pass to SaveWeek.php?wid=n

	echo "<tr><td class=\"bl\">Release Date is currently " . $wk['rdat'] . ": use yyyy/mm/dd hh:mm:ss for changes: <input type=\"text\" name=\"wrelease\" size=\"20\"></td>";

	echo "<tr><td class=\"bl\">Subject: <input type=\"text\" name=\"wsubject\" size=\"90\" value=\"" . $wk['wsubject'] . "\"></td></tr>";

	echo "<tr><td class=\"bl\">Comment: <input type=\"text\" name=\"wcomment\" size=\"90\" value=\"" . $wk['wcomment'] . "\"></td></tr>";

//	echo "<input type=\"hidden\" name=\"wid\" value=\"" . $wk['wid'] . "\"></td></tr>";

	echo "<input type=\"submit\" value=\"Save Changes\">";

	echo "</form>";

	echo "<p></p>&nbsp;&nbsp;&nbsp;<a href=\"DataChange.php\">Amend Home</a>&nbsp;&nbsp;&nbsp;";

	mysqli_close($con);


?>

</body>

</html>


