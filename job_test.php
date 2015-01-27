<?php
$hostname = 'localhost';	
$username = 'root'; 
$password = '';
$dbName   = 'testtask';
$link = mysqli_connect($hostname, $username, $password, $dbName) or die('No connect with data base');

function clearInput($data) {
	global $link;
	return mysqli_real_escape_string($link, trim(strip_tags($data)));
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["tel"]) && !empty($_POST["tel"])
	&& isset($_POST["name"]) && !empty($_POST["name"])
	&& isset($_POST["text"]) && !empty($_POST["text"])) {
		
		$tel = clearInput($_POST["tel"]);
		$name = clearInput($_POST["name"]);
		$text = clearInput($_POST["text"]);
		$checkbox = (isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) ? (int)$_POST["checkbox"] : 0;
		
		$sql = "INSERT INTO task3(tel, name, text, checkbox) VALUES(" . $_POST["tel"] . ", " . $_POST["name"] . ", " . $_POST["text"] . ", " . $checkbox . ")";
		
		mysqli_query($link, $sql) or die(mysqli_errno($link) . " - " . mysqli_error($link));
		header("Location: " . $_SERVER["REQUEST_URI"]);
		exit;
		
	} else {
		/*Информируем пользователя о неправильно заполненной форме.*/
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="windows-1251">
<title>Task 3</title>
</head>
<body>
<form method="POST">
<input type="text" name="tel" /> <label for="tel">Phone</label><br /><br />
<input type="text" name="name" /> <label for="name">Name</label><br /><br />
<input type="text" name="text" /> <label for="tel">Text</label><br /><br />
<input type="checkbox" name="checkbox" value="1" /> <label for="tel">Login</label><br /><br />
<input type="submit" value="Send" />
</form>
</body>
</html>