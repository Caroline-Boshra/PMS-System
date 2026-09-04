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
    <!-- Header-->
    
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
                        <img class="card-img-top" src="<?= BASE_URL . 'uploads/products/' . $product['image'] ?>" alt="Product image" />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $product['product_name'] ?></h5>
                               <h5 class="fw-bolder"> Price : $<?= $product['price'] ?> </h5>
                                <h5 class="fw-bolder">Category : <?= getCategoryNameById($product['category_id']) ?></h5>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="views/product.php?id=<?= $product['id'] ?>">View item</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>
        <?php 
            if ($totalPages > 1): ?>
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
        <?php endif; ?>
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