<?

	$hostname = "127.0.0.1";
	$username = "-Please Enter Username-";
	$password = "-Please Enter Password-";
	$database = "-Please Enter Database Name-";

	$mysqli = new mysqli($hostname, $username, $password, $database);

	if ($mysqli->connect_errno) {
		    printf("<br>Please check DB username/password in file db.php. Connect failed: %s\n", $mysqli->connect_error);
		    die();
	}

	$mysqli->query("SET NAMES utf8");
?>