<div class="container-fluid mt-4">
    <div class="accordion" id="accordionCategories">
        <?php foreach ($books_in_categories as $key => $category): ?>
            <?php if (!empty($category['books'])) { ?>
                <div class="card">
                    <div class="card-header text-center bg-transparent" id="<?php echo'heading' . $key ?>">
                        <h5 class="mb-0">
                            <button class="<?php echo $key == 0 ? "btn btn-link" : "btn btn-link collapsed"; ?>" type="button" data-toggle="collapse" data-target="<?php echo'#collapse' . $key ?>" aria-expanded="<?php echo $key == 0 ? "true" : "false"; ?>" aria-controls="<?php echo'collapse' . $key ?>">
                                <h5><?php echo $category['name']; ?></h5>
                            </button>
                        </h5>
                    </div>

                    <div id="<?php echo'collapse' . $key ?>" class="<?php echo $key == 0 ? "collapse show" : "collapse"; ?>" aria-labelledby="headingOne" data-parent="#accordionCategories">
                        <div class="card-body">
                            <div class="row py-2">
                                <?php foreach ($category['books'] as $book): ?>
                                    <div class="col d-flex align-items-stretch">
                                        <div class="card book-card mx-auto" style="border:1px solid rgba(0,0,0,.125)!important; border-radius: .25rem;">
                                            <img class="card-img-top" src="<?php
                                            echo base_url("/assets/img/covers/" . $book['cover_url']);
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
                            <div class="row mt-3">
                                <hr class="my-4">
                                <div class="col text-center">
                                    <a href="<?php echo base_url("category/" . $category['id']) ?>" class="btn btn-primary">See More ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>
    </div>
</div>