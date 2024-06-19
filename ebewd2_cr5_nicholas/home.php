<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION["adm"])){
  header("Location: dashboard.php");
  exit();
}

require_once "db_connect.php";

$email = "andy@yahoo.com";

$id = $_SESSION["user"];
$sql = "SELECT * FROM `users` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sqlProducts = "SELECT * FROM `products`";
$pResult = mysqli_query($conn, $sqlProducts);

$layout = "";

if(mysqli_num_rows($pResult) == 0) {
  $layout .= "No results found";
} else {
  $prows = mysqli_fetch_all($pResult, MYSQLI_ASSOC);
  
  foreach ( $prows as $prow) {
      
      $layout .= "
      <div>
      <div class='card' style='width: 18rem;'>
      <img src='images/{$prow["picture"]}' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'>{$prow["name"]}</h5>
        <p class='card-text'>{$prow["gender"]}</p>
          <p class='card-text'>{$prow["size"]}</p>
          <p class='card-text'>{$prow["age"]}</p>
          <p class='card-text'>{$prow["vaccine:"]}</p>
          <div class='buttons' style='space between;'>
        <a href='details.php?id={$prow["id"]}' class='btn btn-info'>Pet details</a>
         <a href='Adopted.php?id={$prow["id"]}' class='btn btn-success'>Take me home</a>
        </div>
        
      </div>
    </div>
    </div>";
  }
} 

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity=
    "sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php require_once "components/navbar.php"; ?>


<h3 class="text-center">Hello <?= $row["first_name"] . " " . $row["last_name"] ?></h3>

<div class='card' style='width: 9rem;'>
        <img src='../images/<?= $row["picture"] ?>' class='card-img-top' alt='...'>
        <p class='text-center'><?= $row["email"] ?></>
</div>

<div id='content' style="text-align: center;">
  <a class='pets' href='available_pets.php'>Pets Available</a>
</div>


<div class='container'>
        <div class='row row-cols-xm-2, row-cols-md-3, row-cols-xl-4'>
            <?= $layout ?>

            
            <style>
     
        .buttons {
            display: flex;
            justify-content: space-between;
            width: 250px; 
        }
        .buttons {
            flex: 5; 
            margin: 5px; 
        }

        #content a{
          color: black;
          background-color: blue;
          text-decoration: none;
          padding: 0.1rem;
          
        }
    </style>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity=
"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>