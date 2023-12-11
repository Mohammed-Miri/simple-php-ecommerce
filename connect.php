
<!-- connect to the database -->

<?php
$con = mysqli_connect("localhost", "root", "");
  $create = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS crudpro") or die(mysqli_error($con));
	mysqli_select_db($con, "crudpro") or die (mysqli_error($con));
  $data = "CREATE TABLE IF NOT EXISTS cruddata (id int(11) NOT NULL,title varchar(255) NOT NULL,price int(20) NOT NULL,taxes int(20) NOT NULL,ads int(20) NOT NULL,discount int(20) NOT NULL default 0,total int(20),category varchar(255),PRIMARY KEY (id))";
  $results = mysqli_query($con, $data) or die (mysqli_error($con));

  $user = "CREATE TABLE IF NOT EXISTS users (user_name varchar(255) NOT NULL,password varchar(255) NOT NULL)";
  $results = mysqli_query($con, $user) or die (mysqli_error($con));
?>