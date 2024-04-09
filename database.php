<?php
$hostName="localhost";
$dbUser="root";
$dbPassword= "";
$dbName= "tasdb";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword,$dbName);
if (!$conn) {
    die("somthing went wrong;");
}

?>  