<?php
session_start();
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";



$action = $_GET['action'] ?? $_POST['action'] ?? '';
$id     = $_GET['id'] ?? $_POST['product_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] !== "POST" && $_SERVER['REQUEST_METHOD'] !== "GET") {
    die("This method is not allowed | 404");
}

if ($action === 'delete' && $id !== null) {
    removeFromCart($id);
}

if ($action === 'update' && $id !== null) {
    $newQuantity = $_POST['quantity'] ?? 1;
    updateCartQuantity($id, $newQuantity);
}

header("Location: " . BASE_URL . "views/cart.php");
exit();