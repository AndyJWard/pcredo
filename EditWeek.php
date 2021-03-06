<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Edit Week</title>

</head>

<body>

<?php

require('db.php');

	$post_wid = htmlspecialchars($_GET["wid"]);		// only set after we have added the blanks in first pass

		// list the questions/answers for the week we're looking at

	$week = mysqli_query($con, "SELECT wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks WHERE wid = " . $post_wid);
	
	$wk = mysqli_fetch_array($week);

	echo "<table width=\"1000\">";
	echo "<td class=\"bk90\" width=\"30%\">Edit questions for " . $wk['rdat'] . "</td>";
	echo "<td class=\"bl\" width=\"35%\">" . $wk['wsubject'] . "</td>";
	echo "<td class=\"bl90i\" width=\"35%\">" . $wk['wcomment'] . "</td>";
	echo "</table>";

echo "<nav>";
echo "<table width=\"600\">";
// echo "<tr></tr>";
echo "<td class=\"bk90\" width=\"30%\"><a href=\"WeekChange.php?wid=" .$post_wid . "\">Amend Week Header</a></td>";
echo "<td class=\"bk90\" width=\"30%\"><a href=\"DataChange.php?encore=1\">Amend Home</a></td>";
echo "<td class=\"bk\" width=\"40%\"><form action=\"SaveWeek.php\" method=\"post\"><input type=\"submit\" value=\"Save Changes\"></td>";
echo "<tr></tr></table>";
echo "</nav>";

	echo "<table>";

	echo "";		// Form pass to SaveWeek.php?wid=n

	$query = "SELECT * FROM questions WHERE qwid = " . $post_wid . " ORDER BY qnum";

	$wk_res = mysqli_query($con, $query);
	$qno = 0;

	while($wk_row=mysqli_fetch_array($wk_res))
	{
		$qno = $qno + 1;

		$qid = $wk_row['qid'];
		$nam_id = "qid" . $qno;
				// assemble question id field name
		$nam_qnum = "qn" . $qno;
				// assemble question number field name
		$nam_q = "q" . $qno;
				// assemble question field name
		$nam_a = "a" . $qno;
				// assemble answer field name
		echo "<tr><td class=\"bl\"><input type=\"text\" name=\"" . $nam_qnum . "\" size=\"2\" value =\"" . $wk_row['qnum'] . "\"></td>";
		echo "<td><input type=\"text\" name=\"" . $nam_q . "\" size=\"140\" value=\"" . $wk_row['qquestion'] . "\"></td></tr>";
		echo "<tr><td /><td><input type=\"text\" name=\"" . $nam_a . "\" size=\"140\" value=\"" . $wk_row['qanswer'] . "\">";
		echo "<input type=\"hidden\" name=\"" . $nam_id . "\" value=\"" . $qid . "\"></td></tr>";
		}

	echo "";
	echo "</form>";


	mysqli_close($con);


?>

</body>

</html>


