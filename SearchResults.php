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
	$q= array();	
	while($row=mysql_fetch_array($results)) {
		$q[$qct++]=array($row['wid'],$row['qnum'],$row['rdat'],$row['wsubject']);
	}


//echo "query of questions done";
//echo "array $q created [0][0] = " . $q[0][0] . " /[0][1] = " . $q[0][1] . " /[1][0] = " . $q[1][0] . " /[1][1] = " . $q[1][1];   



	$srchstrg = "%" . $_POST["srchA"] . "%";


	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qanswer LIKE '" . $srchstrg . "' ORDER BY wid, qnum";
	
	$results = mysql_query($qry1) or die(mysql_error());

	$act = 0;
	$a= array();	
	while($row=mysql_fetch_array($results)) {
		$a[$act++]=array($row['wid'],$row['qnum'],$row['rdat'],$row['wsubject']);
	}


//echo "query of answers done";
//echo "array $a created [0][0] = " . $a[0][0] . " /[0][1] = " . $a[0][1] . " /[1][0] = " . $a[1][0] . " /[1][1] = " . $a[1][1];   
	
	
	
	mysql_close();

	
//  now put multiple questions (or answers) for a single week into a single line)
$wid=0;
$num=1;
$dat=2;
$subj=3;

$ct=1;			// start off pointing at the second entry (and refer backwards)) 

while ($ct<=$qct) {
// echo " ct is " . $ct . "   :";
//	if ($x[$ct][$wid]==$lastwid) {
	if ($q[$ct][$wid]==$q[$ct-1][$wid]) {
// echo " ct in if is " . $ct . "   :";
		$q[$ct-1][$num] .= ", " . $q[$ct][$num];		// append this number to previous question's entry
		array_splice($q,$ct,1);								// and get rid of this entry - index is automatically adjusted
		$qct--;													// decrement input count to allow for removed element
	}

	$ct++;

}


$ct=1;			// start off pointing at the second entry (and refer backwards)) 

while ($ct<=$act) {
// echo " ct is " . $ct . "   :";
//	if ($x[$ct][$wid]==$lastwid) {
	if ($a[$ct][$wid]==$a[$ct-1][$wid]) {
// echo " ct in if is " . $ct . "   :";
		$a[$ct-1][$num] .= ", " . $a[$ct][$num];		// append this number to previous answer's entry
		array_splice($a,$ct,1);								// and get rid of this entry - index is automatically adjusted
		$act--;													// decrement input count to allow for removed element
	}

	$ct++;

}




	echo nl2br("<span STYLE='font-size:100%; font-style:italic; color:black'>Showing results from questions for </span><span  STYLE='font-size:130%; font-style:italic; color:blue'> " . $_POST['srchQ'] . "\n</span>");
	
	echo "<table><colgroup><col span=\"1\" style=\"width=: 15%;\"><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 10%;\"><col span=\"1\" style=\"width=: 15%;\"><col span=\"1\" style=\"width=: 25%;\"><col span=\"1\" style=\"width=: 10%;\"></colgroup>";

// choos how long the 'while' should run for
$whct = $qct;
if($act>$qct) {
	$whct = $act;
}

while($lp++ <= $whct) {
		
		echo "<tr><td class=\"index_left\">" . $q[$lp][$dat] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $q[$lp][$wid] . "\"> " . $q[$lp][$subj] . "</a></td>";	
		echo "<td class=\"index_left\">Q " . $q[$lp][$num] . "</td></tr>";	
	
// question output, next do answer (on same line)
	
}
	
		echo "<tr></tr><tr><td class=\"td.t-link\"><a href=\"index.php\">Home</a></td><td class=\"td.t-link\"><a href=\"SearchFor.php\">New Search</a></td></tr>";	
		echo "</table>";

		
 mysql_close();

?>

</body>

</html>
