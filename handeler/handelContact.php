<?php
require_once dirname(__FILE__,2) . "/config.php";
require_once BASE_PATH ."core/functions.php";
require_once BASE_PATH ."core/validations.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    die("This method is not allowed | 404");
}
$name=trim(htmlspecialchars($_POST['name']));
$email=trim(htmlspecialchars($_POST['email']));
$message=trim(htmlspecialchars($_POST['message']));

$isValid = validateAllFields($name, $email, $message);

if (!$isValid) {
    setMessage($isValid, "danger"); 
    $_SESSION['old_data'] = $_POST;
    header("Location: " . BASE_URL . "/views/contact.php");
    exit();
} else {
    if (contactData($name, $email, $message)) {
        setMessage("your message sent successfully we will call you back", "success");
        header("Location: " . BASE_URL . "/index.php");
        exit();
    } else {
        setMessage("Failed to send your question ,please try again.", "danger");
        header("Location: " . BASE_URL . "/views/contact.php");
        exit();
    }
}
