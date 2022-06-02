<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="./assets/css/style.css" type="text/css">

    <script type="text/javascript">
        function validate() {
            var startDt = new Date(document.bookingform.fromdate.value);
            var endDt = new Date(document.bookingform.todate.value);
            var currentDate = new Date()
            if (currentDate.getDate() > startDt.getDate() || currentDate.getDate() > endDt.getDate()) {
                alert("Invalid Dates");
                return false
            }
            if ((startDt.getTime() < endDt.getTime())) {
                if ((startDt.getTime() < endDt.getTime())) {

                    return true
                }
                alert("Invalid Dates");
                return false
            }
        }

    </script>
</head>

<body>


    <?php include('includes/header.php');?>


    <?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>
    <script type="text/javascript">
        function generatePay() {
            var startDt = new Date(document.bookingform.fromdate.value);
            var endDt = new Date(document.bookingform.todate.value);
            var payAm = (endDt.getDate() - startDt.getDate()) * <?php echo($result->PricePerDay);?>;
            if ((startDt.getTime() < endDt.getTime())) {
                document.getElementById("payableamount").innerHTML = "Amount : ₹ " + payAm;
            }

        }

    </script>
    <center>
        <section id="listing_img_slider">
            <img src="assets/images/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560">
            <?php if($result->Vimage5=="")
    {

    } else {
  ?>
            <div><img src="assets/images/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
            <?php } ?>
        </section>
    </center>


    <section class="listing-detail">
        <div class="container">
            <div class="listing_detail_head row">
                <div class="col-md-9">
                    <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
                </div>
                <div class="col-md-3">
                    <div class="price_info">
                        <p>₹<?php echo htmlentities($result->PricePerDay);?> </p>Per Day

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="main_features">
                        <ul>

                            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                                <h5><?php echo htmlentities($result->ModelYear);?></h5>
                                <p>Reg.Year</p>
                            </li>
                            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                                <h5><?php echo htmlentities($result->FuelType);?></h5>
                                <p>Fuel Type</p>
                            </li>

                            <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                                <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
                                <p>Seats</p>
                            </li>
                        </ul>
                    </div>
                    <div class="listing_more_info">
                        <div class="listing_detail_wrap">

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="accesories-tab" data-toggle="tab" href="#accesories" role="tab" aria-controls="accesories" aria-selected="false">accesories</a>
                                </li>

                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <p><?php echo htmlentities($result->VehiclesOverview);?></p>
                                </div>
                                <div class="tab-pane fade" id="accesories" role="tabpanel" aria-labelledby="accesories-tab">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Accessories</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Air Conditioner</td>
                                                <?php if($result->AirConditioner==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>AntiLock Braking System</td>
                                                <?php if($result->AntiLockBrakingSystem==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else {?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Power Steering</td>
                                                <?php if($result->PowerSteering==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>


                                            <tr>

                                                <td>Power Windows</td>

                                                <?php if($result->PowerWindows==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>CD Player</td>
                                                <?php if($result->CDPlayer==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Leather Seats</td>
                                                <?php if($result->LeatherSeats==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Central Locking</td>
                                                <?php if($result->CentralLocking==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Power Door Locks</td>
                                                <?php if($result->PowerDoorLocks==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td>Brake Assist</td>
                                                <?php if($result->BrakeAssist==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php  } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Driver Airbag</td>
                                                <?php if($result->DriverAirbag==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Passenger Airbag</td>
                                                <?php if($result->PassengerAirbag==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else {?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Crash Sensor</td>
                                                <?php if($result->CrashSensor==1)
{
?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane" id="vehicleover" aria-labelledby="nav-home-tab">


                                </div>

                                <div role="tabpanel" class="tab-pane" id="accessories" nav-home-tab="nav-accesories-tab">

                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }} ?>

                </div>


                <aside class="col-md-3">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
                        </div>
                        <form method="post" onsubmit="return validate();" name="bookingform">
                            <div class="form-group">
                                <input type="date" class="form-control" name="fromdate" placeholder="From Date(dd/mm/yyyy)" type="date" required>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" name="todate" placeholder="To Date(dd/mm/yyyy)" type="date" required onchange="generatePay();">
                            </div>
                            <div class="form-group">
                                <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group">
                                <p id="payableamount" name="payableamount" class="h3">Amount : ₹ <?php echo htmlentities($result->PricePerDay);?></p>
                            </div>
                            <?php if($_SESSION['login'])
              {?>
                            <div class="form-group">
                                <input type="submit" class="btn" name="submit" value="Book Now">
                            </div>
                            <?php } else { ?>
                            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

                            <?php } ?>
                        </form>
                    </div>
                </aside>

            </div>

            <div class="space-20"></div>
            <div class="divider"></div>

        </div>
    </section>

    <?php include('includes/footer.php');?>
    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>
    <?php include('includes/forgotpassword.php');?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!--    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
