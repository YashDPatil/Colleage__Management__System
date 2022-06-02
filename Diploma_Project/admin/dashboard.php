<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>Car Rental Portal | Admin Dashboard</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/sandstone/bootstrap.min.css" integrity="sha384-zEpdAL7W11eTKeoBJK1g79kgl9qjP7g84KfK3AZsuonx38n8ad+f5ZgXtoSDxPOh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Dashboard</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card m-3">
                                            <div class="card-body bk-primary text-light">
                                                <div class="stat-panel text-center">
                                                    <?php 
$sql ="SELECT id from tblusers ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$regusers=$query->rowCount();
?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($regusers);?></div>
                                                    <div class="stat-panel-title text-uppercase">Reg Users</div>
                                                </div>
                                            </div>
                                            <a href="reg-users.php" class="block-anchor card-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card m-3">
                                            <div class="card-body bk-success text-light">
                                                <div class="stat-panel text-center">
                                                    <?php 
$sql1 ="SELECT id from tblvehicles ";
$query1 = $dbh -> prepare($sql1);;
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totalvehicle=$query1->rowCount();
?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($totalvehicle);?></div>
                                                    <div class="stat-panel-title text-uppercase">Listed Vehicles</div>
                                                </div>
                                            </div>
                                            <a href="manage-vehicles.php" class="block-anchor card-footer">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card m-3">
                                            <div class="card-body bk-info text-light">
                                                <div class="stat-panel text-center">
                                                    <?php 
$sql2 ="SELECT id from tblbooking ";
$query2= $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$bookings=$query2->rowCount();
?>

                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($bookings);?></div>
                                                    <div class="stat-panel-title text-uppercase">Total Bookings</div>
                                                </div>
                                            </div>
                                            <a href="manage-bookings.php" class="block-anchor card-footer">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card m-3">
                                            <div class="card-body bk-warning text-light">
                                                <div class="stat-panel text-center">
                                                    <?php 
$sql3 ="SELECT id from tblbrands ";
$query3= $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$brands=$query3->rowCount();
?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($brands);?></div>
                                                    <div class="stat-panel-title text-uppercase">Listed Brands</div>
                                                </div>
                                            </div>
                                            <a href="manage-brands.php" class="block-anchor card-footer">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="card m-3">
                                            <div class="card-body bk-success text-light">
                                                <div class="stat-panel text-center">
                                                    <?php 
$sql6 ="SELECT id from tblcontactusquery ";
$query6 = $dbh -> prepare($sql6);;
$query6->execute();
$results6=$query6->fetchAll(PDO::FETCH_OBJ);
$query=$query6->rowCount();
?>
                                                    <div class="stat-panel-number h1 "><?php echo htmlentities($query);?></div>
                                                    <div class="stat-panel-title text-uppercase">Queries</div>
                                                </div>
                                            </div>
                                            <a href="manage-conactusquery.php" class="block-anchor card-footer">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>









            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
<?php } ?>
