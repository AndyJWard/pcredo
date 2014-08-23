<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/London');
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

  <!-- Site details -->
  <meta name="description" content="Warwick Cheer Academy">
  <meta name="keywords" content="">
  <meta name="language" content="en">
  
  <!-- Character encoding -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="wca.css">

  <!-- Document title -->
  <title>Warwick Cheer Academy</title>

</head>
<body>
<form enctype="multipart/form-data" action="UploadAdd.php" method="POST"> 
 Name: <input type="text" name="name"><br> 
 Category: <input type="text" name = "category"><br> 
 Caption: <input type="text" name = "caption"><br> 
 Photograph: <input type="file" name="photo"><br>
 Holder (where it gets put): <input type="text" name="holder"><br> 
 <input type="submit" value="Add"> 
 </form>
 </body>
 </html>