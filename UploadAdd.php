<?php 
 	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Europe/London');
	ob_start();
 	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
 	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
 	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
 	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );
 	$upload = $_ENV["OPENSHIFT_DATA_DIR"] ;
 
 //This is the directory where images will be saved 
 $target = $upload . basename( $_FILES['photo']['name']); 
 
 //This gets all the other information from the form 
 $name=$_POST['name']; 
 $caption=$_POST['caption']; 
 $category=$_POST['category']; 
 $pic=($_FILES['photo']['name']); 
 
 // Connects to your Database
 mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());  New	
 mysql_select_db(DB_DATABASE) or die(mysql_error()); 
 
 // $qry="INSERT INTO `images` (image_name, image_category, image_caption, image) VALUES ('$name', '$category', '$caption', '$pic')";

 //Writes the information to the database 
 mysql_query($qry) ; 


 // Writes the photo to the server in .../app-root/data/images/  - $OPENSHIFT_DATA_DIR/images/
 // for reading they are referenced by the symbolic link to images in .../app-root/runtime/repo/images - $OPENSHIFT_REPO_DIR/images 
 if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
 { 
 
 //Tells you if its all ok 
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
 else { 
 
 //Gives and error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 } 
 ?> 