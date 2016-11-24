<?php 	
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/London'); 
ob_start();
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

  <title>Search Results</title>

</head>
<body>

<?php

	$srchstrg = "%" . $_POST["srch"] . "%";

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

// echo "Post defines <br/>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

//	$srchstrg = "%dog%";

	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qquestion LIKE '" . $srchstrg . "' ORDER BY wid";
	
//	echo $qry1;

//	$qry1 = "SELECT wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks";
//	$qry2 = " WHERE DATE_FORMAT(wrelease, '%Y%m%d%k%i') <= " . date("YmdHi") . " ORDER BY wrelease DESC";

// echo $qry1 . $qry2;

//	$results = mysql_query($qry1.$qry2) or die(mysql_error());
	$results = mysql_query($qry1) or die(mysql_error());
	
//	echo "<form action=\"DataChange.php\" method=\"post\">";

	echo "<table><colgroup><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 75%;\"></colgroup>";
	
		
	while($row=mysql_fetch_array($results))
	{
		$rdat = strtotime($row['wrelease']->createdate);
		

		echo "<tr><td class=\"index_left\">" . $row['rdat'] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $row['wid'] . "\"> " . $row['wsubject'] . "</a></td>";
		echo "<td class=\"index_left\">Question " . $row['qnum'] . "</td></tr>";

	}
//	echo "<tr><td><input type=\"password\" name=\"pwd\" style></td></tr>";	
		echo "</table>";
mysql_close();

?>

</body>

</html>
