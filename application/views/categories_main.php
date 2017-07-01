<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2 class="category-main">Categories</h2>

<div class="content-align-center">
	<?php for($i=0; $i<5; $i++){ ?>
		<div class="category-card category-card-beacon category-card-beacon-compact">
			<a href=<?php echo base_url()."index.php/main/category?name=".$category[$i]->name?>>
				<div class="category-card-ico">
					<img src=<?php echo $category[$i]->source ?> alt=<?php echo $category[$i]->name ?>>
				</div>
				<div class="category-card-details">
					<h3 class="category-card-header"><?php echo $category[$i]->name ?></h3>
				</div>
			</a>
		</div>
	<?php } ?>
</div>
<div class="align-right">
	<a href=<?php echo base_url()."index.php/main/categories" ?>>See more categories</a>
</div>