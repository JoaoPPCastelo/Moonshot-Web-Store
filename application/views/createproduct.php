<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!--If logged user is the administrator-->
<?php if($this->session->userdata('is_admin')) {?>
	<div class="create-product" id="update">
		<?= form_open('/main/addproduct') ?>
			<div class="col-lg-6">
                <div class="form-group">
					<label>Name:</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label>Description:</label>
					<textarea rows="4" cols="30" name="description"></textarea>
				</div>
				<div class="form-group">
					<label for="price">Price €:</label>
					<input type="text" class="form-control" id="price" name="price" >
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Category:</label>
					<select class="selectpicker" data-show-subtext="true" name="category">
                        <?php foreach ($category as $categoryname) { ?>
                           <option><?php echo $categoryname->name ?></option>
                        <?php } ?>
                    </select>
				</div>
				<div class="form-group">
					<label for="source">Source:</label>
					<textarea rows="6" cols="30" name="source"></textarea>
				</div>       
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-default full-width"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
		</form>    
	</div>
<?php } ?>