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
<title>Save Preferences</title>
</header>

<?php
$pid = htmlspecialchars($_GET["Pid"]);

if (isset($_POST['cancel'])) {
	echo '<meta http-equiv="refresh" content="0;URL=Preferences.php?Pid=' . $pid . '">';	
}
if (isset($_POST['save'])){
		
	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());

//	$id = htmlspecialchars($_GET["Question"]);
	
	$Who = $_POST['person'];
	$email = $_POST['email'];

	if (isset($_POST['secret'])) { 
		$secret= $_POST['secret']; 
	}

	if(isset($_POST['anon'])) {
		$Annony = $_POST['anon'];
	}
	
	if(isset($_POST['receive'])) {
		$receive = $_POST['receive'];
	}
	
	if(isset($_POST['publish'])) {
		$publish = $_POST['publish'];
	}
	
	$Pwd = $_POST['pwd'];
		
	$query= 'UPDATE persons SET Pname="' . $Who . '", Pemail="' . $email . '", Password="' . $Pwd . '", Annonymous="' . $Annony . '", Publish="' . $publish . '", Receive="' . $receive . '", Secret="' . $secret . '" WHERE pid=' . $pid . ' limit 1';
//	$per_row = mysql_fetch_assoc($per_res);
//echo $query;
	mysql_query($query);
	mysql_close();

foreach ($_POST as $key => $value)
 echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
		
}
?>
	
	
	