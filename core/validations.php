<?php
require_once dirname(__FILE__,2) . "/config.php";
require_once BASE_PATH . "core/functions.php";


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function requiredField($value, $fieldName) {
    if (empty(trim($value))) {

    $_SESSION['errors'][$fieldName] = "This $fieldName is required.";
        return false; 
    }
    return true; 
}

function validateEmail($email) {
    if (empty($email)) {
        return;
    }
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']["email"] = "This field must be like xxxxxxx@xx.com";
        return false;
    }
    return true;
}

function validateAllFields($name, $email, $message) {
    $_SESSION['errors'] = [];

    $fields = [
        "name" => $name,
        "email" => $email,
        "message" => $message
    ];

    foreach ($fields as $fieldName => $value) {
        requiredField($value, $fieldName);
    }

    validateEmail($email);

    
    if (empty($_SESSION['errors'])) {
        return true; 
    } else {
        return false;
    }
}
function validateImage($imageArray, $fieldName, $maxSizeMB = 2, $isUpdate = false) {
    
    if ($isUpdate && $imageArray['error'] === UPLOAD_ERR_NO_FILE) {
        return true; 
    }

    if ($imageArray['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['errors'][$fieldName] = "Image is required.";
        return false;
    }

    if ($imageArray['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['errors'][$fieldName] = "Failed to upload image | " . $imageArray['error'];
        return false;
    }

    $maxSizeBytes = $maxSizeMB * 1024 * 1024; 
    if ($imageArray['size'] > $maxSizeBytes) {
        $_SESSION['errors'][$fieldName] = "Image size must not exceed {$maxSizeMB} MB.";
        return false;
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    $fileExtension = strtolower(pathinfo($imageArray['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        $_SESSION['errors'][$fieldName] = "Allowed formats are: JPG, JPEG, PNG, WEBP.";
        return false;
    }

    return true; 
}
function validateProductsFields($product_name, $category_id, $price, $stock_quantity, $image, $description, $status, $isUpdate = false) {
    $_SESSION['errors'] = [];

    $fields = [
        "product_name"   => $product_name,
        "category_id"    => $category_id,
        "price"          => $price,
        "stock_quantity" => $stock_quantity,
        "description"    => $description,
        "status"         => $status
    ];

    foreach ($fields as $fieldName => $value) {
        requiredField($value, $fieldName);
    }

    validateImage($image, 'image',2, $isUpdate);
    
    return empty($_SESSION['errors']);
}
function validatePassword($password){

    if (empty($password)) {

        return;
        
    }
    if (strlen($password) <= 6) {
        
     $_SESSION['errors']["password"] = "Password must be at least 6 characters ";

    }
    if (!preg_match("/[A-Z]/",$password)) {
        
        $_SESSION['errors']["password"] = "Password must contain at least 1 capital letter";

    }
    return null;
}
function validatePasswordmatch($password,$confirm_password){
    if ($password !== $confirm_password) {
        
     $_SESSION['errors']["confirm_password"] = "Password confirmation does not match ";

    }
   
    return true;
}
function validateRegisterFields($name, $email, $password, $confirm_password) {
    $_SESSION['errors'] = [];

    $fields = [
        "name" => $name,
        "email" => $email,
        "password" => $password,
        "confirm_password" => $confirm_password
    ];

    foreach ($fields as $fieldName => $value) {
        requiredField($value, $fieldName);
    }

    validateEmail($email);
    validatePassword($password);
    validatePasswordmatch($password,$confirm_password);

    
    if (empty($_SESSION['errors'])) {
        return true; 
    } else {
        return false;
    }
}
function validateLoginFields($email, $password) {
    $_SESSION['errors'] = [];

    $fields = [
        "email" => $email,
        "password" => $password,
    ];

    foreach ($fields as $fieldName => $value) {
        requiredField($value, $fieldName);
    }

    validateEmail($email);
    
    
    if (empty($_SESSION['errors'])) {
        return true; 
    } else {
        return false;
    }
}