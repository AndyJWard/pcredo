<?php 	
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/London'); 
ob_start();
ini_set('display_errors', 1);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

  <!-- Site details -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="language" content="en">


  <!-- Character encoding -->

  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="post-credo.css">

  <!-- Document title -->

  <title>Post Credo Index</title>

</head>
<body>

<?php

require('db.php');

// echo "Post defines <br/>";

	$qry1 = "SELECT wsubject, wrelease, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks";
	$qry2 = " WHERE DATE_FORMAT(wrelease, '%Y%m%d%k%i') <= " . date("YmdHi") . " ORDER BY wrelease DESC";

// echo $qry1 . $qry2;


	$results = mysqli_query($con, $qry1.$qry2) or die(mysqli_error($con));
	
	echo "<form action=\"DataChange.php\" method=\"post\">";

	echo "<table><colgroup><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 75%;\"></colgroup>";
		
	while($row=mysqli_fetch_array($results))
	{
		$rdat = strtotime($row['wrelease']);
//		$rdat = strtotime($row['wrelease']->createdate);
		echo "<tr><td class=\"index_left\">" . $row['rdat'] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $row['wid'] . "\"> " . $row['wsubject'] . "</a></td></tr>";

	}
	echo "<tr><td><input type=\"password\" name=\"pwd\" style></td></tr>";	
	echo "</table>";
		
		// Free result set
	mysqli_free_result($results);
	
	mysqli_close($con);

?>

</body>

</html>
