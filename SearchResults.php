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


	if ($_POST["srchQ"]=="") {
		$_POST["srchQ"]=$_POST["srchA"];
	}

   if ($_POST["srchQ"]=="") {
		$_POST["srchQ"]="Blank";
   }

	$srchstrg = "%" . $_POST["srchQ"] . "%";


	require('db.php');

	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qquestion LIKE '" . $srchstrg . "' ORDER BY wid, qnum";
	
	$results = mysqli_query($con, $qry1);

	$qct = 0;
	$q= array();	
	while($row=mysqli_fetch_array($results)) {
		$q[$qct++]=array($row['wid'],$row['qnum'],$row['rdat'],$row['wsubject']);
	}


//echo "query of questions done";
//echo "array $q created [0][0] = " . $q[0][0] . " /[0][1] = " . $q[0][1] . " /[1][0] = " . $q[1][0] . " /[1][1] = " . $q[1][1];   

	if ($_POST["srchA"]=="") {
		$_POST["srchA"]=$_POST["srchQ"];
	}

	$srchstrg = "%" . $_POST["srchA"] . "%";

	$qry1 = "SELECT DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wsubject, wid, qnum FROM weeks INNER JOIN questions ON wid = qwid WHERE  qanswer LIKE '" . $srchstrg . "' ORDER BY wid, qnum";
	
	$results = mysqli_query($con, $qry1);

	$act = 0;
	$a= array();	
	while($row=mysqli_fetch_array($results)) {
		$a[$act++]=array($row['wid'],$row['qnum'],$row['rdat'],$row['wsubject']);
	}


//echo "query of answers done";
//echo "array $a created [0][0] = " . $a[0][0] . " /[0][1] = " . $a[0][1] . " /[1][0] = " . $a[1][0] . " /[1][1] = " . $a[1][1];   
	
	
	
//	mysqli_close($con);

	
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


if($_POST['srchQ']!="") {
	$txt1 = " results from QUESTIONS for ";
	if($_POST['srchA']!="") {
		$txt2 = " and from ANSWERS for ";
	} else {
		$txt2 = "";
	}
} else {
	$txt1 = "";
	if($_POST['srchA']!="") {
		$txt2 = " results from ANSWERS for ";	
	} else {
		$txt2 = "";
	}
}


	$longecho = "<span STYLE='font-size:100%; font-style:italic; color:black'>Showing" . $txt1 . "</span><span  STYLE='font-size:130%; font-style:italic; color:blue'> " . $_POST['srchQ'] . "</span>";
	$longecho .= "<span STYLE='font-size:100%; font-style:italic; color:black'>" . $txt2 . "</span><span  STYLE='font-size:130%; font-style:italic; color:blue'> " . $_POST['srchA'] . "\n</span>";
	echo $longecho."<br/><br/>";
		
	echo "<table><col width=: \"150\"><col width=: \"150\"><col width=: \"100\"><col width=: \"150\"><col width=: \"150\"><col width=: \"100\">";



// choos how long the 'while' should run for
$whct = $qct;
if($act>$qct) {
	$whct = $act;
}


while($lp++ <= $whct) {
		
		echo "<tr><td class=\"index_left\">" . $q[$lp][$dat] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Question.php?question=" . $q[$lp][$wid] . "\"> " . $q[$lp][$subj] . "</a></td>";
		if($q[$lp][$num]!="") {	
			echo "<td class=\"index_left\">Q " . $q[$lp][$num] . "</td>";	
		} else {
			echo "<td></td>";
		}
		echo "<td class=\"index_left\">" . $a[$lp][$dat] . "</td>";
		echo "<td class=\"index_right\"><a href=\"Answer.php?question=" . $a[$lp][$wid] . "\"> " . $a[$lp][$subj] . "</a></td>";
		if($a[$lp][$num]!="") {	
			echo "<td class=\"index_left\">A " . $a[$lp][$num] . "</td></tr>";	
		} else {
			echo "<td></td>";
		}

		
}

// question output, next do answer (on same line)

		echo "<tr></tr><tr><td class=\"td.t-link\"><a href=\"index.php\">Home</a></td><td class=\"td.t-link\"><a href=\"SearchFor.php\">New Search</a></td></tr>";	
		echo "</table>";

		
 mysqli_close($con);

?>

</body>

</html>
