<?php

$servername ="localhost";
$dbusername="root";
$dbpassword="";
$dbname="empower_minds";

$conn = mysqli_connect($servername, $dbusername, $dbpassword,$dbname);

if (!$conn) {
    die("Sorry we failed to connect". mysqli_connect_error());
}




?>

