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


$sqlSuppliers = "SELECT * FROM suppliers";
$resultSuppliers = mysqli_query($conn, $sqlSuppliers);
$rows = mysqli_fetch_all($resultSuppliers, MYSQLI_ASSOC);
$supplierOptions = "";


    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql = "SELECT * FROM `products` WHERE id = {$id}";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    } 
    
foreach ($rows as $val) {
    if($row["fk_supplier"] == $val["id"]){
        $supplierOptions .= "<option value='{$val["id"]}' selected>{$val["name"]}</option>";
    }else{
        $supplierOptions .= "<option value='{$val["id"]}'>{$val["name"]}</option>";
    }
    
}

    if(isset($_POST["update"])) {
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $size = $_POST["size"];
        $age = $_POST["age"];
        $vaccine = $_POST["vaccine:"];
        $picture = fileUpload($_FILES["picture"], "product");
        $supplier = $_POST["supplier"];

        if($_FILES["picture"]["error"] == 0) {
            if($row["picture"] != "product.jpg"){
                unlink("../images/{$row["picture"]}");
            }
            $sql = "UPDATE `products` SET `name`='{$name}',`gender`='{$gender}',`size`='{$size}',`age`='{$age}',`vaccine:`='{$vaccine}',`picture`='{$picture[0]}', 
            fk_supplier = {$supplier} WHERE id = {$id}";
    }else {
        $sql = "UPDATE `products` SET `name`='{$name}',`gender`='{$gender}',`size`='{$size}',`age`='{$age}', fk_supplier = {$supplier} WHERE id = {$id}";

    }
    
    if(mysqli_query($conn, $sql)){
        echo "<div class = 'alert alert-succes' role='alert'>
        Product has been updated
            </div>";
        header("refresh: 3; url=index.php");
    }else {
        echo "<div class = 'alert alert-danger' role='alert'>
        Something went wrong, please try again later!
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
         <input type="text" class="form-control" id="name" placeholder="product name" name="name" value="<?= $row["name"] ?>">
        </div>
    <!-- <div class="mb-3">
         <label for="price" class="form-label">Product price</label>
         <input type="number" class="form-control" id="name" placeholder="product price" name="price" value="<?= $row["price"] ?>"> -->
        <!-- </div> --> 
        <div class="mb-3">
        <label for="name" class="form-label">Product gender</label>
         <input type="text" class="form-control" id="name" placeholder="product gender" name="gender" value="<?= $row["gender"] ?>">
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Product size</label>
         <input type="text" class="form-control" id="name" placeholder="product size" name="size" value="<?= $row["size"] ?>">
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Product age</label>
         <input type="text" class="form-control" id="name" placeholder="product age" name="age" value="<?= $row["age"] ?>">
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Product vaccine:</label>
         <input type="text" class="form-control" id="name" placeholder="product vaccine:" name="vaccine:" value="<?= $row["vaccine:"] ?>">
        </div>
        <div class="mb-3">
        <label for="supplier" class="form-label">Supplier</label>
        <select name="supplier" id="supplier" class="form-control">
            <?= $supplierOptions ?>
        </select>
        </div>      
     <div class="mb-3">
        <label for="picture" class="form-label">Product picture</label>
         <input type="file" class="form-control" id="name" placeholder="product picture" name="picture">      
   </div> 
   <input name="update" type="submit" class="btn btn-primary" value="Update a product">
  <a class="btn btn-warning" href="index.php">Back to home page</a>
 </form>
 </div>

</body>
</html>
