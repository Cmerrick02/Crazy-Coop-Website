<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';

$username = $_SESSION['username'];
$newusername = $_POST["newusername"];
$result = $mysqli->query("SELECT * from users WHERE username='".$newusername."';");
$obj = $result->fetch_object();

if(mysqli_num_rows($result) > 0){
	echo 'username already exists. <a href="account.php">Go Back</a>';
}
else {
	if($mysqli->query("UPDATE users SET username='".$newusername."' WHERE username='".$_SESSION['username']."';")){
		echo 'Success';
		session_destroy();
		session_start();
		header("location:account.php");
	}
}


?>