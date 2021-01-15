<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include '../fungsi.php';

$id = $_GET["id"];

if( hapussupp($id) > 0 ){
    echo "<script>alert('Data Suplier Berhasil Dihapus');
    window.location.href = 'suplier.php';
    </script>";
}else{
    echo "<script>alert('Data Suplier Gagal Dihapus');</script>";
}

?>