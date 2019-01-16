<?php

if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';


?>

<!doctype html>
<html>
<head>
    <title>Crazy Coop Creations</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
	<?php
	
	if(isset($_SESSION['username'])){
		$query = $mysqli->query("SELECT * from users WHERE username='".$_SESSION['username']."';");
		$obj = $query->fetch_object();
		
		
		if($obj->darkmode == 2){
			echo '<link rel="stylesheet" href="styleb.css" />';
		}
		else {
			echo '<link rel="stylesheet" href="style.css" />';
		}
	}
	else {
		echo '<link rel="stylesheet" href="style.css" />';
	}
	
	
	?>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="index.php">CrazyCoop!</a>
            </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Shop
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="candleshop.php"><b>Candles</b></a></li>
                            <li><a href="soapshop.php"><b>Soaps</b></a></li>
                        </ul></li>
                    <li><a href="contact.php">Contact</a></li>
                    </ul>
                <ul class="nav navbar-nav navbar-right">
				<?php
				
				if(isset($_SESSION['username'])){
					echo '<li><a href="account.php"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['username'].'</a></li>';
					echo '<li><a href="logout.php">Log Out</a></li>';
				}
				else{
					echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
					echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
				}
				?>
                <li class="active"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="jumbotron">
        <div class="container text-center">
            <h1>Crazy Coop Creations</h1>      
            <p1>Home Made Candles & Soaps</p1>
        </div>
    </div>
	<br>
    <br>

	<div class="container">
	<h3>Your Shopping Cart</h3><br><br>
	<div class="table-responsive">
	<table class="table">
	<thead>
	<tr align="center">
	<th align="center">Code</th>
	<th align="center">Image</th>
	<th align="center">Product</th>
	<th align="center">Cost</th>
	<th class="text-right">Quantity</th>
	</tr>
	</thead>
	<tbody>
	<?php
		
		if(isset($_SESSION['cart'])) {
			$total = 0;
			foreach($_SESSION['cart'] as $product_id => $quantity) {
				$result = $mysqli->query("SELECT product_code, product_name, product_desc, qty, price, product_img_name FROM products WHERE id = ".$product_id);


            if($result){

              while($obj = $result->fetch_object()) {
                $cost = $obj->price * $quantity; //work out the line cost
                $total = $total + $cost; //add to the total cost
				$tax = 0.09;
				$grandtotal = ($total * $tax) + $total;
				
				echo '<tr align="left">';
				echo '<td>'.$obj->product_code.'</td>';
				echo '<td><img src="'.$obj->product_img_name.'" width="100" height="100" class="img-responsive"/></td>';
				echo '<td>'.$obj->product_name.'</td>';
				echo '<td>$'.$obj->price.'</td>';
				echo '<td align="right"><a href="update-cart.php?action=add&id='.$product_id.'" class="btn btn-success btn-sm">+</a><b>  '.$quantity.'  </b><a href="update-cart.php?action=remove&id='.$product_id.'" class="btn btn-danger btn-sm">-</a></td>';
				echo '</tr>';
				
              }
            }

          }
			echo '</tbody>';
			echo '<tfoot>';
			echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td align="right"><b>Subtotal: $'.$total.'.00<br>';
			echo 'Grand Total: $'.$grandtotal.'<br></b>';
			echo '<a href="update-cart.php?action=empty" class="btn btn-danger">Empty Cart</a><br><br>';
			echo '<a href="index.php" class="btn btn-primary">Continue Shopping</a><br><br>';
			if(isset($_SESSION['username'])){
				echo '<a href="mail.php" class="btn btn-primary">Checkout</a><br>';
			}
			else {
				echo '<a href="login.php" class="btn btn-primary">Log In</a><br>';
			}
			echo '</td><td></td><td></td></tr></tfoot></table>';
		
		
		}
		else {
			echo "No items in cart";
			echo '</table>';
		}
		
		echo '</div>';
		echo '</div>';
	
	
	
	?>

	
	
	<div class="footer">
        <p>Crazy Coop Creations Copyright</p>  
        <form class="form-inline">Get deals:
        <input type="email" class="form-control" size="50" placeholder="Email Address">
        <button type="button" class="btn btn-danger">Sign Up</button>
        </form>
    </div>
</body>
</html>
