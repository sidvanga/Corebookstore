<?php if(validation_errors()||$img_upload_err!=''){?><div class="bg-danger text-white px-5 py-2"><?php echo validation_errors(); ?><br> <?php echo $img_upload_err; } ?></div>
    <?php if($this->session->flashdata('success_msg')){?><div class="bg-success text-white px-5 py-2"><?php echo $this->session->flashdata('success_msg');?></div><?php } ?>
<div class="container mt-4">
    <p><h2>Add Book</h2></p>

<?php echo form_open_multipart('add_book'); ?>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title">
</div>
<div class="form-group">
    <label for="author">Author</label>
    <input type="text" class="form-control" name="author">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" name="description" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" class="form-control">
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="unit_price">Unit Price</label>
    <input type="number" class="form-control" min="0" name="unit_price">
</div>
<div class="form-group">
    <label for="qty">Quantity</label>
    <input type="number" class="form-control" min="1" name="qty">
</div>
<div class="form-group">
    <label for="book_cover">Book cover image</label>
    <input type="file" name="book_cover" class="form-control-file">
</div>

<small class="form-text text-muted"></small>
<small class="form-text text-muted"><?php echo $img_upload_err ?></small>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
