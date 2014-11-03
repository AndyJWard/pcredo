<?php 
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Europe/London'); 
ob_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>

  <!-- Site details -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="language" content="en">

  <!-- Character encoding -->

  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="post-credo.css">

  <!-- Document title -->

  <title>Json File Import</title>

</head>
<body>

<?php

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );
	
	
	$FileHome = getenv('OPENSHIFT_DATA_DIR');
echo $FileHome . "<br><br>";

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());


//	$post_wid = htmlspecialchars($_GET["wid"]);		// only set after we have added the blanks in first pass


// echo $FileHome . "QDataR.js" . "<br><br>";


$data =file_get_contents($FileHome . "QDataR.js");

$result = json_decode($data, true);

//echo "var_dump of $result from json_decode<br>";

//var_dump($result);

$a = json_encode( array('a'=>1, 'b'=>2, 'c'=>'I <3 JSON') );
echo $a."<br>";

// Outputs: {"a":1,"b":2,"c":"I <3 JSON"}
$b = json_decode( $a );

echo "$b->a, $b->b, $b->c"."<br>";
// Outputs: 1, 2, I <3 JSON

echo "weeks   "."$result->weeks"."<br>";



// echo "<br> using -> to get qhead <br>". $result->week ."<br><br>";

//echo "<br><br><br><br>And now for the loop<br>";

//foreach ($result as $weeks=>$weeksvalue) { 		// weeks is also an array
//	foreach ()
//    if (isset($week['ending'])) {
//        foreach ($group['items'] as $item) {
//            if (isset($item['venue'])) {
					echo "wheres the value";
                echo "0/0   ".$result[0][0]."<br>";
                echo "0/0/0   ".$result[0][0][0]."<br>";
                echo "0/0/1   ".$result[0][0][1]."<br>";
//            }
//        }
//    }
//}


echo "that was week <br>";

echo "Question 1 week 1?: ".$data["weeks"]["week"]["questions"]["q"][0]."<br>";
echo "Question 1 week 1?: ".$data["weeks"]["week"]["questions"]["q"][1]."<br>";
// echo "hello";
echo "Weeks 0: " . $data["weeks"][0] . "<br>";
echo "Weeks 1: " . $data["weeks"][1] . "<br>"; 
// echo var_dump(json_decode($data, $assoc = null);)

	mysql_close();


?>

</body>

</html>


