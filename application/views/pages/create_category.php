<div class="container mt-4">
    <p><h2>Create Category</h2></p>

<?php echo form_open('create_category'); ?>
<div class="form-group">
    <label for="name">Category Name</label>
    <input type="text" class="form-control" name="name">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" rows="3"></textarea>
</div>
<small class="form-text text-muted"><?php echo validation_errors(); ?></small>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
