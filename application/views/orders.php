<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2 class="category">My Orders</h2>

<div class="content-align-center">
	<?php foreach($cartitems as $item){ ?>
		<div class="category-card category-card-beacon category-card-beacon-compact">
			<a href=<?php echo base_url()."index.php/main/product?id=".$item->id ?>>
				<div class="category-card-ico">
					<img src=<?php echo $item->source ?> alt=<?php echo $item->name ?>>
					<?php if($this->session->userdata('is_admin')) {?>
						<a href=<?php echo base_url()."index.php/main/product?id=".$item->id ?>>
							<div class="edit-button">
								<span class="glyphicon edit-glyficon glyphicon-pencil"></span>
							</div>
						</a>
					<?php } ?>			
				</div>
                <a href=<?php echo base_url()."index.php/main/product?id=".$item->id ?>>
                    <div class="category-card-details">
                        <h3 class="category-card-header"><?php echo $item->name ?></h3>
                    </div>
                </a>
			</a>
		</div>
	<?php } ?>
</div>