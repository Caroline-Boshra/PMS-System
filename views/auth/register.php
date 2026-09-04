<?php
require_once dirname(__FILE__, 3) . "/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register Form</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="<?= BASE_URL ?>css/styles.css" rel="stylesheet" />
</head>
<body>

    <?php 
        
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once BASE_PATH . "inc/nav.php";
        require_once BASE_PATH . "inc/header.php";
        require_once BASE_PATH . "core/functions.php";
        require_once BASE_PATH . "core/validations.php";

        $old_data = $_SESSION['old_data'] ?? [];
    ?>
   
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?= BASE_URL ?>handeler/auth/handelRegister.php" method="POST" class="form border rounded my-2 p-4 shadow-sm bg-white">
                        <h3 class="mb-4 text-center">Create Account</h3>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" value="<?= $old_data['name'] ?? '' ?>" class="form-control">
                            <?= showFieldError('name'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" value="<?= $old_data['email'] ?? '' ?>" class="form-control">
                            <?= showFieldError('email'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control">
                            <?= showFieldError('password'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control">
                            <?= showFieldError('confirm_password'); ?>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
                        </div>
                    </form>
                    <?php unset($_SESSION['old_data']); ?>
                </div>
            </div>
        </div>
    </section>

    <?php require_once BASE_PATH . "inc/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>