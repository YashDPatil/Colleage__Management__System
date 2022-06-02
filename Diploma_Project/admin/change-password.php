<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['submit']))
	{
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$username=$_SESSION['alogin'];
$sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update admin set Password=:newpassword where UserName=:username";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is not valid.";	
}
}
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

    <title>Car Rental Portal | Admin Change Password</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/sandstone/bootstrap.min.css" integrity="sha384-zEpdAL7W11eTKeoBJK1g79kgl9qjP7g84KfK3AZsuonx38n8ad+f5ZgXtoSDxPOh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("New Password and Confirm Password Field do not match  !!");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }

    </script>
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

    </style>


</head>

<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Change Password</h2>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">Form fields</div>

                                        <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">


                                            <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Current Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">New Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Confirm Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>



                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">

                                                    <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                                                </div>
                                            </div>

                                        </form>

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
