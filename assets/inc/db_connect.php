<?php
include_once 'psl-config.php';   // As functions.php is not included
//$con = new mysqli(HOST, USER, PASSWORD, DATABASE) or die("Connection failed: " . $con->connect_error);
$con=NULL;
if ($con===NULL) {
    $con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
}
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
//else
//{
//    echo("Connected...");
//}
?>