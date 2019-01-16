<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';

$query = $mysqli->query("SELECT * FROM users WHERE username ='".$_SESSION['username']."';");
$obj = $query->fetch_object();

if($obj->darkmode == 1) {
	$mysqli->query("UPDATE users SET darkmode=2 WHERE id=".$obj->id.";");
}
else {
	$mysqli->query("UPDATE users SET darkmode=1 WHERE id=".$obj->id.";");
}
header("location:index.php");
?>