<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Data Change</title>
</head>
<body>
<?php

$pwd=$_POST["pwd"];
$encore = htmlspecialchars($_GET["encore"]);


//$ddir = $_ENV["OPENSHIFT_DATA_DIR"] ;
//$myfile = fopen($ddir . "/pass.txt", "r") or die("Unable to open file!");
//$pword = fgets($myfile);
$pword = $_ENV["QUIZ_PASSWORD"];
//fclose($myfile);

if($encore=="1") {
	$pwd = $pword ;
}

if ($pwd == $pword )	{

echo "<nav>";
echo "<table width=\"200\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
echo "<tr></tr>";
echo "<td width=\"50%\"><a href=\"index.php\">Home</a></td>";
echo "<tr></tr></table>";
echo "</nav>";

require('db.php');

// this form lists the weeks and presents options to
// 		add a new week (in EditWeek),by re-displaying this form with a parameter set to Y and posting the values enneterd by the user
//		edit the week's questions(by linking to the EditWeek page)

	$ans = htmlspecialchars($_GET["new"]);	// new=Y or new=N

	$wk_res = mysqli_query($con, "SELECT wid, wsubject, DATE_FORMAT(wrelease, '%d %b %Y') AS rdat, wid from weeks ORDER BY wrelease DESC");


	echo "<table>";

	while($wk_row=mysqli_fetch_array($wk_res))
	{
		echo "<tr><td class=\"bk80\">" . $wk_row['rdat'] . "</td>";
		echo "<td class=\"bk80\"><a href=\"EditWeek.php?wid=" . $wk_row['wid'] . "\">" . $wk_row['wsubject'] . "</a></tr>";
	}
	echo "</table>";

//	if ($ans == "Y")
//	{
		echo "<form action=\"AddWeek.php\" method=\"post\">";
		echo "Add: <input type=\"hidden\" name=\"add\" value=\"Y\"><br>";
		echo "Subject: <input type=\"text\" name=\"subject\"><br>";
		echo "Comment: <input type=\"text\" name=\"comment\"><br>";
		echo "Release Date: <input type=\"text\" name=\"release_date\"><br>";
		echo "<input type=\"submit\" value=\"SAVE\">";
		echo "</form>";
//	}


	echo "<p></p><a href=\"index.php\">Home</a>";

	}
	
		mysqli_close($con);
		
?>
</body>

</html>


