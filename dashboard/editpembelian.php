<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

$id = (int)$_GET["id"];

$dp_barang = query("SELECT * FROM dp_barang WHERE id = $id")[0];

if( isset($_POST['submit']) ){
    if( editPembelian($_POST) > 0 ){ 
      echo "<script>alert('Data Berhasil Diubah');</script>";
      Header('Location: datapembelian.php');
      exit();
    }else{
      echo "<script>alert('Data Gagal Diubah')</script>";
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
    <link rel="stylesheet" href="assset/datepicker/css/datepicker.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/datepicker/js/bootstrap-datepicker.js"></script> 
    <script type="text/javascript">
    $(function(){
    $("#datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      });
    });
    </script>
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
                <a  href="formpenjualannonkarton.php"><i class="fa fa-plus-square"></i> Tambah Data Non Karton</a>
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
            <h3 style="margin-left: 20px;"><i class="fas fa-plus-square"></i> Ubah Data Pembelian</h3>
            <hr>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
            <form action="" method="post">
            <input type="hidden" name="id" value="<?= $dp_barang['id']; ?>">
                <div class="form-group col-md-6">
                    <label for="nama_customer">Nama Customer :</label>
                    <select name="nama_customer" id="nama_customer" data-live-search="true" class="form-control selectpicker" onchange="cek_cst()" >
                        <option value="">-- Pilih Nama Customer --</option>
                        <?php 
                          $customer = mysqli_query($conn, "SELECT * FROM customer");
                        ?>
                        <?php foreach( $customer as $cst ) : ?>
                        <option value="<?= $dp_barang['nama_customer'] == $cst['nama_customer'] ? $dp_barang['nama_customer']: $cst['nama_customer'] ?>" <?= $dp_barang['nama_customer'] == $cst['nama_customer'] ? 'selected="selected"' :'' ?>><?= $dp_barang['nama_customer'] == $cst['nama_customer'] ? $dp_barang['nama_customer']: $cst['nama_customer'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="nama_suplier">Nama Suplier :</label>
                    <select name="nama_suplier" id="nama_suplier" data-live-search="true" class="form-control selectpicker" onchange="cek_supp()" >
                        <option value="">-- Pilih Nama Suplier --</option>
                        <?php 
                          $customer = mysqli_query($conn, "SELECT * FROM suplier");
                        ?>
                        <?php foreach( $customer as $cst ) : ?>
                        <option value="<?= $dp_barang['nama_suplier'] == $cst['nama_suplier'] ? $dp_barang['nama_suplier']: $cst['nama_suplier'] ?>" <?= $dp_barang['nama_suplier'] == $cst['nama_suplier'] ? 'selected="selected"' :'' ?> ><?= $dp_barang['nama_suplier'] == $cst['nama_suplier'] ? $dp_barang['nama_suplier']: $cst['nama_suplier'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="kode_customer">Kode Customer :</label>
                    <input type="text" id="kode_customer" required name="kode_customer" value="<?= $dp_barang['kode_customer']; ?>" class="form-control" placeholder="Masukkan Kode Customer" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="kode_suplier">Kode Suplier :</label>
                    <input type="text" id="kode_suplier" required value="<?= $dp_barang['kode_suplier']; ?>" name="kode_suplier" class="form-control" placeholder="Masukkan Kode Suplier" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="kode_pembelian">No PO :</label>
                    <input type="text" id="kode_pembelian" required name="kode_pembelian" value="<?= $dp_barang['kode_pembelian']; ?>" class="form-control" placeholder="Masukkan Kode Pembelian" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <label for="tgl">Tanggal Pembelian : </label>
                  <input required placeholder="Masukkan Tanggal Pembelian" type="date" id="tgl" class="form-control" value="<?= $dp_barang['tanggal_pembelian']; ?>" name="tanggal_pembelian" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="item">Nama Barang :</label>
                    <select name="nama_barang" id="item" data-live-search="true" class="form-control selectpicker" onchange="barang()" >
                        <option value="">-- Pilih Nama Barang --</option>
                        <?php 
                          $barang = mysqli_query($conn, "SELECT nama_item FROM barang UNION SELECT nama_item FROM karton");
                        ?>
                        <?php foreach( $barang as $supp ) : ?>
                        <option value="<?= $supp ['nama_item'] ?>" <?= $dp_barang['nama_barang'] == $supp['nama_item'] ? 'selected="selected"' :'' ?>><?= $supp ['nama_item'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="satuan">Satuan :</label>
                    <select name="satuan" id="satuan" class="form-control">
                        <option value="">-- Pilih Satuan --</option>
                        <option value="PCS" <?= $dp_barang['satuan'] == "PCS" ? "selected" : null ?>>PCS</option>
                        <option value="SET" <?= $dp_barang['satuan'] == "SET" ? "selected" : null ?>>SET</option>
                        <option value="KG" <?= $dp_barang['satuan'] == "KG" ? "selected" : null ?>>KG</option>
                        <option value="LITER" <?= $dp_barang['satuan'] == "LITER" ? "selected" : null ?>>LITER</option>
                        <option value="ROLL" <?= $dp_barang['satuan'] == "ROLL" ? "selected" : null ?>>ROLL</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="number" id="harga_beli" required name="harga_beli" value="<?= $dp_barang['harga_beli']; ?>" class="form-control" placeholder="Masukkan Harga Beli" >
                </div>
                <div class="form-group col-md-6">
                    <label for="jumlah_pembelian">Jumlah Pembelian :</label>
                    <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" value="<?= $dp_barang['jumlah_pembelian']; ?>" class="form-control" placeholder="Masukkan Jumlah Pembelian">
                </div>
                <div class="form-group col-md-6">
                  <label for="jangka">Jangka Waktu : </label>
                  <input required placeholder="Masukkan Jangka Waktu Pembelian" type="date" id="jangka" class="form-control" name="jangka_waktu" value="<?= $dp_barang['jangka_waktu'];?>" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <label for="ppn">PPN : </label>
                  <input placeholder="Masukkan PPN" type="text" id="ppn" class="form-control" name="ppn" value="<?= $dp_barang['ppn'];?>" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <label for="divisi">Divisi : </label>
                  <input required placeholder="Masukkan Divisi" type="text" id="divisi" class="form-control" name="divisi" value="<?= $dp_barang['divisi'];?>" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="keterangan">Keterangan :</label>
                    <textarea name="keterangan" id="keterangan" required class="form-control" cols="20" rows="5"><?= $dp_barang['keterangan']; ?></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-primary form-control">Simpan Data</button>
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
    <script type="text/javascript">
    function cek_supp(){
        var id = $("#nama_suplier").val();
        $.ajax({
            url: 'autoselect.php',
            data:"nama_suplier="+id ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#kode_suplier').val(obj.kode_suplier);
            });
        }
    </script>

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