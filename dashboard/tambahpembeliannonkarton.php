<?php
session_start();
if ( !isset($_SESSION['login'] )){
  Header("Location: ../login/index.php");
  exit();
}
include "../fungsi.php";
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['add_non'])){
  $_SESSION['data_barang'] = true;
  
}

if(isset($_SESSION['data_barang'])){
  $data = array(
      'nama_customer' => $_POST["nama_customer"],
      'kode_customer' => $_POST["kode_customer"],
      'nama_suplier' => $_POST["nama_suplier"],
      'kode_suplier' => $_POST["kode_suplier"],
      'tanggal_pembelian' => $_POST["tanggal_pembelian"],
      'jangka_waktu' => $_POST["jangka_waktu"],
      'kode_pembelian' => $_POST["kode_pembelian"]
    );
}

if( isset($_POST['add_cek']) ){
  if( tambahPembelianKarton($_POST) > 0 ){
    echo "<script>alert('Data Berhasil Ditambahkan')</script>";
  }else{
    echo "<script>alert('Data Gagal Ditambahkan')</script>";
  }
}

if( isset($_POST['add_karton']) ){
  if( tambahTablePmbKarton($_POST) > 0 ){
    echo "<script>alert('Data Berhasil Ditambahkan ke Database')</script>";
    Header('Location: datapembeliankarton.php');
    exit();
  }else{
    echo "<script>alert('Data Gagal Ditambahkan ke Database')</script>";
  }
}

$supli = mysqli_query($conn, "SELECT * FROM suplier WHERE nama_suplier = 'nama_suplier' ");
$sp = mysqli_fetch_array($supli);

function rupiah($angka){
  $hasil = "Rp. " . number_format($angka,2,',','.');
  return $hasil;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/datepicker/js/bootstrap-datepicker.js"></script> 
    
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
            <h3 style="margin-left: 20px;"><i class="fas fa-plus-square"></i> Tambah Data Pembelian Karton</h3>
            <hr>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
            <form action="" method="post">
            <input type="hidden" name="jumlah_terima" id="jumlah_terima" value="0">
                <input type="hidden" name="nama_customer" id='nama_customer' value="<?= $data['nama_customer']; ?>" >
                <input type="hidden" name="nama_suplier" id='nama_suplier' value="<?= $data['nama_suplier']; ?>" >
                <input type="hidden" name="kode_customer" id='kode_customer' value="<?= $data['kode_customer']; ?>" >
                <input type="hidden" name="kode_suplier" id='kode_suplier' value="<?= $data['kode_suplier']; ?>" >
                <input type="hidden" name="tanggal_pembelian" id='tanggal_pembelian' value="<?= $data['tanggal_pembelian']; ?>" >
                <input type="hidden" name="jangka_waktu" id='jangka_waktu' value="<?= $data['jangka_waktu']; ?>" >
                <input type="hidden" name="kode_pembelian" id='kode_pembelian' value="<?= $data['kode_pembelian']; ?>" >
                <div class="form-group col-md-6">
                    <label for="item">Nama Barang :</label>
                    <select name="nama_barang" id="item" data-live-search="true" class="form-control selectpicker" onchange="barang()" >
                        <option value="">-- Pilih Nama Barang --</option>
                        <?php 
                          $barang = mysqli_query($conn, "SELECT nama_item FROM barang UNION SELECT nama_item FROM karton");
                        ?>
                        <?php foreach( $barang as $supp ) : ?>
                        <option value="<?= $supp ['nama_item'] ?>"><?= $supp ['nama_item'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="kode_barang">Kode Barang : </label>
                  <input required placeholder="Masukkan Kode Barang" type="text" id="kode_barang" class="form-control" name="kode_barang" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label for="size_box">Size Box - Top :</label>
                    <input placeholder="Masukkan Size Top" type="text" id="size_top" class="form-control" name="size_top" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label for="size_box">Size Box - Leg :</label>
                    <input placeholder="Masukkan Size Leg" type="text" id="size_leg" class="form-control" name="size_leg" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label for="size_box">Size Box - Cross :</label>
                    <input placeholder="Masukkan Size Cross" type="text" id="size_cross" class="form-control" name="size_cross" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                  <label for="top">Top : </label>
                  <input placeholder="Masukkan Top Harga" type="number" id="top_harga" class="form-control" name="top_harga" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                  <label for="leg">Leg : </label>
                  <input placeholder="Masukkan Leg Harga" type="number" id="leg_harga" class="form-control" name="leg_harga" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                  <label for="cross">Cross : </label>
                  <input placeholder="Masukkan Cross Harga" type="number" id="cross_harga" class="form-control" name="cross_harga" autocomplete="off">
                </div>
                
                <div class="form-group col-md-6">
                  <label for="size_barang">Size Barang : </label>
                  <input required placeholder="Masukkan Size Barang" type="text" id="size_barang" class="form-control" name="size_barang" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                  <label for="qty">QTY : </label>
                  <input placeholder="Masukkan QTY" type="text" id="qty" class="form-control" name="qty" autocomplete="off">
                </div>
                <div class="form-group col-md-6">
                    <label for="divisi">Divisi :</label>
                    <input type="text" id="divisi" required name="divisi" class="form-control" placeholder="Masukkan Divisi" autocomplete="off">
                </div>
                <div class="form-group col-md-6">   
                    <label for="keterangan">Keterangan :</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" cols="20" rows="3"></textarea>
                </div>
                <button id="add" type="submit" name="add_cek" class="btn btn-primary form-control">Tambah Data</button>
            
            </div>
            </form>
        </div>
        <br>
        <div class="col-md-12">
        <div class="table-responsive">
        <form action="" method="post">
<div id="container">
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th class="text-center" rowspan="2"  style="vertical-align: middle;">No</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Kode Suplier</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Kode Customer</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Tanggal Pembelian</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Jangka Waktu</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">No PO</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Nama Item</th>
            <th class="text-center" scope="col" rowspan="2" style="vertical-align: middle;">Size</th>
            <th class="text-center" scope="col" rowspan="2"  style="vertical-align: middle;">Code</th>
            <th class="text-center" scope="col" colspan="3"  style="vertical-align: middle;">Size Box</th>
            <th class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Top</th>
            <th class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Leg</th>
            <th class="text-center" scope="col" colspan="2"  style="vertical-align: middle;">Cross</th>
            <th class="text-center" scope="col" rowspan="2"  style="vertical-align: middle;">QTY</th>
            <th class="text-center" scope="col" rowspan="2"  style="vertical-align: middle;">Keterangan</th>
            </tr>
            <tr>
            <th style="vertical-align: middle;">Top</th>
			      <th style="vertical-align: middle;">Leg</th>
            <th style="vertical-align: middle;">Cross</th>
            <!-- Fot Top -->
            <th style="vertical-align: middle;">Harga</th>
            <th style="vertical-align: middle;">Total</th>
            <!-- For Leg -->
            <th style="vertical-align: middle;">Harga</th>
            <th style="vertical-align: middle;">Total</th>
            <!-- For Cross -->
            <th style="vertical-align: middle;">Harga</th>
            <th style="vertical-align: middle;">Total</th>
            </tr>
        </thead>
        <tbody>
        <?php $query = mysqli_query($conn, "SELECT * FROM tmp_karton"); ?>
        <?php $i = 1; ?>
        <?php foreach($query as $data) : ?>
            <tr class="text-center">
            <td class="text-center"><?= $i++; ?></td>
            <td><?= $data['kode_suplier']; ?></td>
            <td><?= $data['kode_customer']; ?></td>
            <td><?= $data['tanggal_pembelian']; ?></td>
            <td><?= $data['jangka_waktu']; ?></td>
            <td><?= $data['no_po']; ?></td>
            <td><?= $data['nama_item']; ?></td>
            <td><?= $data['size']; ?></td>
            <td scope="row"><?= $data['code']; ?></td>
            <!-- For Size Box -->
            <td class="text-center" scope="col" rowspan="1"><?= $data['sb_top']; ?></td>
            <td class="text-center" scope="col" rowspan="1"><?= $data['sb_leg']; ?></td>
            <td class="text-center" scope="col" rowspan="1"><?= $data['sb_cross']; ?></td>
            <!-- For Top -->
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['t_harga']); ?></td>
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['t_total']); ?></td>
            <!-- For Leg -->
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['l_harga']); ?></td>
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['l_total']); ?></td>
            <!-- For Cross -->
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['c_harga']); ?></td>
            <td class="text-center" scope="col" rowspan="1"><?= rupiah($data['c_total']); ?></td>
            <!-- For Amount -->
            <td><?= $data['qty']; ?></td>
            <td><?= $data['keterangan']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      
      </div>
      <br>
      <button id="add" type="submit" name="add_karton" class="btn btn-primary form-control">Simpan Data</button>
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
    function cek_database(){
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