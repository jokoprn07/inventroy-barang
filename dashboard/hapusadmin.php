<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include '../fungsi.php';

$id = $_GET["id"];

if( hapusAdmin($id) > 0 ){
    echo "<script>alert('Data Admin Berhasil Dihapus');
    window.location.href = 'admin.php';
    </script>";
}else{
    echo "<script>alert('Data Admin Gagal Dihapus');</script>";
}

?>