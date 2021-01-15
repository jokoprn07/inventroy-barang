<?php

session_start();
include "../fungsi.php";

if( isset($_COOKIE['id']) && isset($_COOKIE['guaheker']) ){
  $ide = $_COOKIE['id'];
  $username = $_COOKIE['guaheker'];

  $result = mysqli_query($conn, "SELECT username FROM admin WHERE id = '$ide'");
  $cek = mysqli_fetch_assoc($result);

  if( $username === hash('sha256', $cek['username']) ){
    $_SESSION['login'] = true;
  }

}

if ( isset($_SESSION['login'] )){
  Header("Location: ../dashboard/index.php");
  exit();
}


if ( isset($_POST["submit"]) )  {
	
	$username = mysqli_real_escape_string($conn, $_POST["username"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
	
	$hasil = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");
	
	//cek username ada di db gak
	
	if ( mysqli_num_rows($hasil) == 1 ) {
		$key = mysqli_fetch_assoc($hasil);
		
		if ( password_verify($password, $key["password"]) ) {
      $_SESSION['login'] = true;

      if( isset($_POST['remember']) ){
        setcookie('id', $key['id'], time() + 60, '/');
        setcookie('guaheker', hash('sha256', $key['username']), time() + 60, '/');
      }

			header("Location: ../dashboard/index.php");
			exit;
		}
	}
	$error = true;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Inventory Barang | Login Administrator</title>
  </head>
  <body>
  <div class="container">
  <div class="card mt-3">
    <div class="card-header text-center">
      Inventory Barang | Login Administrator
    </div>
    <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username :</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username Anda" autocomplete="off" autofocus="on">
      </div>
      <div class="form-group">
        <label for="password">Password :</label>
        <input type="password" id="password"  name="password" class="form-control" placeholder="Masukkan Password Anda" autocomplete="off">
      </div>
      <input type="checkbox" name="remember" id="remember">
      <label for="remember">Remember Me</label>
      <button type="submit" name="submit" class="form-control btn btn-primary">Login</button><br><br>
      </form>

      <!-- <div class="row">
        <div class="col-md-12">
          <a href="lupapassword.php">Lupa Password?</a>
        </div>
      </div> -->
      <hr>
      <a href="register.php"><button class="btn btn-primary form-control">Register New Account</button></a>
      <br><br> 
      <?php
      if( isset($error) ){
        echo "<div class='alert alert-danger' role='alert'>
                Username Atau Password Salah!!
              </div>";
      }
      ?>
    </div>
  </div>
  </div>

    <script src="../js/jquery-3.2.1.slim.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
  </body>
</html>