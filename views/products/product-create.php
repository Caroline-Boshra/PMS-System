<!DOCTYPE html>
<html lang="en">
<?php    
require_once dirname(__FILE__, 3) . "/config.php";
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Create Products Page </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= BASE_URL ?>css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php 
    require_once BASE_PATH . "inc/nav.php";
    require_once BASE_PATH . "inc/header.php";
    require_once BASE_PATH ."core/functions.php";
    require_once BASE_PATH ."core/validations.php";
    ?>

    <div class="container py-5">
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $old_data = $_SESSION['old_data'] ?? [];
        unset($_SESSION['old_data']); 
        ?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                
                
                <?php 
                // showMessage();
                 ?>

                <form action="<?= BASE_URL ?>handeler/products/addProducts.php" method="post" enctype="multipart/form-data" class="border rounded p-4 shadow-sm bg-white">
                    
                    <!-- Product Name -->
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold">Product Name</label>
                        <input type="text" id="product_name" name="product_name" value="<?= $old_data['product_name'] ?? '' ?>" class="form-control border border-success" placeholder="Enter product name" >
                        <?= showFieldError('product_name'); ?>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="product_category" class="form-label fw-bold">Category</label>
                        <select id="product_category" name="category_id" class="form-select border border-success" >
                            <option value="">Select category</option>
                            <?php 
                            $selected_cat = $old_data['category_id'] ?? '';
                            $categories = [
                                "1" => "Sports Cars",
                                "2" => "SUVs",
                                "3" => "Sedans",
                                "4" => "Electric Cars",
                                "5" => "Luxury Cars"
                            ];
                            foreach ($categories as $id => $name): 
                            ?>
                            <option value="<?= $id ?>" <?= ($selected_cat == $id) ? 'selected' : '' ?>><?= $name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= showFieldError('category_id'); ?>
                    </div>

                    <!-- Price & Stock -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Price</label>
                            <input type="number" id="price" name="price" value="<?= $old_data['price'] ?? '' ?>" class="form-control border border-success" step="0.01" min="0" placeholder="0.00" >
                            <?= showFieldError('price'); ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label fw-bold">Stock Quantity</label>
                            <input type="number" id="stock" name="stock_quantity" value="<?= $old_data['stock_quantity'] ?? '1' ?>" class="form-control border border-success" min="0" >
                            <?= showFieldError('stock_quantity'); ?>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image_url" class="form-label fw-bold">Image</label>
                        <input type="file" id="image_url" name="image" class="form-control border border-success">
                        <?= showFieldError('image'); ?>
                    </div>
                        
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea id="description" name="description" rows="5" class="form-control border border-success" placeholder="Write a short product description..." ><?= $old_data['description'] ?? '' ?></textarea>
                        <?= showFieldError('description'); ?>
                    </div>
                    
                    <!-- Status -->
                    <div class="mb-4">
                        <label class="form-label fw-bold d-block">Status</label>
                        <?php $status_val = $old_data['status'] ?? 'active'; ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="active" value="active" <?= ($status_val === 'active') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive" <?= ($status_val === 'inactive') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="inactive">Inactive</label>
                        </div>
                        <?= showFieldError('status'); ?>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex gap-2">
                        <input type="submit" value="Add Product" class="btn btn-primary px-4">
                        <a href="product.php" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer-->
    <?php require_once BASE_PATH . "inc/footer.php"; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>