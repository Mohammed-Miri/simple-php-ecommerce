
<?php

session_start();
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}


//connect to the data base
include 'connect.php';

//take the value from the inputs

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $price=$_POST['price'];
    $taxes=$_POST['taxes'];
    $ads=$_POST['ads'];
    $discount=$_POST['discount'];
    $category=$_POST['category'];

//set query and send it to the database to add
    $total= $price + $taxes + $ads - $discount;
    $sql="insert into `cruddata` (title,price,taxes,ads,discount,total,category)
    values('$title','$price','$taxes','$ads','$discount','$total','$category')";
    $result=mysqli_query($con,$sql);
    //for fix duplicate entry after refresh 
    header('location:home.php');
    exit;
    if(!$result){
      die(mysqli_error($con));
          }
        }
?>

<!-- html part -->
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

<!-- the main div -->

<div class="crud">

  <!-- up button -->
  <span class="up">UP</span>
<script >
  let span=document.querySelector('.up');
window.onscroll=function(){
    if(window.scrollY>=500){
        span.classList.add('show');
    }
    else{
        span.classList.remove('show');
;    }
};
span.onclick=function(){
    window.scrollTo({
        top:0,
        behavior:"smooth"
    })
}
</script>
<!-- header section -->
  <div class="head">
    <h2 class="tit">CRUD</h2>
    <P>PRODUCTS MANAGEMENT SYSTEM</P>
  </div>

<!-- inputs section -->
<h2 class="desc">Create</h2>
<form class="inputs"  method="POST">
      <input type="text" placeholder="title" id="title" name='title' required>
      <div class="price">
          <input   type="number" placeholder="price" id="price" name='price' required>
          <input   type="number" placeholder="taxes" id="taxes"  name='taxes' required>
          <input  type="number" placeholder="ads" id="ads"  name='ads' required>
          <input  type="number" placeholder="discount" id="discount"  name='discount' required>
      </div>
      <input  name='category' type="text" placeholder="category" id="category" required>
      <button  name='submit'  id="submit" >Create</button>
</form>

<div class="outputs">
<!-- search section -->
  <h2 class="desc">Search</h2>
  <form method='POST' class="search">
      <div class="searchBlock">
        <input type="text"  name="searchInput" placeholder="Search" id="search">
            <div class="btnSearch">
              <button id="searchTitle" name='btnsearch'>Search By Title</button>
              <button id="searchcategory" name="btnsearch2">Search By Category</button>
            </div>
      </div>

  </form> 
<!-- Sort section -->
<form method='POST' class="sort">
  <h2 class="desc">Sort</h2>
    <div class="options">
      
      <div class="field">
        <label for="field">Choose Sorting Field</label>
        <select name="field" id="field">
            <option value = "title">Title</option>
            <option value = "price">Price</option>
            <option value = "total">Total</option>
            <option value = "category">Category</option>
        </select>
      </div>

      <div class="type">
        <label for="sorting">Choose Sorting Type</label>
        <select name="sorting" id="sorting">
          <option value="ASC">ASC</option>
          <option value="DESC">DESC</option>
        </select>
      </div>
    </div>
    <button  name='sort'  id="sort" >Sort</button>
  <!-- delete all button -->
    <h2 class="desc">Delete All</h2>
    <button name="deleteAll" class="deleteAll">Delete All</button> 
</form>
<!-- delete all php code -->
<?php
if(isset($_POST['deleteAll'])){
  $sql="TRUNCATE TABLE cruddata";
  $result=mysqli_query($con,$sql);
  if(!$result){
  die(mysqli_error($con));
    }
}
?>
<!-- display section -->

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

<!-- search and display php code -->

<?php

//display data if search by title
  if(isset($_POST['btnsearch'])){
    $title=$_POST['searchInput'];
    $sql="Select * from `cruddata` where title like '%".$title."%'";
    $result=mysqli_query($con,$sql);
    if(!$result){
        die(mysqli_error($con));
      }

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
      <td><button class="btn-upd" ><a href="update.php?updateid='.$id.'">Update</a></button></td>
      <td><button class="btn-del"><a href="delete.php?deletid='.$id.'">Delete</a></button></td>
      </tr>';
    }
  }

//display data if search by category

elseif(isset($_POST['btnsearch2'])){
            $category=$_POST['searchInput'];
            $sql="Select * from `cruddata` where category like '%".$category."%'";
            $result=mysqli_query($con,$sql);
            if(!$result){
                die(mysqli_error($con));
              }

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
              <td><button class= "btn-del"><a href="delete.php?deletid='.$id.'" >Delete</a></button></td>
              </tr>';
            }
          }
elseif(isset($_POST['sort'])){
  $val = $_POST['field'];
  $type =  $_POST['sorting'];
  $sql="select * from  cruddata order by ". $val.' '. $type ;
  $result=mysqli_query($con,$sql);
  if(!$result){
  die(mysqli_error($con));
    }

    
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
      <td><button class="btn-upd"><a href="update.php?updateid='.$id.'">Update</a></button></td>
      <td><button class="btn-del"><a href="delete.php?deletid='.$id.'">Delete</a></button></td>
      </tr>';
    }
}
//display data without search
else{
              
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
                    <td><button class="btn-del"><a href="delete.php?deletid='.$id.'">Delete</a></button></td>
                        </tr>';
                  }
                }
              }
            ?>
</tbody>
</table>
</div>

</div>
</body>
</html>