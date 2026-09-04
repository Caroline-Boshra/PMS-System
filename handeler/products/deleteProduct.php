<?php 
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

  
if (!isset($_GET['id'])) {
    die("No product selected | 404");
}

$id = $_GET['id'];
$productExists = false;

foreach (getProducts() as $product) {
    if ($product['id'] == $id) {
        $productExists = true;
        break;
    }
}

if (!$productExists) {
    die("Product not found | 404");
}

deleteProduct($id);

if (function_exists('setMessage')) {
    setMessage("Product deleted successfully", "success");
}

header("Location: " . BASE_URL . "index.php"); 
exit(); 
?>