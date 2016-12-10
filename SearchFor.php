<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
?>
 
<head>
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<![endif]-->
</head>
<header>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Search For</title>
</header>

<!-- onchange event for person selector - used to set default privacy choice to the recorded one -->

<?php



	echo "<nav>";
	echo '<form action="SearchResults.php" method="post">';
	echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
	echo "<tr></tr>";
// 	echo "<td width=\"40%\" align=\"center\">";
 	
//  	echo '<td width="30%" class="bk90i">Enter the word or phrase you want to search the QUESTIONS for <input type="text" name="srchQ">  <input type="submit" value="Go"></td><tr></tr>';
  	echo '<td width="30%" class="bk90i">Enter the word or phrase you want to search the QUESTIONS for <input type="text" name="srchQ"></td><tr></tr>';
	
	echo "<tr></tr>";
	echo '<td width="30%" class="bk90i">Enter the word or phrase you want to search the ANSWERS for <input type="text" name="srchA">  <input type="submit" value="Go"></td><tr></tr>';
	
	echo "</table>";
	echo "</nav>";


?>


