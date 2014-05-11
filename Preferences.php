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
	
	// $id = htmlspecialchars($_GET["Question"]);
	
	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);
	$Who = $per_row['Pname'];
	$email = $per_row['Pemail'];
	$Privy = $per_row['Private'];
	$Pwd = $per_row['Password'];
	$Annony = $per_row['Annonymous'];
	$Recy = $per_row['Receive'];
	$Pub = $per_row['Publish'];
	$Sec = $per_row['Secret'];
	
	
	echo '<form action="SavePreferences.php?Pid='. $pid . '" method="post">';
	
	echo '<table>';
	echo '<tr><td class="bl"><input type="text" value="' . $Who . '" name="person" size="50"></td></tr>';
	echo '<tr></tr><tr>';
	echo '<td class="bk90i"><input type="text" value="' . $email . '" name="email" size="60"></td>';
	echo '</tr>';
		
	echo '<tr>';
	echo '<td class="bl90i" width="70%">If you want scores that you record kept secret then tick this box</td>';
if($Sec=="Y") {
	echo '<td class="bk200"><input type="radio" name="secret" value="Yes" checked="checked"/>Yes';
}
else {
		echo '<td class="bk200"><input type="radio" name="secret" value="Yes"/>Yes';
	}
if($Sec=="N") {
	echo '<td class="bk200"><input type="radio" name="secret" value="No" checked="checked"/>No';
}
else {
		echo '<td class="bk200"><input type="radio" name="secret" value="No" />No';
	}
//	echo '<td class="bk200"><input type="checkbox" id="secret" name="secret"  value=' . $Secret . '></td>';
	echo '</tr>';	
	
	if($Annony=="N") {
		$Anon='"No"';
	} else {
		$Anon='"Yes" checked';
	}	
	echo '<tr>';
	echo '<td class="bl90i" width="70%">If you want to record your scores anonymously (you will not be able to see your performance but your scores will count toward the averages) tick this box</td>';
	echo '<td class="bk200"><input type="checkbox" id="anon" value=' . $Anon . '></td>';
	echo '</tr>';

	if($Recy=="N") {
		$Receive;
	} else {
		$Receive='"Yes" checked';
	}	
	echo '<tr>';
	echo '<td class="bl90i" width="70%">To receive emails about results other people have recorded tick this box</td>';
	echo '<td class="bk200"><input type="checkbox" id="receive" value=' . $Receive . '></td>';
	echo '</tr>';	

	if($Pub=="N") {
		$Publish;
	} else {
		$Publish='"Yes" checked';
	}	
	echo '<tr>';
	echo '<td class="bl90i" width="70%">To send emails about other people about your recorded results tick this box</td>';
	echo '<td class="bk200"><input type="checkbox" id="publish" value=' . $Publish . '></td>';
	echo '</tr>';		
	
	echo '<tr>';
	echo '<td class="bl90i" width="70%">Create a password to control access to your scores</td>';
	echo '<td class "bl90i"><input type="text" value="' . $Pwd . '" name="pwd" size="40"></td>';
	echo '</tr>';

	echo '</table><table>';
	//echo '<tr><td class="bk90" width="70%">If you leave the fields unchecked and blank respectively, any results you record will be attributable to you and visible to everybody</td></tr>';
	//echo '<tr><td class="bk90" width="70%">If you want to keep a private record of your results then leave the box unchecked and enter a password</td></tr>';
	//echo '<tr><td class="bk90" width="70%">Results you do record (regardless of the above) will be used to help me try to pitch the questions - e.g. I will be able to see if any questions defeated everybody etc.</td></tr>'; 
	//echo '<tr></tr>';
	echo '<tr>';
	echo '<td class="bk90i"><input type="submit" value="Save" name="save"></td>';
	echo '<td class="bk90i"><input type="submit" value="Cancel" name="cancel"></td>';
	echo '</tr>';

	echo '</table>';
	
?>
	
	
	