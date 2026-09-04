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

$email            = trim(htmlspecialchars($_POST['email'] ?? ''));
$password         = trim(htmlspecialchars($_POST['password'] ?? ''));

$isValid = validateLoginFields($email, $password);

if (!$isValid) {
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "views/auth/login.php");
    exit();
} else {
    if (loginUser( $email, $password)) {
        setMessage("Login successful", "success");
        header("Location: " . BASE_URL . "index.php");
        exit();
    } else {
        setMessage("Invalid email or password", "danger");
        header("Location: " . BASE_URL . "views/auth/login.php");
        exit();
    }
}