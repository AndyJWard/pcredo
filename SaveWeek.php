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

	require('db.php');;

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

		mysqli_query($con, $query);
	}

	mysqli_close($con);
	echo "Updates done<br />";
	echo "<p></p><a href=\"DataChange.php?encore=1\">More Changes</a><br />";
	echo "<p></p><a href=\"index.php\">Home</a>";


?>

</body>

</html>


