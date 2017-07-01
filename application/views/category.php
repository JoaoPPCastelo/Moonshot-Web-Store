<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if (!empty($categoryImages)) { ?>	
	<h2 class="category"><?php echo $categoryInfo[0]->name ?></h2>
	<div class="content-align-center">
		<?php foreach($categoryImages as $item){ ?>
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
					<div class="category-card-details">
						<h3 class="category-card-header"><?php echo $item->name ?></h3>
					</div>
				</a>
			</div>
		<?php } ?>
	</div>
<?php } ?>

<?php if (empty($categoryImages)) { ?>
	<div class="ups-message">
		<div class="bot-img">
			<img src=<?php echo base_url()."assets/images/bot.svg" ?> alt="Bot">
		</div>
		<div class="ups-message-content">
			<h3>Oops. We didn't found any photos to show...</h3>
			<h3>But don't worry!!! We sent a bot with a camera to take some amazing pictures for you.</h3>  
		</div>
	</div>
<?php } ?>

<?php if($this->session->userdata('is_admin')) {?>
	<a href=<?php echo base_url()."index.php/main/createproduct" ?>>
		<div class="admin-round-button">
			<img src=<?php echo base_url()."assets/images/plus.png" ?>>
		</div>
	</a>
<?php } ?>

