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

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$pid = htmlspecialchars($_GET["Pid"]);
	
	$id = htmlspecialchars($_GET["Question"]);
	
	$per_res = mysql_query("SELECT * FROM persons WHERE pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);
	$Who = $per_row['pname'];
	$email = $per_row['pemail'];
	$Privy = $per_row['Private'];
	$Pwd = $per_row['Password'];
	$Annony = $per_row['Annonymous'];
	
	if($Annony=='1') {
		$Anon="Yes";
	} else {
		$Anon="No";
	}
	
	echo '<table>';
	echo '<tr>';
	echo '<td>If you are happy to record your results without being identified tick this box</td>';
	echo '<td><input type="checkbox" id="anon" value="' . $Anon . '"></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>If you want to record you results for your own eyes only put a password (of your choosing) in this box</td>';
	echo '<td><input type="text" id="priv" value="' . $Pwd . '"></td>';
	echo '</tr>';
	echo '</table>';
	
?> 
	
	
	