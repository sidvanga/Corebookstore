<div class="container mt-5">
    <p><h5>People who viewed this book also viewed</h5><p>
    <div class="row">
        <?php foreach ($related_books as $book): ?>
            <div class="col d-flex align-items-stretch mb-4">
                <div class="card book-card mx-auto" style="width:12rem">
                    <img class="card-img-top" src="<?php
                    echo base_url();
                    echo "/assets/img/covers/";
                    echo$book['cover_url']
                    ?>" alt="Card image cap">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-truncate"><a href="<?php echo base_url();
                    echo "books/" . $book['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $book['title']; ?>"><?php echo $book['title']; ?></a></h5>
                        <div class="mt-auto">
                            <p class="card-text"><?php echo $book['author']; ?></p>
                            <p class="card-text font-weight-bold">Rs.<?php echo $book['unit_price']; ?></p>
                            <div class="text-center"><a href="#" class="btn btn-outline-primary btn-block">Add to cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
<?php endforeach; ?>
    </div>
</div>