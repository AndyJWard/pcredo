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

	$srchstrg = "%" . $_POST["srchQ"] . "%";


	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

// echo "Post defines <br/>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qquestion LIKE '" . $srchstrg . "' ORDER BY wid, qnum";
	
	$results = mysql_query($qry1) or die(mysql_error());

	$qct = 0;
	$qwid = array();
	$qnum = array();
	$qrdat = array();
	$qsubj = array();
	while($row=mysql_fetch_array($results)) {
		$qwid[$qct] = $row['wid'];
		$qnum[$qct] = $row['qnum'];
		$qrdat[$qct] = $row['rdat'];
		$qsubj[$qct++] = $row['wsubject'];			// includes increment of $qct
	}
//echo "query of questions done";


	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qanswer LIKE '" . $srchstrg . "' ORDER BY wid, qnum";
	
	$results = mysql_query($qry1) or die(mysql_error());

	$act = 0;
	$awid = array();
	$anum = array();
	$ardat = array();
	$asubj = array();
	while($row=mysql_fetch_array($results)) {
		$awid[$act] = $row['wid'];
		$anum[$act] = $row['qnum'];
		$ardat[$act] = $row['rdat'];
		$asubj[$act++] = $row['wsubject'];			// includes increment of $act
	}
	
	mysql_close();
	

	echo nl2br("<span STYLE='font-size:100%; font-style:italic; color:black'>Showing results from questions for </span><span  STYLE='font-size:130%; font-style:italic; color:blue'> " . $_POST['srchQ'] . "\n</span>");
	
	echo "<table><colgroup><col span=\"1\" style=\"width=: 15%;\"><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 10%;\"><col span=\"1\" style=\"width=: 15%;\"><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 10%;\"></colgroup>";


	$lastwid = "";	
	$nums = "";

	$ctout=0;	
	while ($ctout!=$qct) {

		if($lastwid==""){
			
			$lastwid = $qwid[$ctout];		
			$nums = $qnum[$ctout];
			$dats = $rdat[$ctout];
			$subj = $qsubj[$ctout++];
		
		} else {

			if ($qwid[$qct] == $lastwid) {

				$nums = $nums . ", " . $qnum[$qct++];
		
			} else {
		
				echo "<tr><td class=\"index_left\">" . $dats . "</td>";
				echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $lastwid . "\"> " . $subj . "</a></td>";	
				echo "<td class=\"index_left\">Q " . $nums . "</td></tr>";	

			$lastwid = $qwid[$ctout];		
			$nums = $qnum[$ctout];
			$dats = $rdat[$ctout];
			$subj = $qsubj[$ctout++];
		
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
