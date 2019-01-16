<?php



if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';


$email = $_POST['email'];
$name = $_POST['Name'];
$text = $_POST['text'];


$message = "".$email."\n".$name."\n".$text."\n";
$dest = "cjmerrick@pstcc.edu";
$sub = "Contact";
mail($dest, $sub, $message);

header("location:index.php");



?>