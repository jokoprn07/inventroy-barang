<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include '../fungsi.php';

$id = $_GET["id"];

if( hapuscst($id) > 0 ){
    echo "<script>alert('Data Customer Berhasil Dihapus');
    window.location.href = 'customer.php';
    </script>";
}else{
    echo "<script>alert('Data Customer Gagal Dihapus');</script>";
}

?>