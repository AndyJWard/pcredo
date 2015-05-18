<?php 	
header('Content-Type: text/html; charset=utf-8');
ob_start();
?>
 
<head>
<!--[if lt IE 9]>
<script src="html5shiv.js"></script>
<![endif]-->
</head>
<header>
<link rel="stylesheet" type="text/css" href="post-credo.css">
<title>Post Credo Record</title>
</header>

<!-- onchange event for person selector - used to set default privacy choice to the recorded one -->

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$id = htmlspecialchars($_GET["question"]);

	echo "<nav>";
	echo '<form action="Record1.php" method="post">';
	echo '<input type="hidden" name="Qid" value="' . $id . '">';
	echo "<table width=\"800\"><tr align=\"left\" style=\"font-size: 12; color: black;\">";
	echo "<tr></tr>";
 	echo "<td width=\"40%\" align=\"center\">";
 	
 	echo '<select style="width: 170px;" id="WHO" name="Pid" size="1")>';
 	
 	echo "<option value=\"0\">Choose Your Name";
	$per_res = mysql_query("SELECT * FROM persons ORDER BY Pname");
// find the names for the select field (to save results);
 	while ($per_row = mysql_fetch_array($per_res))
 		{			
 		echo '<option value="' . $per_row['Pid'] . '">' . $per_row['Pname'] . '</option>';
 		}
 	echo '</td><tr></tr>';
 	echo '<td width="30%" class="bk90i">Enter Your Password (if you have already set one)<input type="text" name="Pwd">  <input type="submit" value="Go"></td><tr></tr>';
	echo "<td width=\"15%\" class=\"bk90i\"><a href=\"Question.php?question=" . $id . "\">Questions</a></td><tr></tr>";
	echo "<td width=\"15%\" class=\"bk90i\"><a href=\"index.php\">Home</a></td>";
	echo "<tr></tr></table>";
	echo "</nav>";

	
	mysql_close();

?>

<script type="text/javascript" >
function who_change(id) {
	var x=document.getElementById("WHO");
	var pid=x.value;
	var redirect = "Record1.php?Question=" + id + "&Pid=" + pid;
	document.location.href = redirect;
}
</script>
