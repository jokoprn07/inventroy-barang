<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";

$customer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM customer WHERE nama_customer ='$_GET[nama_customer]' "));
$data = array(
              	'kode_customer'  	=>  $customer['kode_customer'],
            );
 echo json_encode($data);