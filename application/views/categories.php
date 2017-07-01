<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2 class="category">Categories</h2>

<div class="content-align-center">
	<?php foreach($category as $item){ ?>
		<div class="category-card category-card-beacon category-card-beacon-compact">
			<a href=<?php echo base_url()."index.php/main/category?name=".$item->name?>>
				<div class="category-card-ico">
					<img src=<?php echo $item->source ?> alt=<?php echo $item->name ?>>
					<?php if($this->session->userdata('is_admin')) {?>
						<a href=<?php echo base_url()."index.php/main/editcategory?name=".$item->name?>>
							<div class="edit-button">
								<span class="glyphicon edit-glyficon glyphicon-pencil"></span>
							</div>
						</a>
					<?php } ?>			
				</div>
				<a href=<?php echo base_url()."index.php/main/category?name=".$item->name?>>
					<div class="category-card-details">
						<h3 class="category-card-header"><?php echo $item->name ?></h3>
					</div>
				</a>
			</a>
		</div>
	<?php } ?>
	
	<?php if($this->session->userdata('is_admin')) {?>
		<a href=<?php echo base_url()."index.php/main/createcategory" ?>>
			<div class="admin-round-button">
				<img src=<?php echo base_url()."assets/images/plus.png" ?>>
			</div>
		</a>
	<?php } ?>
</div>