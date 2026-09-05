
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
        <title>Saved For Later</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= BASE_URL ?>css/styles.css" rel="stylesheet" />
</head>
<body>
    <?php
        require_once BASE_PATH . "inc/nav.php" ;
        require_once BASE_PATH . "inc/header.php" ;
        require_once BASE_PATH ."core/functions.php";
        require_once BASE_PATH ."core/validations.php";
    ?>
    <div class="container" style="margin-top: 50px;">

        <?php if(isset($_SESSION['success'])): ?>
            <div style="color: green; margin-bottom: 20px;">
                <?= $_SESSION['success']; ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($_SESSION['saved_items'])): ?>
            
            <p>You have no items saved for later.</p>
            <a href="<?= BASE_URL ?>/index.php">Continue Shopping</a>
            
        <?php else: ?>
            
            <table border="1" width="100%" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['saved_items'] as $item): ?>
                        <tr>
                            <td>
                                <img src="<?= BASE_URL ?>/uploads/products/<?= ($item['image']) ?>" alt="Product" width="60">
                            </td>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td>$<?= htmlspecialchars($item['price']) ?></td>
                            
                            <td>
                                <form action="<?= BASE_URL ?>/handeler/saveForLater.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="action" value="move_to_cart">
                                    <button type="submit" style="background: green; color: white;">Move to Cart</button>
                                </form>

                                <form action="<?= BASE_URL ?>handeler/saveForLater.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" style="background: red; color: white;">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
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
   
