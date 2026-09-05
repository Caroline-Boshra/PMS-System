<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - EraaSoft PMS Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php 
        require_once dirname(__FILE__) . "/config.php";
        require_once BASE_PATH . "inc/nav.php" ;
        require_once BASE_PATH . "inc/header.php" ;
        require_once BASE_PATH ."core/functions.php";
        require_once BASE_PATH ."core/validations.php";

        $fileProducts = BASE_PATH . "assets/products/products.json";
        $allProducts = file_exists($fileProducts) ? json_decode(file_get_contents($fileProducts), true) ?? [] : [];

        $pagination = paginateData($allProducts, 4);

        $paginatedProducts = $pagination['data'];
        $currentPage       = $pagination['current_page'];
        $totalPages        = $pagination['total_pages'];
    ?>
    
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <?php 
                showMessage(); 
            ?>
            <h2 class="fw-bolder mb-4">All products</h2>
            
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                
                <?php foreach ($paginatedProducts as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        <a href="<?= BASE_URL ?>views/products/product.php?id=<?= $product['id'] ?>"> 
                            <img class="card-img-top" src="<?= BASE_URL . 'uploads/products/' . $product['image'] ?>" alt="Product image" />
                        </a>
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $product['product_name'] ?></h5>
                                <h5 class="fw-bolder"> Price : $<?= $product['price'] ?> </h5>
                                <h5 class="fw-bolder">Category : <?= getCategoryNameById($product['category_id']) ?></h5>
                            </div>
                        </div>

                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                
                                <a class="btn btn-outline-dark flex-fill" href="<?= BASE_URL ?>views/products/product.php?id=<?= $product['id'] ?>">View item</a>
                                
                                <?php 
                                $isSaved = isset($_SESSION['saved_items'][$product['id']]); 
                                ?>

                                <form action="<?= BASE_URL ?>handeler/orders/addToCart.php" method="POST" class="m-0 d-flex gap-2 align-items-center">
                                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    
                                    <button type="submit" name="action" value="save_for_later" class="btn btn-outline-danger" title="<?= $isSaved ? 'Remove from Wishlist' : 'Add to Wishlist' ?>">
                                        <?php if ($isSaved): ?>
                                            <i class="bi-heart-fill text-danger"></i>
                                        <?php else: ?>
                                            <i class="bi-heart"></i>
                                        <?php endif; ?>
                                    </button>

                                    <button class="btn btn-outline-dark" type="submit" name="action" value="add_to_cart" title="Add to Cart">
                                        <i class="bi-cart-fill"></i> 
                                    </button>

                                    <button class="btn btn-dark text-nowrap" type="submit" name="action" value="buy_now">Buy Now</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>

        
        <nav aria-label="Page navigation" class="my-4">
            <ul class="pagination justify-content-center">
                
                <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $currentPage - 1 ?>">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $currentPage + 1 ?>">Next</a>                    
                </li>

            </ul>
        </nav>
        
    </section>

    <!-- Footer-->
    <?php
     require_once BASE_PATH . "inc/footer.php" ;
    ?>
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>