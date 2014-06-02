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

	define( "DB_SERVER",    getenv('OPENSHIFT_MYSQL_DB_HOST') );
	define( "DB_USER",      getenv('OPENSHIFT_MYSQL_DB_USERNAME') );
	define( "DB_PASSWORD",  getenv('OPENSHIFT_MYSQL_DB_PASSWORD') );
	define( "DB_DATABASE",  getenv('OPENSHIFT_APP_NAME') );

	mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

	mysql_select_db(DB_DATABASE) or die(mysql_error());
	
	echo '<nav>';
	echo '<table width="800"><tr align="left" style="font-size: 12; color: black;">';
	echo '<tr></tr>';
 	echo '<td width="40%" align="center">';
 	echo '<select style="width: 170px;" id="WHO" size="1" onchange="redirect_post(ViewResults.php)">';
 	echo '<option value="0">Record Your Score';
	$per_res = mysql_query("SELECT * FROM persons ORDER BY Pname");
// find the names for the select field (to save results);
 	while ($per_row = mysql_fetch_array($per_res))
 		{			
 		echo '<option value="' . $per_row['Pid'] . '">' . $per_row['Pname'] . '</option>';
 		}
 	echo "</td>";
 	echo "<td width=\"30%\" class=\"bk90i\"><a href=\"ViewResults.php\">View the recorded results</a></td>";
	echo "<td width=\"15%\" class=\"bk90i\"><a href=\"Question.php?question=" . $id . "\">Questions</a></td>";
	echo "<td width=\"15%\" class=\"bk90i\"><a href=\"index.php\">Home</a></td>";
	echo "<tr></tr></table>";
	echo "</nav>";
?>
<script type="text/javascript" >
function who_change(id) {
	var x=document.getElementById("WHO");
	var pid=x.value;
	var redirect = "Record.php?Question=" + id + "&Pid=" + pid;
	document.location.href = redirect;
}
function redirect_post(url) {
	var x=document.getElementById("WHO");
	var pid=x.value;
    $('<form />')
      .hide()
      .attr({ method : "post" })
      .attr({ action : url})
      .append($('<input />')
        .attr("type","hidden")
        .attr({ "name" : "Pid" })
        .val(pid)
      )
      .append('<input type="submit" />')
      .appendTo($("body"))
      .submit();
}
</script>