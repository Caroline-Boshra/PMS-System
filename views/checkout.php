<?php 
session_start();
require_once dirname(__FILE__, 2) . "/config.php";

if (empty($_SESSION['cart'])) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Checkout - EraaSoft PMS Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>assets/favicon.ico" />
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
    ?>
    
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            
            <h2 class="mb-4">Checkout Process</h2>

           
                    
            <?php $old_data = $_SESSION['old_data'] ?? []; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="border p-3 bg-light rounded">
                        <h4 class="mb-3">Order Summary</h4>
                        <div class="products">
                            <ul class="list-unstyled">
                                <?php 
                                $total = 0;
                                foreach ($_SESSION['cart'] as $item): 
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $total += $itemTotal;
                                ?>
                                    <li class="border-bottom p-2 my-1 d-flex justify-content-between align-items-center">
                                        <span><?= htmlspecialchars($item['product_name']) ?></span>
                                        <span class="text-success fw-bold">
                                            <?= $item['quantity'] ?> x $<?= htmlspecialchars($item['price']) ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <hr>
                        <h3 class="text-end">Total : $<?= number_format($total, 2) ?></h3>
                    </div>
                </div>
              
               <div class="col-md-8">
                    
                    <form action="<?= BASE_URL ?>handeler/orders/handelCheckout.php" method="POST" class="form border my-2 p-4 bg-white rounded shadow-sm">
                        
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="<?= $old_data['name'] ?? '' ?>" class="form-control" >
                            <?= showFieldError('name'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= $old_data['email'] ?? '' ?>" class="form-control" >
                            <?= showFieldError('email'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="<?= $old_data['address'] ?? '' ?>" class="form-control" >
                            <?= showFieldError('address'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" value="<?= $old_data['phone'] ?? '' ?>" class="form-control" >
                            <?= showFieldError('phone'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="">Notes</label>
                            <input type="text" name="notes" value="<?= $old_data['notes'] ?? '' ?>" class="form-control">
                            <?= showFieldError('notes'); ?>
                        </div>
                        
                        <div class="mb-3">
                            <input type="submit" value="Send" class="btn btn-success">
                        </div>
                        
                    </form>
    
                    <?php 
                    unset($_SESSION['old_data']); 
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php 
    require_once BASE_PATH . "inc/footer.php" ;
    ?>
    
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= BASE_URL ?>js/scripts.js"></script>
</body>
</html>

