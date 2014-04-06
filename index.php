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

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

echo "Post defines <br/>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

echo "Post connect server:" . DB_SERVER . "  user:" . DB_USER . "<br/>";
	
	mysql_select_db(DB_DATABASE) or die(mysql_error());

echo "Post select_db <br/>";
	
	$qry1 = "SELECT wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks";
	$qry2 = " WHERE DATE_FORMAT(wrelease, '%Y%m%d%k%i') <= " . date("YmdHi") . " ORDER BY wrelease DESC";

echo "Post create variables qry1:" . $qry1 . "  and  qry2:" . $qry2 . " <br/>";
	
	$results = mysql_query($qry1) or die(mysql_error());

	while($row=mysqli_fetch_array($results))
	{
		$rdat = strtotime($row['wrelease']->createdate);

		echo "<table><colgroup><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 75%;\"></colgroup>";
		echo "<tr><td class=\"index_left\">" . $row['rdat'] . " rdat </td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $row['wid'] . " wid \"> " . $row['wsubject'] . " subject </a></td></tr>";
		echo "</table>";
	}
mysql_close();

?>
</body>

</html>
