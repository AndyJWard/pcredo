<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Save Week Header</title>

</head>

<body>

<?php

	require('db.php');

	$post_wid = htmlspecialchars($_GET["wid"]);

	if($_POST["wrelease"] <> "")
		{
		$week_bit = ", wrelease='" . $_POST["wrelease"] . "'";
		}
	else
		{
		$week_bit = "";
		}

$query = "UPDATE weeks SET wsubject=\"" . $_POST["wsubject"] . "\", wcomment=\"" . $_POST["wcomment"] . "\"" . $week_bit . " WHERE wid = " . $post_wid;

//echo $week_bit . "<br />";
//echo $query . "<br />";


		mysqli_query($con, $query);
	

	mysqli_close($con);

	echo "Updates done<br />";
	echo '<p></p><a href="DataChange.php?encore=1">More Changes</a><br />';
	echo "<p></p><a href=\"index.php\">Home</a>";


?>

</body>

</html>


