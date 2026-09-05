<?php
require_once dirname(__FILE__,2) ."/config.php";
require_once BASE_PATH . "core/validations.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setMessage($message, $type) {
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message
    ];
} 

function showMessage() {
    
    if (isset($_SESSION['message'])) {
        
        $type = $_SESSION['message']['type'];
        $text = $_SESSION['message']['text'];
        
    
        if (is_array($text)) {
            $text = implode("<br>", $text);
        }

        echo "<div class='alert alert-$type' role='alert'>$text</div>";
        
        unset($_SESSION['message']);
    }
} 
function showFieldError($fieldName) {

    if (isset($_SESSION['errors'][$fieldName])) {

        $error = $_SESSION['errors'][$fieldName];

        unset($_SESSION['errors'][$fieldName]); 

        return "<div style='color: red; font-size: 14px; margin-top:5px;'>$error</div>";
    }
    return '';
}

function contactData($name, $email, $message){

    $fileContact= BASE_PATH ."assets/contact.json";

    if (file_exists($fileContact)) {
       
        $contacts = json_decode(file_get_contents($fileContact), true) ?? []; 
    }else {
        $contacts=[];
    }

    if (empty($contacts)) {
        $newId=1;
    }else {
        $ids=array_column($contacts,"id");
        $newId = max($ids) + 1 ;
    }
    $newContact=[

        "id" => $newId,
        "name"=>$name,
        "email"=>$email,
        "message"=>$message
    ];

    $contacts[]=$newContact;

    file_put_contents($fileContact,json_encode($contacts,JSON_PRETTY_PRINT));
    return true;

}

function productsData($product_name, $category_id, $price, $stock_quantity, $image_Name, $description, $status) {

    $fileProducts = BASE_PATH . "assets/products/products.json";

    if (file_exists($fileProducts)) {
        $products = json_decode(file_get_contents($fileProducts), true) ?? []; 
    } else {
        $products = [];
    }

    $newId = empty($products) ? 1 : max(array_column($products, "id")) + 1;

    $newProduct = [
        "id"             => $newId,
        "product_name"   => $product_name,
        "category_id"    => $category_id,
        "price"          => $price,
        "stock_quantity" => $stock_quantity,
        "image"          => $image_Name, 
        "description"    => $description,
        "status"         => $status
    ];

    $products[] = $newProduct; 

    file_put_contents($fileProducts, json_encode($products, JSON_PRETTY_PRINT)) ;
    return true;
}
function getProducts() {
    $fileProducts = BASE_PATH . "assets/products/products.json"; 
    
    if (file_exists($fileProducts)) {
        $currentData = file_get_contents($fileProducts);
        return json_decode($currentData, true) ?? []; 
    }
    return [];
}

function getCategoryNameById($categoryId) {
    $categories = [
        "1" => "Sports Cars",
        "2" => "SUVs",
        "3" => "Sedans",
        "4" => "Electric Cars",
        "5" => "Luxury Cars"
    ];

    return $categories[$categoryId] ?? 'Uncategorized';
}
function updateProducts($id, $product_name, $category_id, $price, $stock_quantity, $image_Name, $description, $status) {
    $fileProducts = BASE_PATH . "assets/products/products.json";
    $products = file_exists($fileProducts) ? (json_decode(file_get_contents($fileProducts), true) ?? []) : [];
    $uploadDir = BASE_PATH . "uploads/products/";

    foreach ($products as &$product) {
        if ($product['id'] == $id ) {
            
            if (!empty($image_Name)) {
                
                
                if (isset($product['image']) && file_exists($uploadDir . $product['image'])) {
                    unlink($uploadDir . $product['image']);
                }
                
                $product['image'] = $image_Name; 
            }

            $product['product_name']   = $product_name;
            $product['category_id']    = $category_id;
            $product['price']          = $price;
            $product['stock_quantity'] = $stock_quantity;
            $product['description']    = $description;
            $product['status']         = $status;
            
            break; 
        }
    }

    return file_put_contents($fileProducts, json_encode($products, JSON_PRETTY_PRINT)) !== false;
}

function deleteProduct($id) {
    $fileProducts = BASE_PATH . "assets/products/products.json";
    $uploadDir = BASE_PATH . "uploads/products/"; 
    
    if (file_exists($fileProducts)) {
        $products = json_decode(file_get_contents($fileProducts), true) ?? []; 
    } else {
        return false;
    }

    foreach ($products as $key => $product) {
        if ($product['id'] == $id) { 
            
            if (!empty($product['image']) && file_exists($uploadDir . $product['image'])) {
                @unlink($uploadDir . $product['image']);
            }
            
            unset($products[$key]);
            break;
        }
    }
    
    $products = array_values($products);
    file_put_contents($fileProducts, json_encode($products, JSON_PRETTY_PRINT));
    
    return true;
}

function registerUser($name, $email, $password) {
    $authfile = BASE_PATH ."/assets/auth/users.json";
    
    if (file_exists($authfile)) {
        $currentData = file_get_contents($authfile);
        $users = json_decode($currentData, true) ?? []; 
    }else {
        $users=[];
    }

    if (empty($users)) {
        $newId=1;
    }else {
        $ids=array_column($users,"id");
        $newId = max($ids) + 1 ;
    }
    $user = [
        'id'   => $newId,
        'name'   => $name,
        'email'  => $email,
        'password'  => password_hash($password,PASSWORD_DEFAULT),
    ];

    
    $users[] = $user;
    
    file_put_contents($authfile, json_encode($users, JSON_PRETTY_PRINT));
    $_SESSION['user']=[
        'id'    => $newId,
        'name'   => $name,
        'email'  => $email,
    ];

    return true;
}
function loginUser($email, $password) {
    $authfile = BASE_PATH ."/assets/auth/users.json";
    
    if (file_exists($authfile)) {
        $currentData = file_get_contents($authfile);
        $users = json_decode($currentData, true) ?? []; 
    }else {
        return false;    
    }

    foreach ($users as $user) {

        if ($email === $user['email'] && password_verify($password,$user['password'])) {

             $_SESSION['user']=[
                'id'    => $user['id'],
                'name'   => $user['name'],
                'email'  => $email,
            ];
            return true;
        }    
        
    }
        
    return false;
}

function paginateData($items, $limit = 4) {
    $totalItems = count($items);
    $totalPages = ceil($totalItems / $limit);

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 
    1;
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $totalPages && $totalPages > 0) {
        $page = $totalPages;
    }

    $offset = ($page - 1) * $limit;

    $paginatedItems = array_slice($items, $offset, $limit);

    return [
        'data'         => $paginatedItems,
        'current_page' => $page,
        'total_pages'  => $totalPages,
    ];
}

function addToCart($product, $quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $id = $product['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$id] = [
            'id'           => $product['id'],
            'product_name' => $product['product_name'],
            'price'        => $product['price'],
            'image'        => $product['image'],
            'quantity'     => $quantity
        ];
    }
}

function saveProductForLater($product) {
    if (!isset($_SESSION['saved_items'])) {
        $_SESSION['saved_items'] = [];
    }

    $id = $product['id'];

    if (!isset($_SESSION['saved_items'][$id])) {
        $_SESSION['saved_items'][$id] = [
            'id'           => $product['id'],
            'product_name' => $product['product_name'],
            'price'        => $product['price'],
            'image'        => $product['image']
        ];
    }
}

function removeFromCart($id) {
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        $_SESSION['success'] = "Product removed from cart successfully.";
    }
}

function updateCartQuantity($id, $quantity) {
    if (isset($_SESSION['cart'][$id])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$id]['quantity'] = (int)$quantity;
            // $_SESSION['success'] = "Cart updated successfully.";
        } else {
            
            removeFromCart($id);
        }
    }
}
function checkOut() {
  

    if (empty($_SESSION['cart'])) {
        return;
    }

    $fileProducts = BASE_PATH . "assets/products/products.json";
    
    if (file_exists($fileProducts)) {
        $allProducts = json_decode(file_get_contents($fileProducts), true) ?? [];

        foreach ($_SESSION['cart'] as $index => $cartItem) {
            $cartProductId = $cartItem['id'] ?? $index; 
            $cartQty = $cartItem['quantity'];

            foreach ($allProducts as &$product) {
                if ($product['id'] == $cartProductId) {
                    $product['stock_quantity'] = max(0, $product['stock_quantity'] - $cartQty);
                    break;
                }
            }
            unset($product); 
        }

        file_put_contents($fileProducts, json_encode($allProducts, JSON_PRETTY_PRINT));
    }

    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    $_SESSION['orders'][] = [
        'order_date' => date('Y-m-d H:i:s'),
        'items'      => $_SESSION['cart']
    ];

    unset($_SESSION['cart']);
    
    $_SESSION['message'] = [
        'type' => 'success',
        'text' => 'Your order has been placed successfully and quantity updated!'
    ];
    
    header("Location: " . BASE_URL . "views/myOrders.php");
    exit();
}