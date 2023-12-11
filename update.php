<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}
//connect to the database
include 'connect.php';

//get the id of the updated raw and update

$id=$_REQUEST['updateid'];
$sql="select * from `cruddata` where id=$id";
$result=mysqli_query($con,$sql);

//get the values from the database
$row=mysqli_fetch_assoc($result);
$title=$row['title'];
$price=$row['price'];
$taxes=$row['taxes'];
$ads=$row['ads'];
$discount=$row['discount'];
$category=$row['category'];


//get the new valus from inputs and set them in database

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $price=$_POST['price'];
    $taxes=$_POST['taxes'];
    $ads=$_POST['ads'];
    $discount=$_POST['discount'];
    $category=$_POST['category'];
    $total=$price;
    $total +=$taxes;
    $total +=$ads;
    $total -=$discount;

    $sql="update `cruddata` set id=$id,title='$title',price='$price',taxes='$taxes',ads='$ads',discount='$discount',category='$category',total='$total'
    where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        header('location:home.php');
          }
    else{
          die(mysqli_error($con));
        }}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Operation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="crud">

  <div class="head">
        <h2 class="tit">CRUD</h2>
        <P>PRODUCTS MANAGEMENT SYSTEM</P>
  </div>

        <form class="inputs"  method="POST">
            <input type="text" placeholder="title" id="title" name='title' value=<?php echo $title ?>>
            <div class="price">
                <input   type="number" placeholder="price" id="price" name='price'  value=<?php echo $price ?>>
                <input   type="number" placeholder="taxes" id="taxes"  name='taxes'  value=<?php echo $taxes ?>>
                <input  type="number" placeholder="ads" id="ads"  name='ads'  value=<?php echo $ads ?>>
                <input  type="number" placeholder="discount" id="discount"  name='discount'  value=<?php echo $discount ?>>
            </div>
            <input  name='category' type="text" placeholder="category" id="category"  value=<?php echo $category ?>>
            <button  name='submit'  id="submit" >Update</button>
        </form>


<div class="outputs">



    <table>
      <tr>
        <th>id</th>
        <th>title</th>
        <th>price</th>
        <th>taxes</th>
        <th>ads</th>
        <th>discount</th>
        <th>total</th>
        <th>category</th>
        <th>update</th>
        <th>delete</th>
      </tr>
    <tbody id="tbody">
<!-- php code for display all data after update -->
        <?php
                $sql="Select * from `cruddata`";
                $result=mysqli_query($con,$sql);
                if($result){
                  while( $row=mysqli_fetch_assoc($result)) {
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $taxes=$row['taxes'];
                    $ads=$row['ads'];
                    $discount=$row['discount'];
                    $total=$row['total'];
                    $category=$row['category'];

                    echo '<tr>
                    <th scope="row">'.$id.'</th>
                    <td >'.$title.'</td>
                    <td >'.$price.'</td>
                    <td >'.$taxes.'</td>
                    <td >'.$ads.'</td>
                    <td >'.$discount.'</td>
                    <td >'.$total.'</td>
                    <td >'.$category.'</td>
                    <td><button class="btn-upd"><a href="update.php?updateid='.$id.'" >Update</a></button></td>
                    <td><button class="btn-del"><a href="delete.php?deletid='.$id.'" >Delete</a></button></td>
                    </tr>';
                  }
                }
            ?>
  </tbody>
    </table>
    </div>

  </div>
</body>
</html>