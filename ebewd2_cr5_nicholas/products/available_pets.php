<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
    exit();
}



require "./db_connect.php";


$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn, $sql);

$layout = "";

if(mysqli_num_rows($result) == 0) {
    $layout .= "No results found";
} else {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    foreach ( $rows as $row) {
        
        $layout .= "
        <div>
        <div class='card' style='width: 18rem;'>
        <img src='../images/{$row["picture"]}' class='card-img-top' alt='...'>
        <div class='card-body'>
              <h5 class='card-title'>{$row["name"]}</h5>
          <p class='card-text'>{$row["gender"]}</p>
          <p class='card-text'>{$row["size"]}</p>
          <p class='card-text'>{$row["age"]}</p>
          <p class='card-text'>{$row["vaccine:"]}</p>
          <a href='details.php?id={$row["id"]}' class='btn btn-success'>Details</a>
          <a href='update.php?id={$row["id"]}' class='btn btn-warning'>Update</a>
          <a href='delete.php?id={$row["id"]}' class='btn btn-danger'>Delete</a>
        </div>
      </div>
      </div>";
    }
} 

$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<?php require_once "components/navbar.php"; ?>

<div class="container">
        <div class="row row-cols-lg-3 row-col-md-2 row-cols-sm-1 row-cols-xs-1">
            <?= $layout?>

        </div>
    </div>
</body>
</html>
 