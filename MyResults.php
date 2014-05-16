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
echo $pid . '<br>';
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());
	
	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");	
	$per_row = mysql_fetch_assoc($per_res);
	
echo 'password from db ' . $per_row['Password'] . '</br>';	
	// test if there is a password
	if($per_row['Password']>'') {		
		if (isset($_POST['password'])){
			// can't display beacause no password no match
			$Display="N";		
			if ($per_row['Password']==$_POST(['password']) {
				// password matches so OK to display
				$Display="Y";		
			}		 
		}
	}
	else {
		$Display="Y";
		// we can display as no password is on file
	}
echo "Display " . $Display;
$Display="Y";
if($Display=="Y") {

	echo "<table width=\"1200\">";

	$query = 'SELECT wrelease, wsubject, COUNT(Result) AS Correct FROM results LEFT JOIN weeks ON results.Wid=weeks.wid  WHERE Result="Y" AND Pid=' . $pid . ' GROUP BY Pid, results.Wid';
	
	$res = mysql_query($query);

	while ($row = mysql_fetch_array($res))
		{
		echo '<tr><td class="bk80" style="width:10%">' . $row['wrelease'] . '</td>';
		echo '<td class="bk80" style="width:40%">' . $row['wsubject'] . '</td>';
		echo '<td></td><td class="bl80">' . $row['Correct'] . '</td></tr>';
		}

	echo "</table>";
}
else {
	echo 'Sorry wrong password';
}
	mysql_close();
	
//foreach ($_POST as $key => $value)
// echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
?>
	
	
	