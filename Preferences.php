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
	
	if($Annony==1) {
		$Anon="Yes";
	} else {
		$Anon="No";
	}
	
	echo '<table>';
	echo '<tr>';
	echo '<td class="bl90i">If you prefer to record your results without being identified tick this box</td>';
	echo '<td class="bk200"><input type="checkbox" id="anon" value="' . $Anon . '">' . $Annony . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td class="bl90i">If you want to record you results for your own eyes only put a password (of your choosing) in this box</td>';
	echo '<td class "bl90i"><input type="text" id="priv" value="' . $Pwd . '"></td>';
	echo '</tr>';
	echo '<tr><td class="bk90">If you leave the fields unchecked and blank respectively, any results you record will be attributable to you and visible to everybody</td></tr>';
	echo '<tr><td class="bk90">If you want to keep a private record of your results then leave the box unchecked and enter a password</td></tr>';
	echo '<tr><td class="bk90">Results you do record (regardless of the above) will be used to help me try to pitch the questions - e.g. I will be able to see if any questions defeated everybody etc.</td></tr>'; 
	echo '</table>';
	
?>
	
	
	