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
                <a class="navbar-brand" href="main.html">CrazyCoop!</a>
            </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
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
        <br>
        <h3><u>About This Crazy Coop!</u></h3>
        <br>
        <p3>Below you can see some pictures that describe the Crazy Coop. We've always had a passion for making our own things, including 
		furniture, clothes, and more. Recently though, we found an even bigger passion, which is making home made candles and soaps. We strive 
		to create unique items, such as our cupcake candle, and fresh smells! From Knoxville, TN, Crazy Coop Creations welcomes you to our website!
		 Please have a look around, and be sure to check out our deals below!</p3>
        <br>
        <br>
        <div align="middle" id="myCarousel" class="carousel slide space" data-ride="carousel" style="width: 350px!important;" >
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="crazycoopcarousel.jpg" alt="crazycoop" style="height:500px">

        </div>

        <div class="item">
            <img src="creatorscarousel.jpg" alt="creators" style="height:500px" >

        </div>

        <div class="item">
            <img src="cupcakecandlescarousel.jpg" alt="cupcakecandle" style="height:500px">

        </div>
        </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">›
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    </div>
    <br>
    <br>


	<div class="container">
    <div class="row">
	<h3><u>Featured Deals!</u></h3>
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products WHERE id IN (1, 2, 3)');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){

            while($obj = $result->fetch_object()) {

              echo '<div class="col-sm-4">';
			  echo '<div class="panel panel-danger">';
			  echo '<div class="panel-heading-custom panel-heading heading"><strong>LIMITED TIME OFFER!</strong></div>';
			  echo '<div class="panel-body"><img src="'.$obj->product_img_name.'"class="img-responsive" style="width:100%" alt="Image"></div>';
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

	
	<!--
    <div class="container">    
        <div class="row">
            <h3><u>Featured Deals!</u></h3>
            <br>
            <div class="col-sm-4">
                <div class="panel panel-danger">
                <div class="panel-heading"><strong>LIMITED TIME OFFER</strong></div>
                <div class="panel-body"><img src="pumpkinsoap.jpeg" class="img-responsive" style="width:100%" alt="Image"></div>
                <div class="panel-footer">It's that time of year again, for spooky times and great food. For a limited time, spook up your bathroom with some pumpkin soap!<br><br>
                    <button type="button" class="btn btn-success">Add to Cart - $7.00</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"> 
                <div class="panel panel-danger">
                    <div class="panel-heading"><strong>LIMITED TIME OFFER!</strong></div>
                <div class="panel-body"><img src="cupcakeCandle.jpeg" class="img-responsive" style="width:100%" alt="Image"></div>
                <div class="panel-footer">Straight from testing in the Crazy Coop Lair, that's right - we have a lair, comes this magnificent cupcake candle! <br><br>
                    <button type="button" class="btn btn-success">Add to Cart - $10.00</button></div>
                </div>
            </div>
            <div class="col-sm-4"> 
                <div class="panel panel-primary">
                    <div class="panel-heading"><strong>ON SALE</strong></div>
                <div class="panel-body"><img src="deal2.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
                <div class="panel-footer">Want to try all of our products? The best way to do that is with our gift basket, now on sale! This will come with 4 soaps, and 2 candles! <br><br>
                    <button type="button" class="btn btn-success">Add to Cart - $22.00</button></div>
                </div>
            </div>
        </div>
	-->
        <br><br><br>
        <button type="button" class="btn btn-primary btn-lg" onclick="location.href = 'candleshop.php';">See More!</button>
    </div><br><br>
</div>




    <div class="footer">
        <p>Crazy Coop Creations Copyright</p>  
        <form class="form-inline" action="sub.php" method="POST">Get deals:
        <input type="email" class="form-control" size="50" placeholder="Email Address" name="email" id="email">
        <input type="submit" class="btn btn-danger" Value="Sign Up" />
        </form>
    </div>
</body>
</html>
