<?php    
 require_once dirname(__FILE__,2) . "/config.php";
 if (session_status() === PHP_SESSION_NONE) {
    session_start();
 }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <!-- <a class="navbar-brand" href="<?= BASE_URL ?>index.php">EraaSoft PMS</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/products/product.php">All Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/myOrders.php">My Orders </a></li>
                    <?php if (isset($_SESSION['user'])):?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/products/product-create.php">Create Product</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>handeler/auth/logout.php">LogOut</a></li>
                    <?php else:?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>views/auth/register.php">Register</a></li>
                    <?php endif ;?>
                </ul>
                
 <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex flex-row align-items-center gap-2 list-unstyled">
    
    <li>
        <form class="d-flex m-0" action="<?= BASE_URL ?>views/cart.php">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi-cart-fill me-1"></i>
                Cart
                <span class="badge bg-dark text-white ms-1 rounded-pill">
                    <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                </span>
            </button>
        </form>
    </li> 

    <li>
        <a href="<?= BASE_URL ?>views/wishlist.php" class="btn btn-outline-dark">
            <i class="bi-heart-fill me-1 text-danger"></i>
            Wishlist
            <span class="badge bg-dark text-white ms-1 rounded-pill">
                <?= isset($_SESSION['saved_items']) ? count($_SESSION['saved_items']) : 0 ?>
            </span>
        </a>
    </li>

</ul>
            </div>
        </div>
    </nav>