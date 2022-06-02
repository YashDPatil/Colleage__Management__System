<?php
   session_start();
   error_reporting(0);
   include('includes/config.php');
   
   if (isset($_GET['cancel'])) {
         $cancel_id = $_GET['cancel'];
         $sql = "DELETE FROM tblbooking WHERE id = $cancel_id;";
         $query = $dbh -> prepare($sql);
         $query->execute();
   }
   if(strlen($_SESSION['login'])==0)
     { 
   header('location:index.php');
   }
   else{
   ?><!DOCTYPE HTML>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <title>CarForYou - Responsive Car Dealer HTML5 Template</title>
      <
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="assets/css/style.css" type="text/css">
      <link href="assets/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
     
   </head>
   <body>
      <?php include('includes/header.php');?>
      <section class="page-header profile_page">
         <div class="container"
            style="width: auto;height: auto;">
            <div class="page-header_wrap">
               <div class="page-heading">
                  <h1>My Booking</h1>
               </div>
               <ul class="coustom-breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li>My Booking</li>
               </ul>
            </div>
         </div>
         <div class="dark-overlay"></div>
      </section>
      <?php 
         $useremail=$_SESSION['login'];
         $sql = "SELECT * from tblusers where EmailId=:useremail";
         $query = $dbh -> prepare($sql);
         $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
         $query->execute();
         $results=$query->fetchAll(PDO::FETCH_OBJ);
         $cnt=1;
         if($query->rowCount() > 0)
         {
         foreach($results as $result)
         { ?>
      <section class="user_profile inner_pages">
         <div class="container">
         <div class="user_profile_info gray-bg padding_4x4_40">
            <div class="upload_user_logo"> <img src="assets/images/dealer-logo.jpg" alt="image">
            </div>
            <div class="dealer_info">
               <h5><?php echo htmlentities($result->FullName);?></h5>
               <p><?php echo htmlentities($result->Address);?><br>
                  <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country); }}?>
               </p>
            </div>
         </div>
         <div class="row">
            <div class="col-md-3 col-sm-3">
               <?php include('includes/sidebar.php');?>
               <div class="col-md-6 col-sm-8">
                  <div class="profile_wrap">
                     <h5 class="uppercase underline">My Booikngs </h5>
                     <div class="my_vehicles_list">
                        <ul class="vehicle_listing">
                           <?php 
                              $useremail=$_SESSION['login'];
                               $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblbooking.id as bkid from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail and tblbooking.Status!=2";
                              $query = $dbh -> prepare($sql);
                              $query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
                              $query->execute();
                              $results=$query->fetchAll(PDO::FETCH_OBJ);
                              $cnt=1;
                              if($query->rowCount() > 0)
                              {
                              foreach($results as $result)
                              {  ?>
                           <li>
                              <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                              <div class="vehicle_title">
                                 <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                                 <p><b>From Date:</b> <?php echo htmlentities($result->FromDate);?><br/> <b>To Date:</b> <?php echo htmlentities($result->ToDate);?><br/><b>Message:</b> <?php echo htmlentities($result->message);?></p>
                        
                                  
                        
                              </div>
                              <?php if($result->Status==1)
                                 { ?>
                              <div class="vehicle_status">
                                 <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="vehicle_status" style="margin-top: 10px;">
                                 <a href="?cancel=<?php echo htmlentities($result->bkid);?>" class="btn outline btn-xs">Cancel Booking</a>
                                 <div class="clearfix"></div>
                              </div>
                              <?php } else if($result->Status==2) { ?>
                              <div class="vehicle_status">
                                 <a href="#" class="btn outline btn-xs">Cancelled</a>
                                 <div class="clearfix"></div>
                              </div>
                              <?php } else { ?>
                              <div class="vehicle_status">
                                 <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="vehicle_status" style="margin-top: 10px;">
                                 <a href="?cancel=<?php echo htmlentities($result->bkid);?>" class="btn outline btn-xs">Cancel Booking</a>
                                 <div class="clearfix"></div>
                              </div>
                              <?php }}}else{?>
                              <div class="vehical-details">
                                 <h5>No Booking Available</h5>
                              </div>
                              
                
                           </li>
                           <?php } ?>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
     
      <?php include('includes/footer.php');?>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   </body>
</html>
<?php } ?>