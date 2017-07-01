<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h2 class="category">Users</h2>
<?php if($this->session->userdata('is_admin')) {?>
	<div class="content-align-center">
		<?php foreach($users as $item){ ?>
			<div class="category-card category-card-beacon category-card-beacon-compact">
				<a href=<?php echo base_url()."index.php/main/user?id=".$item->id ?>>
					<div class="category-card-ico">
						<img src=<?php echo base_url()."assets/images/business-2.png" ?> alt="Credentials icon">
						<a href=<?php echo base_url()."index.php/main/user?id=".$item->id ?>>
							<div class="edit-button">
								<span class="glyphicon edit-glyficon glyphicon-pencil"></span>
							</div>
						</a>			
					</div>
					<a href=<?php echo base_url()."index.php/main/user?id=".$item->id ?>>
						<div class="category-card-details">
							<h3 class="category-card-header"><?php echo $item->username ?></h3>
						</div>
					</a>
				</a>
			</div>
		<?php } ?>
		<a href=<?php echo base_url()."index.php/main/register" ?>>
			<div class="admin-round-button">
				<img src=<?php echo base_url()."assets/images/plus.png" ?>>
			</div>
		</a>
	</div>
<?php } ?>