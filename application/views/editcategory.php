<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--If logged user is the administrator-->
<?php if($this->session->userdata('is_admin')) {?>
	<div class="product-img">
		<img src=<?php echo $categoryInfo[0]->source ?> alt="">
	</div>
	<div class="update-category-data" id="update">
		<?= form_open('/main/updatecategory?id='.$categoryInfo[0]->id) ?>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" id="name" name="name" value=<?php echo $categoryInfo[0]->name ?>>
			</div>
			<div class="form-group">
				<label for="source">Source:</label>
				<textarea rows="6" cols="38" name="source"><?php echo $categoryInfo[0]->source ?></textarea>
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
			<h2>Delete category?</h2>
			<a class="close" href="#">&times;</a>
			<div class="content">
				Attention !! You're about to delete this category. 
				This operation cannot be reverted. 
				Do you want to proceed?
			</div>
			<div class="content">
				<a href=<?php echo base_url()."index.php/main/deletecategory?id=".$categoryInfo[0]->id ?> class="btn btn-danger">Yes</a>
				<a href="#" class="btn btn-success">No</a>
			</div>
		</div>
	</div>
<?php } ?>