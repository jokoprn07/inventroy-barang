<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";

$suplier = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM suplier WHERE nama_suplier ='$_GET[nama_suplier]' "));
$data = array(
              	'kode_suplier'  	=>  $suplier['kode_suplier'],
            );
 echo json_encode($data);