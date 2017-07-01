<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="product">
	<h2 class="category"><?php echo $product[0]->name ?></h2>
	<div class="product-img">
		<img src=<?php echo $product[0]->source ?> alt="">
	</div>

	<?php if(!$this->session->userdata('is_admin')) {?>
		<div class="row">
			<div class="col-sm-8">
				<div class="product-details">
					<div class="product-details-tags">Description:</div>
					<div class="product-details-data"><?php echo $product[0]->description ?></div>
					<div class="product-details-tags">Added at:</div>
					<div class="product-details-data"><?php echo $product[0]->added_at ?></div>
					<div class="product-details-tags">Price (€):</div>
					<div class="product-details-data"><?php echo $product[0]->price ?>€</div>
				</div>
			</div>
			<div class="col-sm-4">
				<?php if($this->session->userdata('username')) {?>
					<div class="add-to-cart-button">
						<a href=<?php echo base_url()."index.php/main/addtocart?id=".$product[0]->id ?>  class="btn btn-success btn-xlarge">
							<span class="glyphicon glyphicon-shopping-cart"></span>
							Add to cart
						</a>	
						
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if($this->session->userdata('is_admin')) {?>
		<div class="update-product-data" id="update">
			<?= form_open('/main/updateproduct?id='.$product[0]->id) ?>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Description:</label>
						<textarea rows="4" cols="26" name="description"><?php echo $product[0]->description ?></textarea>
					</div>
					<div class="form-group">
						<label for="price">Price €:</label>
						<input type="text" class="form-control" id="price" name="price" value=<?php echo $product[0]->price ?>>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Added at (Y-m-j H:i:s):</label>
						<textarea rows="1" cols="26" name="added_at"><?php echo $product[0]->added_at ?></textarea>
					</div>
					<div class="form-group">
						<label for="source">Source:</label>
						<textarea rows="6" cols="30" name="source"><?php echo $product[0]->source ?></textarea>
					</div>       
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
				</div>
			</form>    
		</div>
		
		<a href="#confirmelimination">
			<div class="admin-round-button">
				<img src=<?php echo base_url()."assets/images/error.png" ?>>
			</div>
		</a>
		<div id="confirmelimination" class="overlay">
			<div class="popup">
				<h2>Delete product?</h2>
				<a class="close" href="#">&times;</a>
				<div class="content">
					Attention !! You're about to delete this product. 
					This operation cannot be reverted. 
					Do you want to proceed?
				</div>
				<div class="content">
					<a href=<?php echo base_url()."index.php/main/deleteproduct?id=".$product[0]->id ?> class="btn btn-danger">Yes</a>
					<a href="#" class="btn btn-success">No</a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>