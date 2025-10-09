<?php
$server = "localhost";
$username = "root";
$password = "";
$db_name = "data_database_scholarshipedit";

$conn = mysqli_connect($server, $username, $password, $db_name);
if (mysqli_connect_error()) {
	echo "Connection failed";
}
