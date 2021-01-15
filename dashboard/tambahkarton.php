<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

if ( isset($_POST["submit"]) ) {

	if ( tambahKarton($_POST) > 0 ) {
    echo "<script>alert('Data Berhasil Ditambahkan');
    window.location.href = 'datakarton.php';
    </script>";
	} else {
		echo "<script>alert('Data Gagal Ditambahkan')</script>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="1"> 
    <title>Dashboard | Inventory Barang</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/fontawesome/css/all.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
</head>
<body>
<!-- Start Nav Atas -->

<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>    
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Welcome Admin</a> 
      </div>
      <div style="color: white;padding: 15px 20px 15px 20px;float: right;font-size: 16px;"> 
        <span style="margin-right:20px"><?php echo date('l, d F, Y'); ?></span>
        <a href="../login/logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
      </div>
    </nav>   

<!-- End Nav Atas  -->
<!-- Start Side Nav -->

<nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li>
            <a  class="active-menu" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
          </li> 
          <li>
            <a  href="#"><i class="fas fa-shopping-cart"></i> Pembelian<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="datapembelian.php"><i class="fa fa-database"></i> Data Pembelian Non Karton</a>
              </li>
              <li>
                <a href="datapembeliankarton.php"><i class="fa fa-database"></i> Data Pembelian Karton</a>
              </li>
              <li>
                <a  href="formpembelian.php"><i class="fa fa-plus-square"></i> Tambah Pembelian Non Karton</a>
              </li>
              <li>
                <a  href="formpembeliannonkarton.php"><i class="fa fa-plus-square"></i> Tambah Pembelian Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="far fa-money-bill-alt"></i> Penjualan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="datapenjualan.php"><i class="fa fa-database"></i> Data Penjualan Non Karton</a>
              </li>
              <li>
                <a  href="datapenjualankarton.php"><i class="fa fa-database"></i> Data Penjualan Karton</a>
              </li>
              <li>
                <a  href="formpenjualan.php"><i class="fa fa-plus-square"></i> Tambah Data Non Karton</a>
              </li>
              <li>
                <a  href="formpenjualankarton.php"><i class="fa fa-plus-square"></i> Tambah Data Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Stock Gudang<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="databarang.php"><i class="fas fa-cube"></i> Data Non Karton</a>
              </li>
              <li>
                <a  href="datakarton.php"><i class="fas fa-box-open"></i> Data Karton</a>
              </li>
              <li>
                <a  href="tambah.php"><i class="fa fa-plus-square"></i> Tambah Data Barang</a>
              </li>
              <li>
                <a  href="tambahkarton.php"><i class="fa fa-plus-square"></i> Tambah Data Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-shopping-cart"></i> Akuntasi<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="akuntasi.php"><i class="fa fa-database"></i> Data Akuntasi Non Karton</a>
              </li>
              <li>
                <a href="akuntasikarton.php"><i class="fa fa-database"></i> Data Akuntasi Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Penerimaan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="penerimaan.php"><i class="fas fa-cube"></i> Penerimaan Barang Non Karton</a>
              </li>
              <li>
                <a  href="penerimaanbarangkarton.php"><i class="fa fa-cube"></i> Penerimaan Barang Karton</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="customer.php"><i class="fas fa-users"></i> Customer</a>
          </li>
          <li>
            <a href="suplier.php"><i class="fas fa-users"></i> Suplier</a>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Laporan Balancing<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="barangjadi.php"><i class="fas fa-cube"></i> Barang Jadi</a>
              </li>
              <li>
                <a  href="ms.php"><i class="fa fa-cube"></i> MS</a>
              </li>
              <li>
                <a  href="orderbuyer.php"><i class="fas fa-vr-cardboard"></i> Order Buyer</a>
              </li>
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-box-open"></i>  Laporan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="laporanpenjualan.php"><i class="fas fa-cube"></i> Penjualan</a>
              </li>
              <li>
                <a  href="laporanpembelian.php"><i class="fa fa-plus-square"></i> Pembelian</a>
              </li>
              <li>
                <a  href="laporankarton.php"><i class="fas fa-vr-cardboard"></i> Karton</a>
              </li>
              <li>
                <a  href="laporanpenerimaan.php"><i class="fas fa-boxes"></i> Penerimaan Barang</a>
              </li>
              <!-- <li>
                <a  href="laporanakuntasi.php"><i class="fas fa-money-bill-alt"></i> Akuntasi</a>
              </li> -->
            </ul>
          </li>
          <li>
            <a  href="#"><i class="fas fa-cog"></i>  Pengaturan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a  href="admin.php"><i class="fas fa-user-cog"></i> Admin</a>
              </li>
              <li>
                <a  href="perusahaan.php"><i class="fa fa-home"></i> Perusahaan</a>
              </li>
            </ul>
          </li>
        </div>      
    </nav>

    <!-- End Side Nav  -->
    
    <div id="page-wrapper">
      <div id="page-inner"> 

      <div class="row">
        <div class="col-12">
            <h3 style="margin-left: 20px;"><i class="fas fa-plus-square"></i> Tambah Data Karton</h3>
            <hr>
        </div>
      </div>

        <div class="row">
            <div>
            <form action="" method="post">
                <div class="form-group col-md-6">
                    <label for="nama_item">Nama Barang :</label>
                    <input type="text" name="nama_item" id="nama_item" class="form-control" placeholder="Masukkan Nama Barang" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="kode">Kode Barang :</label>
                    <input type="text" name="kode" id="kode" class="form-control" placeholder="Masukkan Kode Barang" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="size_barang">Size Barang :</label>
                    <input type="text" name="size_barang" id="size_barang" class="form-control" placeholder="Masukkan Size Barang" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="top">Size Box - Top :</label>
                    <input type="text" name="top" id="top" class="form-control" placeholder="Masukkan Size Box - Top" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="leg">Size Box - Leg :</label>
                    <input type="text" name="leg" id="leg" class="form-control" placeholder="Masukkan Size Box - Leg" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="cross">Size Box - Cross :</label>
                    <input type="text" name="cross_karton" id="first_stock" class="form-control" placeholder="Masukkan Size Box - Cross" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="qty">Quantity :</label>
                    <input type="number" name="qty" id="qty" class="form-control" placeholder="Masukkan Quantity" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="topharga">Top - Harga :</label>
                    <input type="number" name="harga_top" id="topharga" class="form-control" placeholder="Masukkan Top - Harga" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="legharga">Leg - Harga :</label>
                    <input type="number" name="harga_leg" id="legharga" class="form-control" placeholder="Masukkan Leg - Harga" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="crossharga">Cross - Harga :</label>
                    <input type="number" name="harga_cross" id="crossharga" class="form-control" placeholder="Masukkan Cross - Harga" autocomplete="off" >
                </div>
                <div class="form-group col-md-6">
                    <label for="keterangan">Keterangan :</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="20" rows="5" placeholder="Masukkan Keterangan"></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-primary form-control">Tambah Data</button>
            </form>
            </div>
        </div>

      </div>
    </div>
     <!-- /. WRAPPER  -->
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!--DATA TABLE-->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>


    <script type="text/javascript">
      function cek_cst(){
        var id = $("#nama_customer").val();
        $.ajax({
            url: 'autocst.php',
            data:"nama_customer="+id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#kode_customer').val(obj.kode_customer);
            });
        }
    </script>

    <script type="text/javascript">
      function barang(){
        var id = $("#item").val();
        $.ajax({
            url: 'autofill.php',
            data:"nama_item="+id ,
        }).success(function(data) {
            var json = data,
            obj = JSON.parse(json);
            console.log(obj);
            $('#kode_barang').val(obj.kode_barang || obj.code_barang);
            $('#satuan').val(obj.satuan);
            $('#harga_beli').val(obj.harga_beli);
            });
        }
    </script>

</body>
</html>