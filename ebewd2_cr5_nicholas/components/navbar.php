<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home.php">Home</a>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/register.php">Register</a>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/senior.php">Senior</a>      
        </li>
        <?php
          if(isset($_POST["user"]) || isset($_SESSION["adm"])){
        ?>
        <li class="nav-item">
        <a class="nav-link" href="/edit_profile.php">Edit profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/reset_password.php">Reset password</a>
        </li>

         <?php } ?>
         </ul> 
         <?php
          if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
            ?>    
        <div class="d-flex">
            <a class="btn btn-danger" href="/logout.php?logout">Logout</a>
        </div> 
        <?php } ?>
    </div>
  </div>
</nav> 