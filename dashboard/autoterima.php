<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";

$barang = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM dp_barang WHERE kode_pembelian ='$_GET[kode_pembelian]' "));

// var_dump($barang);die();
$data = array(
                'nama_barang'  	=>  $barang['nama_barang'],
                'satuan'  	=>  $barang['satuan'],
                'nama_suplier'  	=>  $barang['nama_suplier'],
                'tanggal_terima'  	=>  $barang['tanggal_pembelian'],
                'jangka_waktu' => $barang['jangka_waktu'],
                'qty'  	=>  $barang['jumlah_pembelian'],
                'keterangan'  	=>  $barang['keterangan'],
                'harga_beli' => $barang['harga_beli'],
                'kode_suplier' => $barang['kode_suplier'],
            );
echo json_encode($data); 
