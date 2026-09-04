<?php
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$product_name   = trim(htmlspecialchars($_POST['product_name']));
$category_id    = trim(htmlspecialchars($_POST['category_id']));
$price          = trim(htmlspecialchars($_POST['price']));
$stock_quantity = trim(htmlspecialchars($_POST['stock_quantity']));
$description    = trim(htmlspecialchars($_POST['description']));
$status         = trim(htmlspecialchars($_POST['status']));
$image          = $_FILES['image'];


$isValid = validateProductsFields($product_name, $category_id, $price, $stock_quantity, $image, $description, $status);

if (!$isValid) {
    setMessage("Please,there is an error", "danger"); 
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "/views/products/product-create.php");
    exit();
} 

$extension = pathinfo($image['name'], PATHINFO_EXTENSION);
$image_Name = uniqid("img_", true) . "." . $extension; 

$uploadDir = BASE_PATH . "uploads/products/";


if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$destination = $uploadDir . $image_Name;

if (move_uploaded_file($image['tmp_name'], $destination)) {
    
    if (productsData($product_name, $category_id, $price, $stock_quantity, $image_Name, $description, $status)) {
        setMessage("Product added successfully!", "success");
        unset($_SESSION['old_data']);
        header("Location: " . BASE_URL . "/index.php");
        exit();
    }
}

setMessage("Failed to add product, please try again.", "danger");
header("Location: " . BASE_URL . "/views/products/product-create.php");
exit();