<?php
   session_start();

   if (isset($_SESSION["user"])) {
    header("Location: home.php");
    exit();
   }

   if (isset($_SESSION["adm"])) {
    header("Location: dashboard.php");
    exit();
   }
   require_once "db_connect.php";

   $error = false;
   $passwordError = $email = $emailError = "";

   if(isset($_POST["login"])) {
    $email = cleanInputs($_POST["email"]);
    $password = cleanInputs($_POST["password"]);
  
    if(empty($email)){
        $error = true;
        $emailError = "this input can't be empty";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "Please enter a valid email";
    }    

        if(empty($password)){
            $error = true;
            $passwordError = "Password can't be empty";
     
   }

   if(!$error){
    $password = hash("sha256", $password);
    $sql = "SELECT * FROM `users` WHERE email = '{$email}' AND password = '{$password}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if($count == 1){
        if($row["status"] == "adm"){
            $_SESSION["adm"] = $row["id"];
            header("Location: dashboard.php");
            exit();

        }else{
            $_SESSION["user"] = $row["id"];
            header("Location: home.php"); 
            exit();
        }
    }
  }
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
<?php require_once "components/navbar.php"; ?>

    <div class="container">
        <h1 class="text-center">Login Form</h1>
        <form method="post">
            <input type="email" class="form-control mt-2" placeholder="Email" name="email" value="<?= $email?>">
            <p class="text-danger"><?= $emailError ?></p>
            <input type="password" class="form-control mt-2" placeholder="Password" name="password">
            <p class="text-danger"><?=$passwordError ?></p>
            <input type="submit" class="btn btn-primary mt-2" name="login">
        </form>
    </div>
</body>
</html>