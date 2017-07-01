<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Moonshot</title>
	<meta charset="utf-8">

	<!-- Include the CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href=<?php echo base_url()."assets/css/style.css" ?> rel="stylesheet">

	<!-- Include jQuery (required) and the JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href=<?php echo base_url()."assets/images/eye.png" ?>>
	<link href="https://fonts.googleapis.com/css?family=Delius+Unicase" rel="stylesheet">
</head>
<body>
	<!--NavBar-->
	<header class="site-header">
		<div class="site-header-toprow">
			<a class="site-logo">
				<h1 class="logotype">
					<img src=<?php echo base_url()."assets/images/eye.png" ?> alt="Logo">
				</h1>
			</a>
			<nav class="site-nav">
				<div class="site-nav-wrapper">
					<a href=<?php echo base_url() ?> class="active">Home</a>
					<a href=<?php echo base_url()."index.php/main/categories" ?>>Categories</a>
					<a href=<?php echo base_url()."index.php/main/products" ?>>Products</a>
					<a href=<?php echo base_url()."index.php/main/about" ?>>About</a>
				</div>
			</nav>

			<?php if(!$this->session->userdata('username')) {?>
				<div class="nav-button">
					<a href=<?php echo base_url()."index.php/main/login"?> class="btn-login">Login/ Register</a>
				</div>
			<?php } ?>

			<!--menu admin-->
			<?php if($this->session->userdata('is_admin')) {?>
				<div class="nav-button">
					<div class="right-side">
						<div class="shopping-icon">
							<a href=<?php echo base_url()."index.php/main/cart" ?>>
								<img src=<?php echo base_url()."assets/images/shopping-store.png" ?> alt="Shopping icon" >
								<div class="cart-counter"><?php echo $cartnumber ?></div>
							</a>         
						</div>
						<button class="btn-logged btn btn-primary dropdown-togle" type="button" data-toggle="dropdown">
							Hello <?php echo $this->session->userdata('username') ?>
							<span class="caret"></span>
						</button>
						<ul class="btn-logged-dropdown dropdown-menu">
							<li><a href=<?php echo base_url()."index.php/main/orders" ?>>My orders</a></li>
							<li><a href=<?php echo base_url()."index.php/main/categories" ?>>Manage Categories</a></li>
							<li><a href=<?php echo base_url()."index.php/main/products" ?>>Manage Products</a></li>
							<li><a href=<?php echo base_url()."index.php/main/users" ?>>Manage Users</a></li>
							<li><a href=<?php echo base_url()."index.php/main/logout" ?>>Logout</a></li>
						</ul> 
					</div>
				</div>
			<?php } ?>

			<?php if($this->session->userdata('username') && !$this->session->userdata('is_admin')) {?>
				<div class="nav-button">
					<div class="right-side">
						<div class="shopping-icon">
							<a href=<?php echo base_url()."index.php/main/cart" ?>>
								<img src=<?php echo base_url()."assets/images/shopping-store.png" ?> alt="Shopping icon" >
								<div class="cart-counter"><?php echo $cartnumber ?></div>
							</a>         
						</div>
						<button class="btn-logged btn btn-primary dropdown-togle" type="button" data-toggle="dropdown">
							Hello <?php echo $this->session->userdata('username') ?>
							<span class="caret"></span>
						</button>
						<ul class="btn-logged-dropdown dropdown-menu">
							<li><a href=<?php echo base_url()."index.php/main/orders"?>>My orders</a></li>
							<li><a href=<?php echo base_url()."index.php/main/logout"?>>Logout</a></li>
						</ul>    
					</div>
				</div>
			<?php } ?>
		</div>
	</header>