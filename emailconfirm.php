<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Email Confirmation Tutorial</title>
</head>

<body>
<?php

require "dbc.php";

$username = $_GET['username'];
$code = $_GET['code'];

$link = mysqli_connect("localhost", "qazolympalpha", "Simp2001", "qazolymp_alpha") or die($link);
	
$query = mysqli_query($link, "SELECT * FROM `logins` WHERE `username`='$username'");
//while($row = mysql_fetch_assoc($query))
//{
	$row = mysqli_fetch_assoc($query);
	$db_code = $row['confirm-code'];
//}
if($code == $db_code)
{
	mysqli_query($link, "UPDATE `logins` SET `confirmed`='1'");
	mysqli_query($link, "UPDATE `logins` SET `confirm-code`='0'");
	
	echo "Спасибо вам. Ваша почта теперь подтверждена, вы можете войти.";
}
else
{
	echo "Ссылка устарела, запросите новую.";	
}

?>
</body>
</html>