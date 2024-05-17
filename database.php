<?php
$hostname="localhost";
$dbuser= "sarra";
$dbPassword= "sarramed";
$dbName= "login_register";
$conn = mysqli_connect("$hostname","$dbuser","$dbPassword","$dbName");
if (!$conn) {
    die("something went wrong");
}
