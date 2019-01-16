<?php

include 'config.php';

$email = $_POST["email"];

$query = $mysqli->query("SELECT * FROM subs WHERE email='".$email."';");

$message = "Congratulations for signing up!";
$message .= "\nYou will now receive emails from this address regarding deals!";
$subject = "Subscribtion to Crazy Coop Creations";


if(mysqli_num_rows($query) > 0){
	echo 'Email Already Subscribed.';
}
else {
	if($mysqli->query("INSERT INTO subs (email) VALUE ('".$email."');")){
		echo 'Email inserted';
		mail($email, $subject, $message);
	}
}

header("location:index.php");

?>