<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";

$barang = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM barang WHERE nama_item ='$_GET[nama_item]' "));
$karton = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karton WHERE nama_item ='$_GET[nama_item]' "));
$data = array(
                'kode_barang'  	=>  $barang['kode_barang'] ?? "",
                'satuan'  	=>  $barang['satuan'] ?? "",
                'harga_beli'  	=>  $barang['harga_beli'] ?? "",
                'code_barang'  	=>  $karton['code_barang'] ?? "",
            );
            // var_dump($data); die();
echo json_encode($data); 
