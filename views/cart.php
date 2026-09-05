<?php 
session_start();
require_once dirname(__FILE__, 2) . "/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shopping Cart - EraaSoft PMS Template</title>
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
    ?>
    
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-12">
                    
                    <?php if (empty($_SESSION['cart'])): ?>
                        <div class="text-center py-5">
                            <h3>Your Cart is Empty!</h3>
                            <p class="text-muted">You haven't added any products to your cart yet.</p>
                            <a href="<?= BASE_URL ?>index.php" class="btn btn-outline-dark mt-3">Continue Shopping</a>
                        </div>
                    <?php else: ?>
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                           <tbody>
                                <?php 
                                $index = 1;
                                $grandTotal = 0;
                                foreach ($_SESSION['cart'] as $id => $item): 
                                    $itemTotal = $item['price'] * $item['quantity'];
                                    $grandTotal += $itemTotal;
                                ?>
                                    <tr>
                                        <th scope="row"><?= $index++; ?></th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if(!empty($item['image'])): ?>
                                                    <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($item['image']) ?>" alt="" width="50" class="me-2">
                                                <?php endif; ?>
                                                <span><?= htmlspecialchars($item['product_name']); ?></span>
                                            </div>
                                        </td>
                                        <td>$<?= htmlspecialchars($item['price']); ?></td>
                                        
                                        <td>
                                            <form action="<?= BASE_URL ?>handeler/orders/handelCart.php?action=update&id=<?= $id ?>" method="POST" class="d-flex align-items-center">
                                                <input type="number" name="quantity" class="form-control text-center me-2" value="<?= $item['quantity']; ?>" min="1" style="width: 80px;" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        
                                        <td>$<?= number_format($itemTotal, 2); ?></td>
                                        
                                        <td>
                                            <a href="<?= BASE_URL ?>handeler/orders/handelCart.php?action=delete&id=<?= $id ?>" class="btn btn-danger btn-sm">
                                                <i class="bi-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <tr>
                                    <td colspan="3" class="text-end fw-bold">
                                        Total Price:
                                    </td>
                                    <td colspan="2">
                                        <h4 class="text-success m-0">$<?= number_format($grandTotal, 2); ?></h4>
                                    </td>
                                    <td>
                                        <a href="<?= BASE_URL ?>views/checkout.php" class="btn btn-primary w-100">Checkout</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php endif; ?>

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