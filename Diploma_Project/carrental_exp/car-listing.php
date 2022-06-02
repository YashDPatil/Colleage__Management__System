<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Car Rental Portal | Car Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>


    <?php include('includes/header.php');?>

    <section class="page-header listing_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Car Listing</h1>
                </div>
            </div>
        </div>

    </section>

    <section class="listing-page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="result-sorting-wrapper">
                        <div class="sorting-count">
                            <?php 

$sql = "SELECT id from tblvehicles";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
                            <p><span><?php echo htmlentities($cnt);?> Listings</span></p>
                        </div>
                    </div>

                    <?php $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-img"><img src="assets/images/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="product-img" alt="Image" /> </a>
                        </div>
                        <div class="product-listing-content">
                            <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h5>
                            <p class="list-price">₹<?php echo htmlentities($result->PricePerDay);?> Per Day</p>
                            <ul>
                                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> seats</li>
                                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> model</li>
                                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
                            </ul>
                            <a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
                        </div>
                    </div>
                    <?php }} ?>
                </div>


                <aside class="col-md-3 col-md-pull-9">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Car </h5>
                        </div>
                        <div class="sidebar_filter">
                            <form action="search-carresult.php" method="post">
                                <div class="form-group select">
                                    <select class="form-control" name="brand">
                                        <option>Select Brand</option>

                                        <?php $sql = "SELECT * from  tblbrands ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{       ?>
                                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                                        <?php }} ?>

                                    </select>
                                </div>
                                <div class="form-group select">
                                    <select class="form-control" name="fueltype">
                                        <option>Select Fuel Type</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="CNG">CNG</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-block"><i class="fa fa-search" aria-hidden="true"></i> Search Car</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </section>

    <?php include('includes/footer.php');?>
    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>
    <?php include('includes/forgotpassword.php');?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
