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
                            <li class="active"><a href="soapshop.php"><b>Soaps</b></a></li>
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
                <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
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
        <div class="row">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products WHERE id IN (12, 13)');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

              echo '<div class="col-sm-6">';
			  echo '<div class="panel panel-danger">';
			  echo '<div class="panel-heading"><strong>'.$obj->product_name.'</strong></div>';
			  echo '<div class="panel-body"><img src="'.$obj->product_img_name.'" class="img-responsive" style="width:100%" alt="Image"></div>';
			  echo '<div class="panel-footer panel-custom">'.$obj->product_name.'<br>'.$obj->product_desc.'<br>$'.$obj->price.'<br>';



              if($obj->qty > 0){
                echo '<a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a>';
              }
              else {
                echo 'Out Of Stock!';
              }
			  echo '</div>';
			  echo '</div>';
			  echo '</div>';
              $i++;
            }

          }

          $_SESSION['product_id'] = $product_id;
			echo '<br><br><br>'
          ?>
		  </div>
		  </div>
	
	
	
    <div class="container">
        <div class="row">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products WHERE id IN (14, 15)');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

              echo '<div class="col-sm-6">';
			  echo '<div class="panel panel-danger">';
			  echo '<div class="panel-heading"><strong>'.$obj->product_name.'</strong></div>';
			  echo '<div class="panel-body"><img src="'.$obj->product_img_name.'" class="img-responsive" style="width:100%" alt="Image"></div>';
			  echo '<div class="panel-footer panel-custom">'.$obj->product_name.'<br>'.$obj->product_desc.'<br>$'.$obj->price.'<br>';



              if($obj->qty > 0){
                echo '<a href="update-cart.php?action=add&id='.$obj->id.'"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a>';
              }
              else {
                echo 'Out Of Stock!';
              }
			  echo '</div>';
			  echo '</div>';
			  echo '</div>';
              $i++;
            }

          }

          $_SESSION['product_id'] = $product_id;
			echo '<br><br><br>'
          ?>
		  </div>
		  </div>
	
	
	
	
	
	
	
	
	
	
	
	<div class="footer">
        <p>Crazy Coop Creations Copyright</p>  
        <form class="form-inline">Get deals:
        <input type="email" class="form-control" size="50" placeholder="Email Address">
        <button type="button" class="btn btn-danger">Sign Up</button>
        </form>
    </div>
</body>
</html>