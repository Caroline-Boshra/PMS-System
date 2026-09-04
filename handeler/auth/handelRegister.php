<?php
require_once dirname(__FILE__, 3) . "/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once BASE_PATH . "core/functions.php";
require_once BASE_PATH . "core/validations.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}

$name             = trim(htmlspecialchars($_POST['name'] ?? ''));
$email            = trim(htmlspecialchars($_POST['email'] ?? ''));
$password         = trim(htmlspecialchars($_POST['password'] ?? ''));
$confirm_password = trim(htmlspecialchars($_POST['confirm_password'] ?? ''));

$isValid = validateRegisterFields($name, $email, $password, $confirm_password);

if (!$isValid) {
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "views/auth/register.php");
    exit();
} else {
    if (registerUser($name, $email, $password)) {
        setMessage("Registration successful", "success");
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        setMessage("Failed to register, try again.", "danger");
        header("Location: " . BASE_URL . "views/auth/register.php");
        exit();
    }
}