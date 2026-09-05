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
    <title>About Us - EraaSoft PMS Template</title>
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
                <div class="col-12">
                    
                    <!-- Our Mission -->
                    <div class="border p-4 text-center my-5 shadow-sm">
                        <h2>Our Mission</h2>
                        <p class="text-muted mt-3">
                            Our mission is to provide an exceptional and seamless online shopping experience by offering a wide range of high-quality products, competitive prices, and reliable customer service. We strive to build long-lasting relationships with our customers based on trust, transparency, and satisfaction.
                        </p>
                    </div>

                    <div class="border p-4 text-center my-5 shadow-sm">
                        <h2>Our Vision</h2>
                        <p class="text-muted mt-3">
                            Our vision is to become a leading and trusted online shopping destination, recognized for our innovation, premium product selection, and unwavering commitment to customer happiness. We aim to continuously evolve and expand our offerings to meet the dynamic needs of our modern shoppers.
                        </p>
                    </div>

                    <div class="border p-4 my-5 shadow-sm">
                        <h2 class="text-center mb-4">Our Goals</h2>
                        <h6 class="border p-3 my-2 bg-light">1. Deliver top-notch quality products that consistently exceed customer expectations.</h6>
                        <h6 class="border p-3 my-2 bg-light">2. Provide a secure, fast, and user-friendly online shopping and checkout experience.</h6>
                        <h6 class="border p-3 my-2 bg-light">3. Build enduring customer trust through transparent policies and dedicated support.</h6>
                        <h6 class="border p-3 my-2 bg-light">4. Expand our product inventory continuously to cover diverse lifestyle and tech needs.</h6>
                        <h6 class="border p-3 my-2 bg-light">5. Ensure fast and reliable order delivery right to our customers' doorsteps.</h6>
                        <h6 class="border p-3 my-2 bg-light">6. Maintain competitive pricing without ever compromising on product excellence.</h6>
                        <h6 class="border p-3 my-2 bg-light">7. Foster a culture of continuous innovation and improvement across our platform.</h6>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer-->
    <?php 
    require_once BASE_PATH . "inc/footer.php" ;
    ?>
    
    <!-- Bootstrap core JS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?= BASE_URL ?>js/scripts.js"></script>
</body>

</html>