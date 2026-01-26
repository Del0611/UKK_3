<?php

$servername= "localhost";
$user= "root";
$password = "";

$db_name = "asabri";

$conn = mysqli_connect($servername, $user, $password, $db_name);

if (!$conn) {
	echo "Connection gagal!";
} else {
	echo "";
}
