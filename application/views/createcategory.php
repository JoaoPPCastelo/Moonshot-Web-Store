<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--If logged user is the administrator-->
<?php if($this->session->userdata('is_admin')) {?>
	<div class="create-category" id="update">
		<?= form_open('/main/addcategory') ?>
			<div class="form-group">
				<label>Name:</label>
				<input type="text" class="form-control" id="name" name="name" >
			</div>
			<div class="form-group">
				<label for="source">Source:</label>
				<textarea rows="6" cols="38" name="source"></textarea>
			</div>  
			<div class="form-group">
				<button type="submit" class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
		</form>    
	</div>
<?php } ?>
