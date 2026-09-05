<?php
session_start();
require_once dirname(__FILE__, 2) . "/config.php";
require_once BASE_PATH . "core/functions.php"; 

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$product_id = $_POST['product_id'] ?? null;
$action     = $_POST['action'] ?? '';

if ($product_id && isset($_SESSION['saved_items'][$product_id])) {
    
    if ($action === 'remove') {
        unset($_SESSION['saved_items'][$product_id]);
        $_SESSION['success'] = "Product removed from saved items.";
    } 
    
    elseif ($action === 'move_to_cart') {
        $product = $_SESSION['saved_items'][$product_id];
        
        addToCart($product, 1);
        
        unset($_SESSION['saved_items'][$product_id]);
        
        $_SESSION['success'] = "Product moved to cart successfully!";
    }
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();