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
    ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row">
                <div class="col-4">
                    <div class="border p-2">
                        <div class="products">
                            <ul class="list-unstyled">
                                <li class="border p-2 my-1"> Product #1 -
                                    <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                                </li>
                                <li class="border p-2 my-1"> Product #1 -
                                    <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                                </li>
                                <li class="border p-2 my-1"> Product #1 -
                                    <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                                </li>
                                <li class="border p-2 my-1"> Product #1 -
                                    <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                                </li>
                                <li class="border p-2 my-1"> Product #1 -
                                    <span class="text-success mx-2 mr-auto bold">2 x 25$</span>
                                </li>
                            </ul>
                        </div>
                        <h3>Total : 644 $</h3>
                    </div>
                </div>
                <div class="col-8">
                    <form action="" class="form border my-2 p-3">
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="email" name="" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Address</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Phone</label>
                                <input type="number" name="" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Notes</label>
                                <input type="text" name="" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Send" id="" class="btn btn-success">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
   <?php 
   
    require_once BASE_PATH . "inc/footer.php" ;
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>