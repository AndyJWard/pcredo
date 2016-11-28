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

	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qquestion LIKE '" . $srchstrg . "' ORDER BY wid";
	
	$results = mysql_query($qry1) or die(mysql_error());

	echo nl2br("<span STYLE='font-size:100%; font-style:italic; color:black'>Showing results for </span><span  STYLE='font-size:130%; font-style:italic; color:blue'> " . $_POST['srch'] . "\n</span>");
	
	echo "<table><colgroup><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 50%;\"><col span=\"1\" style=\"width=: 25%;\"></colgroup>";


	$lastwid = "";	
	$nums = "";

	while($row=mysql_fetch_array($results)) {
		if($lastwid==""){
			
			$lastwid = $row['wid'];		
			$nums = $row['qnum'];
			$rdat = $row['rdat'];
			$subj = $row['wsubject'];
		
		} else {

			if ($row['wid'] == $lastwid) {

				$nums = $nums . ", " . $row['qnum'];
		
			} else {
		
//				if ($nums == "")	{

//					$nums = $row['qnum'];
			
//				}	
		
				echo "<tr><td class=\"index_left\">" . $rdat . "</td>";
				echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $lastwid . "\"> " . $subj . "</a></td>";	
				echo "<td class=\"index_left\">Q " . $nums . "</td></tr>";	


				$lastwid = $row['wid'];
				$nums = $row['qnum'];
				$rdat = $row['rdat'];
				$subj = $row['wsubject'];
		
			}
		}
	}
	
		echo "<tr><td class=\"index_left\">" . $rdat . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $lastwid . "\"> " . $subj . "</a></td>";	
		echo "<td class=\"index_left\">Q " . $nums . "</td></tr>";	
	
		echo "<tr></tr><tr><td class=\"td.t-link\"><a href=\"index.php\">Home</a></td><td class=\"td.t-link\"><a href=\"SearchFor.php\">New Search</a></td></tr>";	
		echo "</table>";

		
mysql_close();

?>

</body>

</html>
