<div class="container-fluid mt-4 px-5">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12"><img src="<?php
            echo base_url("assets/img/covers/" . $book['cover_url']);
            ?>" class="img-fluid" alt="Responsive image"></div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div><h1><?php echo $book['title']; ?></h1></div>
            <div><h4><?php echo $book['author']; ?></h4></div>
            <div><p class="text-justify"><?php echo $book['description']; ?></p></div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">


            <?php if (isset($statistics)) { ?>
                <div class="card mx-auto mt-3">
                    <h5 class="card-header">Visitor Statistics</h5>
                    <div class="card-body text-center">
                        <p><h5 card-title font-weight-bold>Total Views</h5></p>
                        <h1 class="font-weight-bold"><?php echo $statistics['total_views']; ?></h5>
                        <hr class="my-4">
                        <p><h5 card-title font-weight-bold>Monthly Views</h5></p>
                        <canvas id="myChart"></canvas>

                            </form>
                     </div>
                  </div>
              <?php } else { ?>
                            <div class="card mx-auto mt-3" style="width:20rem;">
                                <h5 class="card-header">Shopping Details</h5>
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold"><?php echo "Rs." . $book['unit_price']; ?></h5>
                                    <?php if ($book['qty']>0){?>
                                          <h5 class="card-title text-success">In stock.</h5>
                                    <?php } else {?>
                                          <h5 class="card-title text-danger">Out of stock.</h5>
                                    <?php }?>
                                    <p class="card-text">Ships from and sold by Bookstore.com.</p>
                                    
                                    <hr class="my-4">
                                    
                                    <?php if ($book['qty']>0){echo form_open('cart/addToCart/' . $book['id'], 'class="form-inline"'); ?>
                                    <div class="form-group">
                                        <label for="inputPassword6">Quantity</label>
                                        <input type="number" name="qty" min="1" value="1" max="<?php echo $book['qty']; ?>" class="ml-2 form-control form-control-sm" />
                                    </div>
                                    <div class="form-group ml-3">
                                        <button type="submit" class="btn btn-primary">Add to cart</button>
                                    </div>
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>

                <?php } ?>

                </div>
            </div>
        </div>