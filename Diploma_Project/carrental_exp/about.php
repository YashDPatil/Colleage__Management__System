<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Car Rental Portal | Page details</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    <?php include('includes/header.php');?>

    <section class="page-header aboutus_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>About Us</h1>
                </div>
                <ul class="coustom-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>About Us </li>
                </ul>
            </div>
        </div>

        <div class="dark-overlay"></div>
    </section>

    <div class="container">
        <div class="my-5">
            <p class="h3">We’ll move mountains to find you the right rental car, and bring you a smooth, hassle-free experience from start to finish. Here you can find out more about how we work.</p>

            <p class="h5">In simple terms, because we bring you unbeatable value and peace of mind throughout your rental car journey.</p>

            <p class="h6">Making sure you have a great experience every time you rent a car makes us happy.</p>
            <span>We are a broker, so we arrange the car rental on your behalf. We use our massive buying power to bring you great deals. But we’re way more than a price comparison site, because we stay with you every step of the way.</span>
        </div>

    </div>

    <?php include('includes/footer.php');?>
    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>
    <?php include('includes/forgotpassword.php');?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
