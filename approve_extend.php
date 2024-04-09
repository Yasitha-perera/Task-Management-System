<?php
include('./database.php');
$query="update extends set status='Approved' where lid=$_GET[id] ";
$query_run=mysqli_query( $conn, $query );
if ($query_run) {
    echo "<script type='text/javascript'>
        alert('Project Extend Approved...');
        window.location.href ='admin.php';
        </script>";
} else {
    echo "<script type='text/javascript'>
        alert('Error... Please try again');
        window.location.href ='admin.php';
        </script>";
}
?>