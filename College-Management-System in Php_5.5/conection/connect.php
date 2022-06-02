<?php
$link=mysqli_connect("localhost","root", "") or die("No Connection");
mysqli_select_db($link,"project") or die("No Database connected!");
?>