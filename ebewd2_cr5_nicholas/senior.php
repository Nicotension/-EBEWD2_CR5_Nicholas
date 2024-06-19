<?php
session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: login.php");
    exit();
}

require_once "db_connect.php";



$id = $_SESSION["user"];
$sql = "SELECT * FROM `users` WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sqlProducts = "SELECT * FROM `products`";
$pResult = mysqli_query($conn, $sqlProducts);

$layout = "";

if(mysqli_num_rows($pResult) == 0) {
  $layout .= "No results found";
      
      $layout .= "
      <div>
      <div class='card' style='width: 18rem;'>
      <img src='images/{$prow["picture"]}' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'>{$prow["name"]}</h5>
      </div>
    </div>
    </div>";
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




<div class="container">
        <div class="row row-cols-3">
           
  
  <div class="card" style="width: 18rem;">
  <img src="https://cdn.pixabay.com/photo/2019/05/29/18/19/dog-4238163_1280.jpg" class="card-img-top" alt="Male dog">
  <div class="card-body">
    <h5 class="card-title">Jack</h5>
    <p class="card-text">Gender: Male <br>Breed: Dog <br>Size: big <br> Age: 11 years old<br>Vaccinated: yes <br>41, Praterstrasse!</p>
    <button type="button" class="btn btn-outline-primary">Available</button>
  </div>
</div>  
<div class="card" style="width: 18rem;">
  <img src="https://www.akc.org/wp-content/uploads/2017/11/German-Shepherd-on-White-00.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Shilla</h5>
    <p class="card-text">Gender: Female <br>Breed: Dog <br>Size: big <br> Age: 10 years old<br>Vaccinated: yes <br></p>
    <button type="button" class="btn btn-outline-success">Reserved</button>
  </div>
</div>
<div class="card" style="width: 18rem;">
  <img src="https://www.akc.org/wp-content/uploads/2017/11/Rottweiler-On-White-10.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Daniel</h5>
    <p class="card-text">Gender: Male <br>Breed: Dog <br>Size: big <br> Age: 9 years old<br>Vaccinated: yes <br></p>
    <button type="button" class="btn btn-outline-success">Reserved</button>
  </div>
</div>  
<div class="card" style="width: 18rem;">
  <img src="https://cdn.pixabay.com/photo/2017/06/30/00/04/pony-2456757_1280.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Hally</h5>
    <p class="card-text">Gender: Female <br>Breed: Pony <br>Size: big <br> Age: 12 years old<br>Vaccinated: yes <br></p>
    <button type="button" class="btn btn-outline-success">Reserved</button>
  </div>
</div>
<div class="card" style="width: 18rem;">
  <img src="https://cdn.pixabay.com/photo/2019/12/19/13/02/sheep-4706155_1280.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Billy</h5>
    <p class="card-text">Gender: Male <br>Breed: Goat <br>Size: big <br> Age: 9 years old<br>Vaccinated: yes <br>Kenttenbrückengasse, 2!</p>
    <button type="button" class="btn btn-outline-primary">Available</button>
  </div>
</div> 
<div class="card" style="width: 18rem;">
  <img src="https://www.akc.org/wp-content/uploads/2017/11/Cesky-Terrier-on-White-011.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Tommy</h5>
    <p class="card-text">Gender: Male <br>Breed: Dog <br>Size: small in nature <br> Age: 9 years old<br>Vaccinated: yes <br>No longer available!</p>
    <button type="button" class="btn btn-outline-secondary">Adopted!</button>
  </div>
</div>
<div class="card" style="width: 18rem;">
  <img src="https://cdn.pixabay.com/photo/2014/03/10/18/44/boar-284685_1280.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Max</h5>
    <p class="card-text">Gender: Male <br>Breed: Pig <br>Size: big <br> Age: 13 years old<br>Vaccinated: yes <br>Johnson street, 15!</p>
    <button type="button" class="btn btn-outline-primary">Available</button>
  </div>
</div>  
<div class="card" style="width: 18rem;">
  <img src="https://cdn.pixabay.com/photo/2019/08/21/18/40/english-bull-doge-4421768_1280.jpg" class="card-img-top" alt="Female Dog">
  <div class="card-body">
    <h5 class="card-title">Daz</h5>
    <p class="card-text">Gender: Male <br>Breed: Dog <br>Size: big <br> Age: 12 years old<br>Vaccinated: yes <br>No longer available!</p>
    <button type="button" class="btn btn-outline-secondary">Adopted!</button>
  </div>
</div>
        </div>
    </div>

    <script scr="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity=
"sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>