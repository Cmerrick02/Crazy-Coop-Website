<?php



if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';

if(isset($_SESSION['cart'])) {
	$message = "";
	$subject = "order";
	$query = $mysqli->query("SELECT * from users WHERE username='".$_SESSION['username']."';");
	$obj = $query->fetch_object();
	
	$email = $obj->email;
	$total = 0;
  foreach($_SESSION['cart'] as $product_id => $quantity) {
	$result = $mysqli->query("SELECT * from products WHERE id=".$product_id.";");
	$obju = $result->fetch_object();
	$cost = $obju->price * $quantity;
	$total = $total + $cost;
	$tax = 0.09;
	$grandtotal = ($total * $tax) + $total;
	$message .= "".$obju->product_name." - ".$quantity."\n";

	
  }
  $message .= "\n------------------------------------------------\n";
  $message .= "\nTotal with Tax: $".$grandtotal."";
  $sent = mail($email, $subject, $message);
  if($sent) {
	  $message = "";
  }
  else {
	  echo 'Failuer';
  }
}

unset($_SESSION['cart']);
header("location:index.php");





?>