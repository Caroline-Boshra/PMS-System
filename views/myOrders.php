<!DOCTYPE html>
<html lang="en">
<?php    
 require_once dirname(__FILE__,2) . "/config.php";
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
    $allOrders = $_SESSION['orders'] ?? [];
    $old_data = $_SESSION['old_data'] ?? [];
    ?>
    <div class="container mt-5">
        <h2>My Orders History</h2>
        
        <?php if (empty($allOrders)): ?>
            <div class="alert alert-info">You haven't placed any orders yet.</div>
        <?php else: ?>
            
            <?php foreach ($allOrders as $index => $order): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-dark text-white d-flex justify-content-between">
                        <span>Order #<?= $index + 1 ?></span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php 
                            $orderTotal = 0;
                            foreach ($order['items'] as $item): 
                                $itemTotal = $item['price'] * $item['quantity'];
                                $orderTotal += $itemTotal;
                            ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?="product name : ". htmlspecialchars($item['product_name']) ."<br> quantity = " ?> (x<?= $item['quantity'] ?>)</span>
                                </li>
                                <br>
                                <?php endforeach; ?>
                            </ul>
                            <h5 class="list-group-item d-flex justify-content-between">Total Price : $<?= number_format($orderTotal, 2) ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php endif; ?>
    </div>
     <?php 
    require_once BASE_PATH ."inc/footer.php" ;
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>