<?php
session_start();
require_once dirname(__FILE__, 3) . "/config.php";
require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";


if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$name    = trim(htmlspecialchars($_POST['name'] ?? ''));
$email   = trim(htmlspecialchars($_POST['email'] ?? ''));
$address = trim(htmlspecialchars($_POST['address'] ?? ''));
$phone   = trim(htmlspecialchars($_POST['phone'] ?? ''));
$notes   = $_POST['notes'] ?? '';

$isValid = validateCheckOut($name, $email, $address,$phone,$notes);
if (! $isValid) {
    // setMessage($isValid, "danger"); 
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "/views/checkout.php");
    exit();
}else {
    checkOut();

}