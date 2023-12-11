
<!-- get the id of deleted row and delete it -->

<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}
include 'connect.php';
if(isset($_REQUEST['deletid'])){
    $id=$_REQUEST['deletid'];
    $sql="delete from `cruddata` where id=$id";
    $result=mysqli_query($con,$sql);
if($result){
    header('location:home.php');
}
else{
    die(mysqli_error($con));
}
}
?>