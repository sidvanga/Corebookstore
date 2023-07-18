<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Bookstore</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php foreach ($categories as $cat): ?>
                      <a class="dropdown-item" href="<?php echo base_url('category/'.$cat['id']);?>">
                          <?php echo $cat['name'] ?>
                      </a>
            <?php endforeach ?>
        </div>
      </li>
      <?php if($this->session->has_userdata('user')){ ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('admin');?>">Admin Panel</a>
      </li>
      <?php } ?>
    </ul>
    <?php echo form_open('search', 'class="form-inline my-2 my-lg-0"'); ?>
      <input class="form-control mr-sm-2" name="search_phrase" type="search" placeholder="Title or Author" aria-label="Search">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <?php if(!$this->session->has_userdata('user')){ ?> <a href="<?php echo base_url('cart');?>" class="btn btn-outline-primary my-2 my-sm-0 ml-2" ><i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>Cart</a> <?php } ?>
    <?php if($this->session->has_userdata('user')){ ?> <a href="<?php echo base_url('logout');?>" class="btn btn-outline-primary my-2 my-sm-0 ml-2" >Logout</a> <?php } ?>
  </div>
</nav>