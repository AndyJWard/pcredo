<?php

$loc = $_SERVER["HTTP_HOST"];

if($loc=="localhost"){

	define( "DB_SERVER",'localhost' );
	define( "DB_USER",'root');
	define( "DB_PASSWORD",'');
	define( "DB_DATABASE",'pcredo');

} else {

	define( "DB_SERVER",    getenv('MYSQL_SERVICE_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );
}

	$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD);
	if (mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	mysqli_select_db($con, DB_DATABASE);

?>