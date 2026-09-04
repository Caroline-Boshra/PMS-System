<?php
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$id             = trim(htmlspecialchars($_POST['id'] ?? ''));
$product_name   = trim(htmlspecialchars($_POST['product_name']));
$category_id    = trim(htmlspecialchars($_POST['category_id']));
$price          = trim(htmlspecialchars($_POST['price']));
$stock_quantity = trim(htmlspecialchars($_POST['stock_quantity']));
$description    = trim(htmlspecialchars($_POST['description']));
$status         = trim(htmlspecialchars($_POST['status']));
$image          = $_FILES['image'] ?? null;
$old_image      = $_POST['old_image'] ?? '';

$isValid = validateProductsFields($product_name, $category_id, $price, $stock_quantity, $image, $description, $status, true);

if (!$isValid) {
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "views/products/product-update.php?id=" . $id);
    exit();
} 

$image_Name = $old_image; 
$uploadDir = BASE_PATH . "uploads/products/";

if (isset($image) && $image['error'] === UPLOAD_ERR_OK) {
    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_Name = uniqid("prod_", true) . "." . $extension; 
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $destination = $uploadDir . $image_Name;
    
    if (move_uploaded_file($image['tmp_name'], $destination)) {
        if (!empty($old_image) && file_exists($uploadDir . $old_image)) {
            @unlink($uploadDir . $old_image);
        }
    }
}

if (updateProducts($id, $product_name, $category_id, $price, $stock_quantity, $image_Name, $description, $status)) {
    setMessage("Product updated successfully!", "success");
    unset($_SESSION['old_data']);
    header("Location: " . BASE_URL . "views/products/product.php?id=" . $id); 
    exit();
}