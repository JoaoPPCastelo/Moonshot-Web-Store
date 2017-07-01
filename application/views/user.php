<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="user-container">
	<div class="user-image">
		<img src=<?php echo base_url()."assets/images/business-2.png" ?> alt="Credentials icon">
	</div>
	<div class="user-data">
		<?= form_open('/main/updateuser?id='.$user[0]->id) ?>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" id="name" name="name" value=<?php echo $user[0]->username ?>>
			</div>
			<div class="form-group">
				<label for="source">Email:</label>
				<input type="text" class="form-control" id="email" name="email" value=<?php echo $user[0]->email ?>>
			</div>
			<div class="form-group">
				<label for="source">Password:</label>
				<input type="password" class="form-control" id="password" name="password">
			</div>   
			<div class="form-group">
				<label for="source">Confirm Password:</label>
				<input type="password" class="form-control" id="passwordConfirmation" name="passwordConfirmation">
			</div>  
			<div class="form-group">
				<button type="submit" class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
		</form>    
	</div>
</div>
<a href="#confirmelimination">
	<div class="admin-round-button">
		<img src=<?php echo base_url()."assets/images/error.png" ?>>
	</div>
</a>
<div id="confirmelimination" class="overlay">
	<div class="popup">
		<h2>Delete user?</h2>
		<a class="close" href="#">&times;</a>
		<div class="content">
			Attention !! You're about to delete this user. 
			This operation cannot be reverted. 
			Do you want to proceed?
		</div>
		<div class="content">
			<a href=<?php echo base_url()."index.php/main/deleteuser?id=".$user[0]->id ?> class="btn btn-danger">Yes</a>
			<a href="#" class="btn btn-success">No</a>
		</div>
	</div>
</div>