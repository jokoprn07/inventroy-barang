<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include '../fungsi.php';

$id = $_GET["id"];

if( hapusPenjualan($id) > 0 ){
    echo "<script>alert('Data Berhasil Dihapus');
    window.location.href = 'datapenjualan.php';
    </script>";
}else{
    echo "<script>alert('Data Gagal Dihapus');</script>";
}

?>