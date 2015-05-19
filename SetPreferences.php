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
<title>Post Credo SetPreferences</title>
</header>

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

	$pid = $_SESSION["PersonId"];
	$wid = $_SESSION["WeekId"];
	
	echo "pid pid " . $pid . "<br>";

	$per_res = mysql_query("SELECT * FROM persons WHERE Pid =" . $pid . " limit 1");
	$per_row = mysql_fetch_assoc($per_res);
	$Who = $per_row['Pname'];
	$email = $per_row['Pemail'];
	$Pwd = $per_row['Password'];
	$Annony = $per_row['Annonymous'];
	$Pub = $per_row['Publish'];
	$Recy = $per_row['Receive'];
	$Sec = $per_row['Secret'];
	
	echo "Person " . $Who . "<br>;
	
	echo '<form action="SavePreferences.php" method="post">';
	echo '<input type="hidden" name="Pid" value="' . $pid . '">';
	echo '<table>';
	echo '<tr><td class="bl"><input type="text" value="' . $Who . '" name="person" size="50"></td></tr>';
	echo '<tr></tr><tr>';
	echo '<td class="bk90i"><input type="text" value="' . $email . '" name="email" size="60"></td>';
	echo '</tr>';
		
	echo '<tr>';
	echo '<td class="bl90i" width="70%">Do you want scores that you record kept secret?</td>';
if($Sec=="Y") {
	echo '<td class="bk100"><input type="radio" name="secret" value="Y" checked="checked"/>Yes';
}
else {
		echo '<td class="bk100"><input type="radio" name="secret" value="Y"/>Yes';
	}
if($Sec=="N") {
	echo '   <input type="radio" name="secret" value="N" checked="checked"/>No';
}
else {
		echo '   <input type="radio" name="secret" value="N" />No';
	}
	echo '</tr>';
		
	echo '<tr>';
	echo '<td class="bl90i" width="70%">Do you want to record your scores anonymously? (you will not be able to see your performance but your scores will count toward the averages)</td>';	
if($Annony=="Y") {
	echo '<td class="bk100"><input type="radio" name="anon" value="Y" checked="checked"/>Yes';		
}
else {
		echo '<td class="bk100"><input type="radio" name="anon" value="Y"/>Yes';
	}	
if($Annony=="N") {
	echo '   <input type="radio" name="anon" value="N" checked="checked"/>No';		
}
else {
		echo '   <input type="radio" name="anon" value="N"/>No';
	}	
	echo '</tr>';

	echo '<tr>';
	echo '<td class="bl90i" width="70%">Do you want to receive emails about results other people have recorded?</td>';
if($Recy=="Y") {
	echo '<td class="bk100"><input type="radio" name="receive" value="Y" checked="checked"/>Yes';		
}
else {
		echo '<td class="bk100"><input type="radio" name="receive" value="Y"/>Yes';
	}	
if($Recy=="N") {
	echo '   <input type="radio" name="receive" value="N" checked="checked"/>No';		
}
else {
		echo '   <input type="radio" name="receive" value="N"/>No';
	}	
	echo '</tr>';	

	echo '<tr>';
	echo '<td class="bl90i" width="70%">Do you want to send emails to other people about your recorded results</td>';
if($Pub=="Y") {
	echo '<td class="bk100"><input type="radio" name="publish" value="Y" checked="checked"/>Yes';		
}
else {
		echo '<td class="bk100"><input type="radio" name="publish" value="Y"/>Yes';
	}	
if($Pub=="N") {
	echo '   <input type="radio" name="publish" value="N" checked="checked"/>No';		
}
else {
		echo '   <input type="radio" name="publish" value="N"/>No';
	}	
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
	
	
	