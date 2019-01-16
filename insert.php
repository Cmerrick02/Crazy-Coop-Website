<?php

include 'config.php';

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if($mysqli->query("INSERT INTO users (fname, lname, email, password, username) VALUES('$fname', '$lname', '$email', '$password', '$username')")){
	echo 'Data inserted';
	echo '<br/>';
}

header ("location:login.php");

?>
