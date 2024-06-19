<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_SESSION["user"])) {
    header("Location ../home.php");
    exit();
}

require "../db_connect.php";
require "../file_upload.php";

// $sqlSuppliers = "SELECT * FROM suppliers";
// $resultSuppliers = mysqli_query($conn, $sqlSuppliers);
// $rows = mysqli_fetch_all($resultSuppliers, MYSQLI_ASSOC);
// $supplierOptions = "";

// foreach ($rows as $row) {
//     $supplierOptions .= "<option value='{$row["id"]}'>{$row["name"]}</option>";
// }

if (isset($_POST["create"])) {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccine = $_POST["vaccine:"];
    $picture = fileUpload($_FILES["picture"], "product");
    // $supplier = $_POST["supplier"]; 


   $sql = "INSERT INTO `products`(`name`, `gender`, `size`, `age`, `vaccine:`, `picture`) 
   VALUES ('{$name}','{$gender}', '{$size}', '{$age}', '{$vaccine}','{$picture[0]}')";

//    mysqli_query($conn, $sql);

//    header("Location: index,php");

if (mysqli_query($conn, $sql)) {
    echo "<div class = 'alert alert-succes' role='alert'>
    Product has been created, {$picture[1]}
    </div>";

    header("refresh: 3; url= index.php");
}else{
    echo "<div class = 'alart alert-succes' role='alert'>
    something is wrong, please try again later
    </div>";
  }
}


  



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">

    <form method="post" enctype="multipart/form-data"> 
      <div class="mb-3">
        <label for="name" class="form-label">Product name</label>
         <input type="text" class="form-control" id="name" placeholder="product name" name="name">
        </div>
        <div class="mb-3">
        <label for="gender" class="form-label">Product gender</label>
         <input type="text" class="form-control" id="name" placeholder="product gender" name="gender">
        </div>
        <div class="mb-3">
        <label for="size" class="form-label">Product size</label>
         <input type="text" class="form-control" id="name" placeholder="product size" name="size">
        </div>
        <div class="mb-3">
        <label for="age" class="form-label">Product age</label>
         <input type="number" class="form-control" id="name" placeholder="product age" name="age">
        </div>
    <div class="mb-3">
        <label for="vaccine:" class="form-label">Product vaccine:</label>
         <input type="text" class="form-control" id="name" placeholder="product vaccine:" name="vaccine:">
        </div>
        <div class="mb-3">
         <label for="supplier" class="form-label">Supplier</label>
          <select name="supplier" id="supplier" class="form-control">
            <option value="NULL">Select a supplier..</option>
            <?= $supplierOptions ?>
        </select>  
   </div>
     <div class="mb-3">
        <label for="picture" class="form-label">Product picture</label>
         <input type="file" class="form-control" id="name" placeholder="product picture" name="picture">      
   </div> 
   <input name="create" type="submit" class="btn btn-primary" value="Create a product">
  <a class="btn btn-warning" href="index.php">Back to home page</a>
 </form>
 </div>
</body>
</html>
