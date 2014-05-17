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
<title>My Results</title>
</header>

<?php

$pid = htmlspecialchars($_GET["Pid"]);

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());
	
	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");	
	$per_row = mysql_fetch_assoc($per_res);
	
//	foreach ($_POST as $key => $value) {
//		echo "Field " . htmlspecialchars($key) . " is " . htmlspecialchars($value) . "<br>";
//	}

	$Display="Y";									// assume passwords match or that none is required

	if ($per_row['Password']>'') {			// test if there is a password
		$Display="N";								// don't display unless the password matches
		if($_POST['password']==$per_row['Password']) {
			$Display="Y";							// password matches so OK to display	
		}
	}



if($Display=="Y") {

	echo "<table width=\"1200\">";

	$query = 'SELECT DATE_FORMAT(wrelease, "%d %b %Y") AS rdat, wsubject, COUNT(Result) AS Correct FROM results LEFT JOIN weeks ON results.Wid=weeks.wid  WHERE Result="Y" AND Pid=' . $pid . ' GROUP BY Pid, results.Wid';
	
	$res = mysql_query($query);
	
	if(mysql_num_rows($res) == 0) {
		echo '<tr><td class="bk90">Sorry, you have no results recorded</td><td class="bk100"><a href="ViewResults.php?Pid=' . $pid . '">Back</a></td></tr>';
	}
	else {
		while ($row = mysql_fetch_array($res))
			{
			echo '<tr><td class="bk80" style="width:10%">' . $row['rdat'] . '</td>';
			echo '<td class="bk80" style="width:40%">' . $row['wsubject'] . '</td>';
			echo '<td></td><td class="bl80">' . $row['Correct'] . '</td></tr>';
			}
	}
	
	echo "</table>";
}
else {
	echo '<tr><td class="bk90">Sorry, wrong password</td><td class="bk100"><a href="ViewResults.php?Pid=' . $pid . '">Back</a></td></tr>';
}
	mysql_close();
	

?>
	
	
	