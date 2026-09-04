<!DOCTYPE html>
<html lang="en">
<?php    
 require_once dirname(__FILE__,2) . "/config.php";
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - EraaSoft PMS Template</title>
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
    require_once BASE_PATH . "inc/nav.php" ;
    require_once BASE_PATH . "inc/header.php" ;
    require_once BASE_PATH ."core/functions.php";
    require_once BASE_PATH ."core/validations.php";
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $old_data = $_SESSION['old_data'] ?? [];
    ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-8 mx-auto">
                    <form action="<?=BASE_URL ?>handeler/handelContact.php"  method ="POST" class="form border my-2 p-3">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" value="<?= $old_data['name'] ?? '' ?>" class="form-control">
                               <?= showFieldError('name'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" id="" value="<?= $old_data['email'] ?? '' ?>" class="form-control">
                               <?= showFieldError('email'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="">Message</label>
                                <textarea name="message" id="" class="form-control" rows="7"><?= $old_data['message'] ?? '' ?></textarea>
                                <?= showFieldError('message'); ?>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Send" id="" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                    <?php 
                    unset($_SESSION['old_data']); 
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php 
    require_once BASE_PATH ."inc/footer.php" ;
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>