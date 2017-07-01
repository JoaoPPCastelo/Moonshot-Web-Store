<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2 class="category">My Cart</h2>
<div class="cart-container">
	<div class="cart-info">
  		<div class="col-sm-8">Product</div>
		<div class="col-sm-2">Price</div>
		<div class="col-sm-2"></div>
	</div>
	<div>
		<?php foreach($cartitems as $item){ ?>
			<div class="cart-products">
				<div class="col-sm-8">
					<div class="cart-product-info">
						<a href=<?php echo base_url()."index.php/main/product?id=".$item->id ?> >
							<img src=<?php echo $item->source ?> alt="">
						</a>
						<div class="cart-product-details">
							<h4 class="media-heading"><a href=<?php echo base_url()."index.php/main/product?id=".$item->id ?>><?php echo $item->name ?></a></h4>
							<h5 class="media-heading"> Description: <?php echo $item->description ?></h5>
							<h5 class="media-heading">Category: <a href=<?php echo base_url()."index.php/main/category?name=".$item->category ?>><?php echo $item->category ?></a></h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="cart-product-price">
						<?php echo $item->price ?> €
					</div>
				</div>
				<div class="col-sm-2">
					<div class="cart-product-remove">
						<a href=<?php echo base_url()."index.php/main/removeproductfromcart?id=".$item->id ?> class="btn btn-danger">
							<span class="glyphicon glyphicon-remove"></span> Remove
						</a>
					</div>
				</div>
			</div>
			<?php } ?>
	</div>
	<div class="cart-resume">
		<div class="cart-resume-total">
			<div class="col-sm-6"></div>
			<div class="col-sm-2"><h3>Total:</h3></div>
			<div class="col-sm-2"><h3><?php echo $total?>€</h3></div>
			<div class="col-sm-2"></div>
		</div>
	</div>
	<div class="cart-buttons">
		<div class="col-sm-6"></div>
		<div class="col-sm-3">
			<a href=<?php echo base_url()."index.php/main/products" ?> class="btn btn-info">
				<span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
			</a>
		</div>
		<div class="col-sm-3">
			<a href=<?php echo base_url()."index.php/main/success" ?>  class="btn btn-success">
				<span class="glyphicon glyphicon-play"></span> Checkout 
			</a>
		</div>
	</div>	
</div>