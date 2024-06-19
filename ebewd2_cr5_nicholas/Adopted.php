<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
    exit();
}



require "./db_connect.php";


if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "SELECT products.*, suppliers.name as supName FROM products JOIN suppliers ON suppliers.id =
     products.fk_supplier WHERE products.id = {$id}";
    $result = mysqli_query($conn, $sql);
   
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
    "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class='card' style='width: 25rem; margin: 0 auto'>
        <img src='../images/<?= $row["picture"] ?>' class='card-img-top' alt='...'>
        <div class='card-body'>
          
       
        <p class="card-text">Congratulations!, you are now a new pet owner.</p>
    
  </div>   

          <a href="home.php" class="btn btn-warning">Back</a>
        </div>
      </div>
</body>
</html>


