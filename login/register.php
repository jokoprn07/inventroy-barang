<?php

include "../fungsi.php";

if( isset($_POST["submit"]) ){
  if( register($_POST) > 0 ){
    echo "<script>alert('Berhasil Mendaftar');
    window.location.href = 'index.php';
    </script>";
  }else{
    $error = true;
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Inventory Barang | Register Administrator</title>
  </head>
  <body>
  <div class="container">
  <div class="card mt-3">
    <div class="card-header text-center">
      Inventory Barang | Register Administrator
    </div>
    
    <div class="card-body">
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username :</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username Anda" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" id="email"  name="email" class="form-control" placeholder="Masukkan Email Anda" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="password">Password :</label>
        <input type="password" id="password"  name="password" class="form-control" placeholder="Masukkan Password Anda" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="konfirmasi">Konfirmasi Password :</label>
        <input type="password" id="konfirmasi"  name="konfirmasi" class="form-control" placeholder="Masukkan Konfirmasi Password Anda" autocomplete="off">
      </div>
      <button type="submit" name="submit" class="form-control btn btn-primary">Register</button>
      <br><br>
      </form>

      <div class="row">
      </div>
      <hr>
      <a href="index.php"><button class="btn btn-primary form-control">Login</button></a>

    </div>
  </div>
  </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
  </body>
</html>