<div class="container-fluid px-5">
    <div class="row">
        <?php foreach ($books as $book): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch mb-4">
                <div class="card book-card mx-auto">
                    <img class="card-img-top" src="<?php
                    echo base_url("/assets/img/covers/".$book['cover_url']);
                    ?>" alt="Card image cap">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate"><a href="<?php echo base_url("books/" . $book['id']);
                    ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $book['title']; ?>"><?php echo $book['title']; ?></a></h5>
                        <div class="mt-auto">
                            <p class="card-text"><?php echo $book['author']; ?></p>
                            <p class="card-text font-weight-bold">Rs.<?php echo $book['unit_price']; ?></p>
                            <div class="text-center"><a href="<?php echo base_url("cart/addToCart/" . $book['id']); ?>" class="btn btn-outline-primary btn-block">Add to cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col text-center">
            <p><?php if (isset($links)) {
            echo $links;
        } ?></p>
        </div>
    </div>

</div>

