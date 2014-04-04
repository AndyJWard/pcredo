<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

  <!-- Site details -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="language" content="en">
  <meta name="copyright" content="&copy; 2003-2007 Zymic.com. All rights reserved">

  <!-- Character encoding -->

  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="post-credo.css">



  <!-- Document title -->

  <title>Post Credo Index</title>

</head>
<body>

<?php

	$db=mysqli_connect("localhost","898695_app","quizapp","pcredo_zxq_quiz");
	if(mysqli_connect_errno())
		{
		echo "failed MYSQL connect:  ".mysqli_connect_error();
		}
	$qry1 = "SELECT wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks";
	$qry2 = " WHERE DATE_FORMAT(wrelease, '%Y%m%d%k%i') <= " . date("YmdHi") . " ORDER BY wrelease DESC";
// echo $qry1 . $qry2;

	$results = mysqli_query($db , $qry1 . $qry2);

//	$results = mysqli_query($db , "SELECT wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks ORDER BY wid DESC");

	while($row=mysqli_fetch_array($results))
	{
		$rdat = strtotime($row['wrelease']->createdate);

		echo "<table><colgroup><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 75%;\"></colgroup>";
		echo "<tr><td class=\"index_left\">" . $row['rdat'] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $row['wid'] . "\"> " . $row['wsubject'] . "</a></td></tr>";
		echo "</table>";
	}



?>
</body>

</html>
