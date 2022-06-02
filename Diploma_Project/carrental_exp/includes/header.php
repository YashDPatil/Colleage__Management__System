<header>

    <link rel="stylesheet" type="text/css" href="../../carrental_exp/assets/css/style.css">
    <div class="default-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-2">
                    <div class="logo"> <a href="index.php"><img src="assets/images/logo.png" alt="image" /></a> </div>
                </div>
                <div class="col-sm-9 col-md-10">
                    <div class="header_info">

                        <?php   if(strlen($_SESSION['login'])==0)
	{	
?>
                        <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
                        <?php }
else{ 

echo "Welcome To Car rental portal";
 } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a> </li>

                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="car-listing.php">Car Listing</a>
                <li class="nav-item"><a class="nav-link" href="contact-us.php">Contact Us</a></li>

            </ul>

        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="header_wrap">
            <div class="user_login">
                <ul>
                    <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>
                            <?php 
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <?php if($_SESSION['login']){?>
                            <li><a href="profile.php">Profile Settings</a></li>
                            <li><a href="update-password.php">Update Password</a></li>
                            <li><a href="my-booking.php">My Booking</a></li>
                            <li><a href="logout.php">Sign Out</a></li>
                            <?php } else { ?>
                            <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
                            <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Update Password</a></li>
                            <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">My Booking</a></li>
                            <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Sign Out</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>


    </nav>
</header>
