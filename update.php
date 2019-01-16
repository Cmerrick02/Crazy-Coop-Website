<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';

$ogpassword = $_POST["ogpassword"];
$password = $_POST["password"];
$result = $mysqli->query("SELECT * from users WHERE username='".$_SESSION['username']."';");
$obj = $result->fetch_object();


if($ogpassword === $obj->password && $password!=""){
	if($mysqli->query("UPDATE users SET password='".$password."' WHERE username='".$_SESSION['username']."';")){
		echo 'Success';
		header("location:success.php");
	}
}
else {
	echo 'Wrong Password. <a href="account.php">Go Back</a>';
}

?>