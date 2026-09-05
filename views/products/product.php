<!DOCTYPE html>
<html lang="en">
<?php    
 require_once dirname(__FILE__,3) . "/config.php";
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
 }
?>
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
    <link href="<?= BASE_URL ?>css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
     <?php 
        require_once BASE_PATH . "inc/nav.php" ;
        require_once BASE_PATH . "inc/header.php" ;
        require_once BASE_PATH ."core/functions.php";
        require_once BASE_PATH ."core/validations.php";

        $products = getProducts();

        $product_id = $_GET['id'] ?? null;
        $product = null;

        foreach ($products as $p) {
            if ($p['id'] == $product_id) {
                $product = $p;
                break;
            }
        }

        if (!$product) {
            header("Location: " . BASE_URL . "index.php"); 
            exit();
        }
      
        $fileProducts = BASE_PATH . "assets/products/products.json";
        $allProducts = file_exists($fileProducts) ? json_decode(file_get_contents($fileProducts), true) ?? [] : [];

        $pagination = paginateData($allProducts, 4);

        $paginatedProducts = $pagination['data'];
        $currentPage       = $pagination['current_page'];
        $totalPages        = $pagination['total_pages'];

    ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <?php
                showMessage(); 
            ?>

            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                    <img class="card-img-top mb-5 mb-md-0" src="<?= BASE_URL . 'uploads/products/' . $product['image'] ?>" alt="Product image" />                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <div class="small mb-1">SKU: BST-498</div> -->
                    <h6 class="display-5 fw-bolder"><?= $product['product_name']?></h6>

                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="fw-bold">Price : $<?= $product['price']?></span> 
                        </div>
                        
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="fw-bold">Status : <?= $product['status']?></span> 
                        </div>
                        
                    </div>
                    <div class="d-flex mb-3">
                        <div class="me-3">
                            <span class="fw-bold">Quantity : <?= $product['stock_quantity']?></span> 
                        </div>
                        
                    </div>
                    <div class="d-flex mb-3">
                        <div class="mb-3">
                            <span class="fw-bold"> Category : <?= getCategoryNameById($product['category_id']) ?></span>
                        </div>
                    </div>
                    <form action="<?= BASE_URL ?>handeler/orders/addToCart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                        <div class="d-flex mb-4">
                            <input class="form-control text-center me-3" name="quantity" type="number" value="1" min="1" style="max-width: 5rem" />
                            
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit" name="action" value="add_to_cart">
                                <i class="bi-cart-fill me-1"></i> Add to cart
                            </button>
                        </div>

                        <div class="d-flex gap-2 mb-4">
                            <button class="btn btn-dark" type="submit" name="action" value="buy_now">Buy Now</button>
                            <button class="btn btn-outline-secondary" type="submit" name="action" value="save_for_later">Save for Later</button>
                        </div>
                    </form>

                    <hr class="my-4"> 
                     <?php 
                     if (isset($_SESSION['user'])):?>
                    <div class="d-flex gap-2 mt-3">
                        <a href="<?= BASE_URL . 'views/products/product-update.php?id=' . $product['id'] ?>" class="btn btn-warning px-4">
                            <i class="bi-pencil-square me-1"></i> Edit
                        </a>
                        <a href="<?= BASE_URL . 'handeler/products/deleteProduct.php?id=' . $product['id'] ?>" class="btn btn-danger px-4">
                            <i class="bi-trash me-1"></i> Delete
                        </a>
                    </div>
                    <?php endif ;?>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bolder mb-3">Product Description</h3>
                            <p><?= $product['description']?></p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 justify-content-center">
                
                <?php foreach ($paginatedProducts as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm">
                        <a  href="<?=BASE_URL?>views/products/product.php?id=<?= $product['id'] ?>"> <img class="card-img-top" src="<?= BASE_URL . 'uploads/products/' . $product['image'] ?>" alt="Product image" /></a>

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
        
    </section>

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
                        <a class="page-link" href="?id=<?= $product['id'] ?>&page=<?= $currentPage + 1 ?>">Next</a>
                    </li>

                </ul>
            </nav>
        
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