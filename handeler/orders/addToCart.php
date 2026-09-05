<?php
session_start();
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$product_id = $_POST['product_id'] ?? null;
$quantity   = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
$action     = $_POST['action'] ?? 'add_to_cart';

$products = getProducts();
$product  = null;
foreach ($products as $p) {
    if ($p['id'] == $product_id) {
        $product = $p;
        break;
    }
}


$isValid = validateCartFields($product, $quantity);


if (!$isValid) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    
    switch ($action) {
        case 'add_to_cart':
            addToCart($product, $quantity); 
            $_SESSION['success'] = "Product added to cart!";
            header("Location: " . BASE_URL ."views/cart.php");
            break;
            
        case 'buy_now':
            addToCart($product, $quantity); 
            header("Location: " . BASE_URL ."views/checkout.php");
            break;
            
        case 'save_for_later':
            if (isset($_SESSION['saved_items'][$product_id])) {
                unset($_SESSION['saved_items'][$product_id]);
                $_SESSION['success'] = "Product removed from wishlist.";
            } else {
                saveProductForLater($product);
                $_SESSION['success'] = "Product saved for later!";
            }
            
            header("Location: " . $_SERVER['HTTP_REFERER']); 
            break;
    }
    exit();
}